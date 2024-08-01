<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserOrderController extends Controller
{
    public function index() {
        return view('user.order');
    }

    public function read() {

        return view('user.component.data_order')->with([
            'data' => DB::table('orders')->orderBy('id', 'desc')->get()
        ]);
    }


    public function store(Request $request)
    {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images/my/pembayaran'), $imageName);
        
        $cart = Cart::where('user_id',Auth::user()->id)->first();
        $join = DB::table('carts')->where('product_id',$cart->product_id)->select('*')
        ->join('products', 'products.id', '=', 'carts.product_id')
        ->get();

        foreach ($join as $order) {
            try{
                Order::create([
                    'user_id' => $order->user_id,
                    'name' => $order->name,
                    'stock' =>$order->stock,
                    'price' => $order->price,
                    'category' => $order->category,
                    'sold' => $order->sold,
                    'count' => $order->count,
                    'size' => $order->size,
                    'status' => "Pending",
                    'image' => $order->image,
                    'payment' => null,
                    'bukti_pembayaran' => $imageName,
                ]);
                Cart::where('user_id', Auth::user()->id)->delete();
            }
            catch(Exception $e){
                dd($e);
            }
            
        }

        return redirect('/my/order')->with('success', 'Order has been added successfully');
    }



    // Finish Order
    public function finish(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->sold = $request->sold;
        $order->save();

        
        return response()->json(['success' => 'Successfully completed the order']);
    }

    // Cancel Order
    public function cancel(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return response()->json(['success' => 'Successfully canceled the order']);
    }

    // Delete Order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        
        return response()->json(['success' => 'Successfully deleted the order']);
    }



}
