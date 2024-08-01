<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    // Menampilkan halaman produk
    public function product()
    {
        return view('user.product');
    }

    // Mengambil data produk
    public function getProducts()
    {
        $products = DB::table('products')->orderBy('id', 'desc')->get();

        return view('user.component.data_product_admin')->with([
            'success' => true,
            'data' => $products
        ]);
    }

    // Menyimpan produk baru
    public function store(Request $request)
{
    try {
        // Log raw request data
        Log::info('Raw request data:', $request->all());

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
            'size' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Pembersihan ukuran
        $originalSize = $request->input('size');
        Log::info('Original size before cleaning:', ['size' => $originalSize]);

        // Menghapus tanda kutip dan spasi
        $cleanedSize = trim(str_replace(['"', "'"], '', $originalSize));
        Log::info('Cleaned size after processing:', ['cleaned_size' => $cleanedSize]);

        // Simpan gambar ke direktori public/images
        $image = $request->file('image');
        if ($image->isValid()) {
            $imageName = time() . '_' . str_replace(['"', "'"], '', $image->getClientOriginalName());
            $image->move(public_path('images'), $imageName);
        } else {
            return response()->json(['error' => 'Invalid image file.'], 422);
        }

        // Simpan data produk ke database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'size' => $cleanedSize, // Pastikan ini sudah dibersihkan
            'image' => $imageName
        ]);

        return response()->json(['success' => 'Product added successfully.']);
    } catch (\Exception $e) {
        Log::error('Error adding product: ' . $e->getMessage(), [
            'request_data' => $request->all(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->json(['error' => 'Failed to add product. Detail: ' . $e->getMessage()], 500);
    }
}


public function update(Request $request, $id)
{
    try {
        $product = Product::findOrFail($id);

        // Log input untuk debugging
        Log::info('Raw request data for update:', $request->all());

        // Bersihkan input dari tanda kutip
        $cleanedSize = trim(str_replace(['"', "'"], '', $request->size));

        Log::info('Cleaned size for update:', ['size' => $cleanedSize]);

        // Validasi input
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
            'size' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        // Jika ada gambar yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                $oldImagePath = public_path('images/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Simpan gambar baru
            $image = $request->file('image');
            if ($image->isValid()) {
                $imageName = time() . '_' . str_replace(['"', "'"], '', $image->getClientOriginalName());
                $image->move(public_path('images'), $imageName);
                $product->image = $imageName;
            } else {
                return response()->json(['error' => 'Invalid image file.'], 422);
            }
        }

        // Update data produk lainnya
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category = $request->category;
        $product->size = $cleanedSize;

        // Simpan perubahan
        $product->save();

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        Log::error('Error updating product: ' . $e->getMessage(), [
            'request_data' => $request->all(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->json(['error' => 'Failed to update product. Detail: ' . $e->getMessage()], 500);
    }
}

    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::find($id);
        return view('user.component.data_detail_product_admin')->with([
            'data' => $product
        ]);
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = Product::find($id);
        return view('user.component.data_edit_product_admin')->with([
            'data' => $product
        ]);
    }


    // Menghapus produk
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $imagePath = public_path('images/' . $product->image);

            // Hapus gambar jika ada
            if (is_file($imagePath) && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $product->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage(), [
                'product_id' => $id,
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => 'Failed to delete product. Detail: ' . $e->getMessage()], 500);
        }
    }
}
