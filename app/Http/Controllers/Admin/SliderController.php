<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {

        $validated =  $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $filepath = 'storage/slider/';
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move($filepath, $filename);

            $validated['image'] = $filepath . $filename;
        }

        Slider::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $validated['image']
        ]);

        return redirect('/admin/sliders')->with("message", "Slider added successfully!");
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {

        $validated =  $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable'
        ]);

        $slider = Slider::findOrFail($id);

        if ($request->hasFile('image')) {

            if (File::exists($slider->image)) {
                File::delete($slider->image);
            }

            $filepath = 'storage/slider/';
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move($filepath, $filename);

            $validated['image'] = $filepath . $filename;
        }

        $slider->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $validated['image'] ?? $slider->image
        ]);

        return redirect('/admin/sliders')->with("message", "Slider updated successfully!");
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if (File::exists($slider->image)) {
            File::delete($slider->image);
        }

        $slider->delete();

        return redirect('/admin/sliders')->with("message", "Slider deleted successfully!");
    }
}
