<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $subcategories = SubCategory::all();
        return view('admin.subCategory', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.addSubCategory', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|string',
                'category_id' => 'required|exists:categories,id',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('subcategory.index')->with('success', 'SubCategory Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();
        $subcategory = SubCategory::findOrFail($id);
        return view('admin.updateSubcategory', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)

    {
       
        $category = SubCategory::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|string',
                'category_id' => 'required|exists:categories,id',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $category->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('subcategory.index')->with('success', 'SubCategory Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        if ($subCategory) {
            $subCategory->delete();
        }
        return redirect()->route('subcategory.index')->with('success', 'SubCategory Deleted Successfully!');
    }
}
