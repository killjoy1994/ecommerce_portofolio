<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view("admin.products.index", compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        // $brands = $this->getBrands();
        return view('admin.products.create', compact('categories'));
    }

    public function getBrand(Request $request)
    {
        $brands = Brand::where('category_id', $request->categoryID)->pluck('id', 'name');

        return response()->json($brands);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            "category_id" => "integer|required",
            "name" => "required|max:255",
            "slug" => "required|max:255",
            "small_description" => "required|max:255",
            "description" => "required|max:255",
            "brand" => "nullable|string",
            "price" => "required|integer",
            "quantity" => "required|integer",
            "trending" => "nullable",
            "featured" => "nullable",
            "image" => "nullable"
        ]);

        $product = Product::create([
            'category_id' => $validated["category_id"],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['slug']),
            'small_description' => $validated['small_description'],
            'description' => $validated['description'],
            'brand' => $validated['brand'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'trending' => $request->trending == true ? "1" : "0",
            'trending' => $request->featured == true ? "1" : "0",
        ]);

        if ($request->hasFile('image')) {
            $uploadPath = 'storage/products/';

            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $ext = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $ext;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathname = $uploadPath . $filename;

                $product->productImages()->create([
                    "product_id" => $product->id,
                    "image" => $finalImagePathname
                ]);
            }
        }

        return redirect('/admin/products')->with('message', 'Product added succeessfully!');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        dd($request->all());
        $validated = $request->validate([
            "category_id" => "integer|required",
            "name" => "required|max:255",
            "slug" => "required|max:255",
            "small_description" => "required|max:255",
            "description" => "required|max:255",
            "brand" => "nullable|string",
            "price" => "required|integer",
            "quantity" => "required|integer",
            "trending" => "nullable",
            "featured" => "nullable",
            "image" => "nullable"
        ]);

        $product = Product::findOrFail($id);

        if ($product) {
            $product->update([
                'category_id' => $validated["category_id"],
                'name' => $validated['name'],
                'slug' => Str::slug($validated['slug']),
                'small_description' => $validated['small_description'],
                'description' => $validated['description'],
                'brand' => $validated['brand'],
                'price' => $validated['price'],
                'quantity' => $validated['quantity'],
                'trending' => $request->trending == true ? "1" : "0",
                'trending' => $request->featured == true ? "1" : "0",
            ]);

            if ($request->hasFile('image')) {
                $uploadPath = "store/products/";

                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $ext = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $ext;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathname = $uploadPath . $filename;

                    $product->productImages()->update([
                        "product_id" => $product->id,
                        "image" => $finalImagePathname
                    ]);
                }
            }

            return redirect('/admin/products')->with('message', 'Product updated succeessfully!');
        }
    }

    public function destroyImage($id)
    {
        $productImage = ProductImage::findOrFail($id);

        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        };

        $productImage->delete();

        return redirect()->back()->with('message', "Product image deleted!");
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if($product->productImages) {
            foreach($product->productImages as $productImage) {
                if(File::exists($productImage->image)) {
                    File::delete($productImage->image);
                }
            }
        }

        $product->delete();
        return redirect('/admin/products')->with('message', 'product deleted');
    }
}
