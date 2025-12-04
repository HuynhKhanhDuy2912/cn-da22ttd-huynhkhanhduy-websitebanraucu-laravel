<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

use function Flasher\Toastr\Prime\toastr;

class ProductController extends Controller
{
    public function showFormAddProduct()
    {
        $categories = Category::all();
        return view('admin.pages.products_add', compact('categories'));
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',            
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = Str::slug($request->input('name')).'-'.time();

        $product = Product::create([
            'name' => $request->name,
            'slug' => $slug,            
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock ?? 0,            
            'status' => 'in_stock',
            'unit' => $request->unit ?? 'kg',
        ]);

        //Handle image upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = "uploads/products/" . $imageName;

                $reSizedImage = Image::make($image)->resize(600, 600)->encode();

                Storage::disk('public')->put($path, (string) $reSizedImage);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        toastr()->success('Thêm sản phẩm thành công!');
        return redirect()->route('admin.product.add');
    }

    public function index()
    {
        $products = Product::with('category', 'images')->get();
        $categories = Category::all();
        return view('admin.pages.products', compact('products', 'categories'));
    }

    public function updateProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',            
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($request->product_id);

        $product->update([
            'name' => $request->name,   
            'slug' => Str::slug($request->input('name')).'-'.time(),       
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock ?? $product->stock,      
            'status' => ($request->stock ?? $product->stock) == 0 ? 'out_of_stock' : 'in_stock',    
            'unit' => $request->unit ?? $product->unit,
        ]);

        //Handle image upload
        if ($request->hasFile('images')) {

            // Delete old images
            $oldImages = ProductImage::where('product_id', $product->id)->get();
            foreach ($oldImages as $image) {
                Storage::disk('public')->delete('uploads/'. $image->image);
            }

            // Delete old image records
            ProductImage::where('product_id', $product->id)->delete();

            // Upload new images
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = "uploads/products/" . $imageName;

                $reSizedImage = Image::make($image)->resize(600, 600)->encode();

                Storage::disk('public')->put($path, (string) $reSizedImage);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        toastr()->success('Cập nhật sản phẩm thành công!');
        return response()->json(['status' => true]);
    }
}
