<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$carts = Cart::with(['user', 'product'])->get();
        //return $carts;
        return view('user.cart');
    }

    public function read()
    {   
        $carts = Cart::with(['user', 'product'])->get();

        return view('user.component.data_cart')->with([
            'data' => $carts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'size' => 'required|string',
        'count' => 'required|integer|min:1',
    ]);

    try {
        // Dapatkan produk berdasarkan ID
        $product = Product::findOrFail($request->product_id);

        // Debugging logs
        \Log::info('Product ID: ' . $request->product_id);
        \Log::info('Requested Count: ' . $request->count);
        \Log::info('Product Stock: ' . $product->stock);

        // Check if there is enough stock
        if ($product->stock < $request->count) {
            \Log::error('Insufficient stock available.');
            return response()->json(['error' => 'Insufficient stock available.'], 422);
        }

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Kurangi stok produk
            $product->decrement('stock', $request->count);
            \Log::info('Stock updated successfully. New stock: ' . $product->stock);

            // Tambahkan produk ke keranjang
            $data = [
                'user_id' => Auth::id(), // gunakan Auth::id() untuk kemudahan
                'product_id' => $request->product_id,
                'size' => $request->size,
                'count' => $request->count,
            ];

            Cart::create($data);
            \Log::info('Product added to cart successfully.');

            // Commit transaksi
            DB::commit();

            return response()->json(['success' => 'Product added to cart successfully.']);
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();
            \Log::error('Transaction error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while processing your request: ' . $e->getMessage()], 500);
        }
    } catch (\Exception $e) {
        \Log::error('General error: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred while processing your request: ' . $e->getMessage()], 500);
    }
}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
    
        // Ambil produk terkait dari keranjang
        $product = Product::findOrFail($cart->product_id);
        
        // Tambahkan kembali jumlah produk ke stok
        $product->stock += $cart->count;
        $product->save();
    
        // Hapus item dari keranjang
        $cart->delete();
    
        return response()->json(['success' => 'Product removed from cart successfully and stock updated.']);
    }
    
    // Ganti alamat
    public function alamat(Request $request)
    {
        if(Auth::user()->role == 'user'){
            $alamat = User::where('id', $request->id)->update([
                'address' => $request->address
            ]);

            return response()->json(['success' => 'Address updated successfully.']);
        } else {
            return response()->json(['failed' => 'Please contact your Admin for assistance.']);
        }
    }
}
