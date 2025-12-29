<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\productRating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 

    public function dashboard()
    {
        if (Auth::check() && auth()->user()->hasRole('admin')) {
            return view('dashboard.midContent');
        } else {
            return view('dashboard');
        }
    }

    public function index()

    {
        if (auth()->user()->hasRole('admin')) {
            $users = User::orderBy('name', 'ASC')->paginate(2);
            return view('users.list', compact('users'));
        } else {
            $users = User::where('id', Auth::id())->get();
            return view('users.index', compact('users'));
        }
    }


    // yellow-black-gpt
    public function home()
    {
        if (Auth::check()) {
            $count = Cart::where('user_id', Auth::id())->count();
        } else {
            $count = '';
        }
        $products = Product::latest()->take(2)->get();
        return view('homes.index', compact('products', 'count'));
    }

    public function allproducts()
    {

        if (Auth::check()) {
            $count = Cart::where('user_id', Auth::id())->count();
        } else {
            $count = '';
        }
        $products = Product::all();
        return view('viewallproduct', compact('products', 'count'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
        return redirect()->route('users.index')->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::findOrFail($id);
        if ($users) {
            $users->delete();
        }
        return redirect()->route('users.index')->with('success', 'User Deleted Successfully!');
    }

    public function add_to_cart(Request $request, $id)
    {


        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please Login First!');
        }
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $product = Product::findOrFail($id);
        if ($request->quantity > $product->stock_quantity) {
            return redirect()->back()->with('error', 'Quantity exceeds available stock!');
        }
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();
        if ($cart) {
            if ($request->quantity == 1) {
                return redirect()->back()->with('error', 'Already Cart!');
            } else {
                $newQuantity = $cart->quantity + $request->quantity;
                if ($newQuantity > $product->stock_quantity) {
                    return redirect()->back()->with('error', 'New Quantity exceeds available stock!');
                }
                $cart->quantity = $newQuantity;
                $cart->save();
                return redirect()->back()->with('success', 'Quantity Added Successfully!');
            }
        } else {

            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,

            ]);

            return redirect()->back()->with('success', 'Successfully Add To Cart!');
        }
    }

    public function cartpage()
    {
        if (Auth::check()) {
            $count = Cart::where('user_id', Auth::id())->count();
            $carts = Cart::where('user_id', Auth::id())->get();
        } else {
            $count = '';
        }
        return view('cart.cartpage', compact('count', 'carts'));
    }

    public function cartremove($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back()->with('success', 'Remove Product From Cart');
    }

    public function order_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required|string',
            'phone_number' => 'required|numeric|min:11',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        $address = $request->address;
        $phone_number = $request->phone_number;
        $total_price = $carts->sum(fn($c) => $c->product->price * $c->quantity);
        // order-create
        $order = Order::create([
            'address' => $address,
            'phone_number' => $phone_number,
            'user_id' => Auth::id(),
            'total_price' => $total_price,
        ]);
        // items-create
        foreach ($carts as $cart) {
            Order_item::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
            ]);
        }
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Your Order Confirm!');
    }

    // user view own orders
    public function my_Order()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.usersvieworder', compact('orders'));
    }

    // user  // pdf_download
    public function downloadPdf($id)
    {
        $data = Order::findOrFail($id);
        $pdf = Pdf::loadView('users.pdf', compact('data'));
        return $pdf->download('invoice.pdf');
    }

    // users_rating
    public function users_rating()
    {
        $user = User::all();
        return view('ratings.userRatings', compact('user'));
    }

    // users_rating_store
    public function users_rating_store(Request $request, $id)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'comment' => 'required|min:10',
            'rating' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $ratingExists = productRating::where('user_id', Auth::id())->exists();
        if ($ratingExists) {
            return redirect()->back()->with('error', 'You Already Rated This Product!');
        }
        productRating::create([
            'user_id' => Auth()->id(),
            'product_id' => $id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'status' => 0,
        ]);
        return redirect()->back()->with('success', 'Thanks For Your Rating!');
    }

    // search-product
    public function headerProductSearch(Request $request)
    {
        if (Auth::check()) {
            $count = Cart::where('user_id', Auth::id())->count();
        } else {
            $count = '';
        }
        $search = $request->search;
        if ($search) {
            $products = Product::where('name', 'LIKE', "%$search%")
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                })->orWhereHas('sub_category', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                })->get();
        }
        return view('homes.index', compact('products', 'count'));
    }
}
