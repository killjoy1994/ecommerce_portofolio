<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {

        $brands = Brand::all();

        return view('admin.brand.index', compact('brands'));
    }

    public function create() {
        $categories = Category::all();

        return view('admin.brand.create', compact('categories'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'string|required|max:100',
            'slug' => 'string|required|max:100',
            'category_id' => 'integer|required',
        ]);

        Brand::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'category_id' => $validatedData['category_id']
        ]);

        return redirect('/admin/brands')->with('message', "Brand created successfully!");
    }
}
