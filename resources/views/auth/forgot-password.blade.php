<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/logo-shortcut.png">

    <title>MidaCollection - Forgot Password</title>

    {{-- Auth css --}}
    <link rel="stylesheet" href="/assets/css/auth.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="row">
            <div class="col-md-6">
                <div id="img-login"></div>
            </div>
            <div class="col-md-6">
                <div class="mt-5">
                    <header class="d-flex justify-content-center ">
                        <img src="/assets/img/logo-nama.png" alt="" width="200px">
                    </header>
                    <div class="row justify-content-center px-3 mt-5">
                        <div class="col-md-6">
                            <h2 class="fw-bold text mb-4" style="color: #034f84">Forgot Password</h2>
                            <div class="main">
                                <div class="form">
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <p>Please enter your Name, Email, or Phone Number!</p>
                                    <form action="{{ route('password.email') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="katakunci" class="form-label">Name, Email, or Phone Number</label>
                                            <input type="text" class="form-control border border-primary" name="katakunci" required>
                                            @error('katakunci')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">New Password</label>
                                            <input type="password" class="form-control border border-primary" name="password" required>
                                            <small class="form-text text-muted">Your password must be at least 8 characters long and contain letters, numbers, and special characters.</small>
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control border border-primary" name="password_confirmation" required>
                                            @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <input type="submit" value="Request Password Reset" class="btn w-100 mt-3" style="background-color:#034f84; border-color:white; color:white">
                                    </form>
                                    <p class="text-center mt-3">Don't have an account? <a href="/auth/register" class="fw-bold text-decoration-none text-dark">Register</a></p>
                                    <p class="text-center mt-3">Have an account? <a href="/auth/login" class="fw-bold text-decoration-none text-dark">Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
