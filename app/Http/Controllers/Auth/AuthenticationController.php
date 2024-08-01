<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator; 

class AuthenticationController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function register(Request $request)
{
    Log::info('User registration initiated.', $request->all()); // Log permintaan

    // Validasi data pengguna
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users|max:255',
        'phone_number' => 'required',
        'address' => 'required|max:255',
        'password' => 'required|min:6|regex:/[a-zA-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        'confirm_password' => 'required|min:6|same:confirm_password',
    ], [
        'name.required' => 'Please enter your Name',
        'email.required' => 'Please enter your Email',
        'phone_number.required' => 'Please enter your Phone Number',
        'address.required' => 'Please enter your Address',
        'password.required' => 'Please enter a new password.',
        'password.min' => 'Password must be at least 6 characters.',
        'password.regex' => 'Password must contain at least one letter, one number, and one special character.',
        'confirm_password.same' => 'Passwords do not match.',
        'confirm_password.required' => 'Please confirm your new password.',
    ]);

    try {
        // Buat pengguna baru
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone_number'];
        $user->address = $validatedData['address'];
        $user->password = bcrypt($validatedData['password']);
        $user->role = 'user';
        $user->save();
        
        Log::info('User registered successfully.', ['user_id' => $user->id]);

        // Login pengguna baru
        Auth::login($user);

        // Redirect ke halaman dashboard
        return redirect('/dashboard');
    } catch (\Exception $e) {
        Log::error('User registration failed.', ['error' => $e->getMessage()]);
        return redirect('/auth/register')->withErrors(['error' => 'User registration failed. Please try again.']);
    }
}



    public function login(Request $request)
    {
        Log::info('User login attempt.', $request->only('email')); // Log permintaan login

        // validasi data pengguna
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Please enter your Email',
            'password.required' => 'Please enter your Password',
        ]);

        // cek apakah pengguna bisa login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Log::info('User logged in successfully.', ['email' => $request->email]);
            return redirect('/my/home');
        } else {
            Log::warning('User login failed.', ['email' => $request->email]);
            return redirect('/auth/login')->withErrors([
'email' => 'Incorrect email or password',
            ]);
        }
    }

    public function handleForgotPassword(Request $request)
    {
        Log::info('Password reset request received.', $request->all());

    $validator = Validator::make($request->all(), [
        'katakunci' => 'required',
        'password' => 'required|string|min:8|regex:/[a-zA-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        'password_confirmation' => 'required|same:password',
    ], [
        'katakunci.required' => 'Please enter your Name, Email, or Phone Number.',
        'password.required' => 'Please enter a new password.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.regex' => 'Password must contain at least one letter, one number, and one special character.',
        'password_confirmation.required' => 'Please confirm your new password.',
        'password_confirmation.same' => 'Passwords do not match.',
    ]);
    
        if ($validator->fails()) {
            Log::error('Validation failed for password reset.', $validator->errors()->toArray()); // Log error validasi
            return back()->withErrors($validator)->withInput(); // Kembali dengan input
        }
    
        try {
            $user = User::where('email', $request->katakunci)
                        ->orWhere('name', $request->katakunci)
                        ->orWhere('phone_number', $request->katakunci)
                        ->first();
    
            if (!$user) {
                Log::warning('User not found during password reset.', ['katakunci' => $request->katakunci]);
                return back()->withErrors(['katakunci' => 'User not found!'])->withInput(); // Kembali dengan input
            }
    
            $user->password = Hash::make($request->password);
            $user->setRememberToken(Str::random(60));
            $user->save();
    
            event(new PasswordReset($user));
            Log::info('Password berhasil di-reset.', ['user_id' => $user->id]);
    
            return redirect()->route('login')->with('status', 'Password has been successfully reset! Please log in with your new password.'); // Pesan sukses
        } catch (\Exception $e) {
            Log::error('An error occurred during the password reset process.', ['error' => $e->getMessage()]); // Log error during the process
            return back()->withErrors(['katakunci' => 'An error occurred while resetting the password. Please try again.'])->withInput(); // Kembali dengan input
        }
    }    

    public function logout()
    {
        Auth::logout();
        Log::info('User logged out.');

        return redirect('/')->with('status', 'You have successfully logged out. Thank you for visiting! We hope to see you again soon.');
    }
}
