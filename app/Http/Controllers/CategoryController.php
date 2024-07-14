<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index()
    {
        // return view('admin.coupon.category-list');
        $categories = Categories::all(); // Fetch all categories from the database
        return view('admin.coupon.category-list', compact('categories'));
    }
    public function create()
    {
        return view('admin.coupon.category');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'is_hidden' => 'nullable|string'
        ]);

        // Create a new Category instance
        $category = new Categories(); // Assuming Category is your model
        $category->name = $validatedData['name'];

        // Set is_hidden based on request data
        $is_hidden = $validatedData['is_hidden'] === 'hide' ? 1 : 0;
        $category->is_hidden = $is_hidden;

        // Set other properties similarly

        // Save the category to the database
        $category->save();
        return redirect()->route('admin.category-list')->with('success', 'Category created successfully.');

    }

    public function edit($id)
    {
        $category = Categories::find($id); // Fetch all categories from the database
        return view('admin.coupon.edit-category', compact('category'));
    }
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'is_hidden' => 'nullable|integer'
        ]);


        $category = Categories::find($id); // Find the category by ID
        $category->update($validatedData); // Update the category with validated data

        // After updating, redirect the user back to the edit form with a success message
        return redirect()->route('admin.edit-category', $category->id)->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category-list')->with('success', 'Category deleted successfully.');
    }
}
