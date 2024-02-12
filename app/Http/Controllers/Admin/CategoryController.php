<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Validation\Rules\File;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'name' => "required|max:100",
            'slug' => "required|max:100",
            'description' => "required|max:255",
            'image' => File::types(['jpg', 'jpeg', 'png'])
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('storage/category/', $filename);
            $request->image = $filename;
        }

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $request->image
        ]);

        return redirect('/admin/categories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => "required|max:100",
            'slug' => "required|max:100",
            'description' => "required|max:255",
            'image' => File::types(['jpg', 'jpeg', 'png'])
        ]);

        $category = Category::findOrFail($id);

        $category->name = $validatedData['name'];
        $category->slug = $validatedData['slug'];
        $category->description = $validatedData['description'];

        if($request->hasFile('image')) {
            $path = 'storage/category/' . $category->image;

            if(FacadesFile::exists($path)) {
                FacadesFile::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            
            $file->move('storage/category/', $filename);
            $category->image = $filename;
        }

        $category->update();

        return redirect('/admin/categories')->with('message', "Category updated!");
    }

    public function destroy($id) {
        $category = Category::findOrFail($id);

        $path = 'storage/category/' . $category->image;
        if(FacadesFile::exists($path)) {
            FacadesFile::delete($path);
        }

        $category->delete();

        return redirect('/admin/categories')->with('message', "Category deleted!");
    }
}
