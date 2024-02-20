<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $trendings = Product::where('trending', '1')->get();
        $featured = Product::where('featured', '1')->get();
        // dd($trendings);
        return view('frontend.index', compact('sliders', 'trendings', 'featured'));
    }

    public function categories()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('frontend.categories', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        $brands = $category->brands()->orderBy('name', 'asc')->get();
        $products = $category->products()->orderBy('name', 'asc')->get();

        // dd($brands);
        return view('frontend.products', compact('brands', 'products'));
    }

     public function filterProducts(Request $request)
    {
        $selectedBrands = $request->input('brands', []);
        $priceOrder = $request->input('price_order', 'asc');

        $brands = Brand::orderBy('name', 'asc')->get();

        $query = Product::query();

        if (!empty($selectedBrands)) {
            $query->whereIn('brand', $selectedBrands);
        }
        
        if (!empty($priceOrder)) {
            $query->orderBy('price', $priceOrder);
        }

        $products = $query->get();

        return view('frontend.products', compact('brands', 'products', 'selectedBrands', 'priceOrder'));
    }

    public function productDetail($category_slug, $product_slug)
    {
        $category =  Category::where('slug', $category_slug)->firstOrFail();
        if ($category) {
            $product = $category->products()->where('slug', $product_slug)->first();
            if ($product) {
                return view('frontend.product', compact('product', 'category'));
            } else {
                return redirect()->back();
            }
        }
    }
}
