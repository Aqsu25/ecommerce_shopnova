<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\imageUploadTrait;
use App\Models\Cart;
use App\Models\productRating;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(2);

        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.product.create', compact('categories'));
    }

    public function getsubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
                'price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer',
                'description' => 'nullable|string',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $imageName = null;
        if ($request->hasfile('image')) {
            $imageName = $this->uploadImage($request->file('image'), 'products');
        }
        Product::create([
            'name' => $request->name,
            'description' =>  $request->description,
            'price' =>  $request->price,
            'stock_quantity' =>  $request->stock_quantity,
            'category_id' =>  $request->category_id,
            'sub_category_id' =>  $request->sub_category_id,
            'image' => $imageName,
        ]);
        return redirect()->route('products.index')->with('success', 'Product Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
                'price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer',
                'description' => 'nullable|string',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if ($request->hasfile('image')) {
            $imageName = $this->uploadImage($request->file('image'), 'products');
        } else {
            $imageName = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'description' =>  $request->description,
            'price' =>  $request->price,
            'stock_quantity' =>  $request->stock_quantity,
            'category_id' =>  $request->category_id,
            'sub_category_id' =>  $request->sub_category_id,
            'image' => $imageName,
        ]);
        return redirect()->route('products.index')->with('success', 'Product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            $product->delete();
        }
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully!');
    }

    public function details($id)
    {
        if (Auth::check()) {
            $count = Cart::where('user_id', Auth::id())->count();
        } else {
            $count = '';
        }

        $productRating = productRating::where('status', 1)->get();

        $product = Product::findOrFail($id);
        if ($product) {
            return view('admin.product.detail', compact('product', 'count', 'productRating'));
        }
    }

    // approve-ratings
    public function public_rating()
    {
        $product_ratings = ProductRating::select('product_rating.*', 'products.name as product_name') // Corrected alias name
            ->orderBy('product_rating.created_at', 'DESC')
            ->leftJoin('products', 'product_rating.product_id', '=', 'products.id') // Corrected join logic
            ->paginate(3);

        return view('admin.approveRating', compact('product_ratings'));
    }

    // status_change_admin
    public function status_change($id)
    {
        $rating = productRating::findOrFail($id);
        $rating->status = $rating->status == 1 ? 0 : 1;
        $rating->save();
        return redirect()->back()->with('success', 'Status Change Successfully!');
    }
}
