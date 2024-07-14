<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stores; // Assuming Stores is your model
use Illuminate\Http\RedirectResponse;

class StoresController extends Controller
{
    public function index()
    {
        // return view('admin.coupon.stores-list');
        $stores = Stores::all(); // Fetch all stores from the database
        return view('admin.coupon.stores-list', compact('stores'));
    }
    public function create()
    {
        return view('admin.coupon.stores');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_hidden' => 'nullable',
            'website_url' => 'nullable|url'
        ]);

        $stores = new Stores();
        $stores->name = $validatedData['name'];
        $stores->website_url = $validatedData['website_url'];
        $isHidden = 0;
        if ($validatedData['is_hidden'] == "show") {
            $isHidden = 1;
        } else {
            $isHidden = 0;
        }
        $stores->is_hidden = $isHidden;
        $imageName = time() . '.' . $validatedData["file"]->extension();
        $imagePath = 'coupon/' . $imageName;
        $request->file->move(public_path('coupon/'), $imageName);
        $stores->image = $imagePath;

        $stores->save();

        // Redirect back with success message
        return redirect()->route('admin.stores-list')->with('success', 'Store created successfully.');
    }

    public function edit($id){
        $store = Stores::find($id);
        return view('admin.coupon.edit-stores', compact('store'));
    }

    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_hidden' => 'nullable',
            'website_url' => 'nullable|url'
        ]);
        $store = Stores::find($id);
        $store->update($validatedData);
        return redirect()->route('admin.stores-list')->with('success', 'Store updated successfully.');

    }

    public function destroy($id){
        $store = Stores::find($id);
        $store->delete();
        return redirect()->route('admin.stores-list')->with('success', 'Store deleted successfully.');

    }
}
