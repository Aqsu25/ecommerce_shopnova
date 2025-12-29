<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Order_Status;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminController extends Controller
{
    public function indexCategory()
    {
        $categories = Category::all();
        return view('admin.indexCategory', compact('categories'));
    }
    public function createCategory()
    {
        return view('admin.addCategory');
    }

    public function storeCategory(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|string',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        Category::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.index')->with('success', 'Category Created Successfully!');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.updateCategory', compact('category'));
    }
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|string',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.index')->with('success', 'Category Updated Successfully!');
    }

    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->subcategory()->delete();
        $category->delete();
        return redirect()->route('admin.index')->with('success', 'Category Deleted Successfully!');
    }



    // PRODUCT SEARCH
    public function searchProduct(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'LIKE', "%$search%")
            ->orWhereHas('category', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            })->orWhereHas('sub_category', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            })->paginate(2);
        return view('admin.product.list', compact('products'));
    }

    // Admin_View
    public function view_Order()
    {
        $orders = Order::latest()->paginate(5);
        return view('orders.view_order', compact('orders'));
    }

    public function order_status(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'status' => 'required|string',
                'order_id' => 'required|exists:orders,id',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        // dd($request->all());
        Order_Status::create([
            'status' => $request->status,
            'order_id' => $request->order_id,
        ]);
        return redirect()->back()->with('success', 'Status Updated Successfully!');
    }

    // pdf_download
    public function downloadPdf($id)
    {
        $data = Order::findOrFail($id);
        $pdf = Pdf::loadView('admin.pdf', compact('data'));
        return $pdf->download('invoice.pdf');
    }

    // admin user search

    public function searchUser(Request $request)
    {
        $search = $request->search;
        $users = User::where('name', 'LIKE', "%$search%")
        ->orWhere('email', 'LIKE', "%$search%")
            ->paginate(2);
        return view('users.list', compact('users'));
    }
}
