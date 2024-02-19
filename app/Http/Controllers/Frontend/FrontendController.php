<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        $categories = Category::all();
        return view('frontend.categories', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        $brands = $category->brands;
        $products = $category->products;

        // dd($brands);
        return view('frontend.products', compact('brands', 'products'));
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
