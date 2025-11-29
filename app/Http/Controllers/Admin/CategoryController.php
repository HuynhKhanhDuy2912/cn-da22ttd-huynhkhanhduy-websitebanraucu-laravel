<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return redirect()->route('admin.categories.add');
    }
}
