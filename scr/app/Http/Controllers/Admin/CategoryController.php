<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

use function Flasher\Toastr\Prime\toastr;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.pages.categories', compact('categories'));
    }

    public function showFormAddCate()
    {
        return view('admin.pages.categories_add');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if (Category::where('name', $request->name)->exists()) {
            toastr()->error('Tên danh mục đã tồn tại, vui lòng chọn tên khác!');
            return redirect()->back();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image');
            $fileName = now()->timestamp . '_' . uniqid() . '.' . $imagePath->getClientOriginalExtension();
            $imagePath = $imagePath->storeAs('uploads/categories', $fileName, 'public');
        }

        Category::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);

        toastr()->success('Danh mục đã được thêm thành công!');
        return redirect()->route('admin.category.index');
    }

    public function updateCategory(Request $request)
    {
        try {
            $category = Category::findOrFail($request->category_id);
            if(!$category){
                return response()->json(['status' => 'error', 'message' => 'Danh mục không tồn tại!'], 404);
            }

            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->description = $request->description;
            if( $request->hasFile('image') ) {
                if ( $category->image ) {
                    // Delete old image
                    Storage::disk('public')->delete($category->image);
                }
                $imagePath = $request->file('image');
                $fileName = now()->timestamp . '_' . uniqid() . '.' . $imagePath->getClientOriginalExtension();
                $imagePath = $imagePath->storeAs('uploads/categories', $fileName, 'public');
                $category->image = $imagePath;
            }

        $category->save();

        return response()->json(['status' => 'success', 'message' => 'Cập nhật danh mục thành công!']);
            
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Đã xảy ra lỗi khi cập nhật danh mục!'], 500);
        }        
    }

    public function deleteCategory(Request $request)
    {
        try {
            $category = Category::findOrFail($request->category_id);
            if(!$category){
                return response()->json(['status' => 'error', 'message' => 'Danh mục không tồn tại!'], 404);
            }

            // Delete image if exists
            if ( $category->image ) {
                Storage::disk('public')->delete($category->image);
            }

            $category->delete();

            return response()->json(['status' => 'success', 'message' => 'Xóa danh mục thành công!']);
            
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Đã xảy ra lỗi khi xóa danh mục!'], 500);
        }
    }
}
