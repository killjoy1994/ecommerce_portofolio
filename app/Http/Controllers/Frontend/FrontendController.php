<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $sliders = Slider::all();
        $trendings = Product::where('trending', '1')->get();
        // dd($trendings);
        return view('frontend.index', compact('sliders', 'trendings'));
    }
}
