<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        // return view('admin.coupon.brands-list');
        $brand = Brands::all(); // Fetch all categories from the database
        return view('admin.coupon.brands-list', compact('brand'));
    }

    public function create()
    {
        return view('admin.coupon.brands');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_hidden' => 'nullable',
            'website_url' => 'nullable|url'
        ]);

        $brand = new Brands();
        $brand->name = $validatedData['name'];
        $brand->website_url = $validatedData['website_url'];
        $isHidden = 0;
        if ($validatedData['is_hidden'] == "show") {
            $isHidden = 1;
        } else {
            $isHidden = 0;
        }
        $brand->is_hidden = $isHidden;
        $imageName = time() . '.' . $validatedData["file"]->extension();
        $imagePath = 'coupon/' . $imageName;
        $request->file->move(public_path('coupon/'), $imageName);
        $brand->image = $imagePath;

        $brand->save();

        // Redirect back with success message
        return redirect()->route('admin.brands-list')->with('success', 'Brand created successfully.');
    }

    public function edit($id)
    {
        $brand = Brands::find($id); // Fetch all categories from the database
        return view('admin.coupon.edit-brands', compact('brand'));
    }
    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_hidden' => 'nullable',
            'website_url' => 'nullable|url'
        ]);
        $store = Brands::find($id);
        $store->update($validatedData);
        return redirect()->route('admin.brands-list')->with('success', 'Brand updated successfully.');

    }

    public function destroy($id){
        $store = Brands::find($id);
        $store->delete();
        return redirect()->route('admin.brands-list')->with('success', 'Brand deleted successfully.');

    }
}
