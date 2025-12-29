@extends('homes.main')

@section('View_Cart')
    <div class="container my-5">

        <div class="row g-4">

            {{-- LEFT SIDE: CART TABLE --}}
            <div class="col-lg-8">
                <x-message></x-message>
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h4 class="mb-4 fw-bold text-dark">🛒 Shopping Cart</h4>

                        <table class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($carts as $cart)
                                    <tr class="align-middle">
                                        <td class="fw-semibold">{{ $cart->product->name }}</td>
                                        <td>${{ number_format($cart->product->price, 2) }}</td>
                                        <td class="fw-semibold text-center">{{ $cart->quantity }}</td>

                                        {{-- IMAGE --}}
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="height: 90px;">
                                                <img src="{{ asset('uploads/products/' . $cart->product->image) }}"
                                                    class="img-fluid rounded shadow-sm" style="max-height: 70px;">
                                            </div>
                                        </td>

                                        {{-- ACTION --}}
                                        <td class="text-center">
                                            <a href="{{ route('cart.remove', $cart->id) }}"
                                                class="btn btn-outline-danger btn-sm shadow-sm"
                                                onclick="return confirm('Are you sure you would like to remove this item from the shopping bag?')">
                                                <i class="fa fa-trash me-1"></i> Remove
                                            </a>
                                        </td>
                                    </tr>
                                    @php $total += $cart->product->price; @endphp
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE: ORDER SUMMARY --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="fw-bold mb-4 text-dark text-uppercase">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold mb-4 fs-5">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>

                        {{-- CHECKOUT FORM --}}
                        <form method="POST" action="{{ route('order.detail') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Address</label>
                                <input type="text" class="form-control" value="{{ old('address') }}" name="address">
                                @error('address')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number">
                                @error('phone_number')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="btn btn-warning w-100 fw-bold text-dark py-2 shadow-sm text-uppercase"
                                type="submit">
                                <i class="fa fa-credit-card me-2"></i> Proceed to Checkout
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Table hover effect */
        table tbody tr:hover {
            background-color: #fff7e6;
            transition: 0.3s;
        }

        /* Buttons hover */
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
            border-color: #dc3545;
            transition: 0.2s;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            color: #fff;
            transition: 0.2s;
        }

        /* Shadow for images */
        .table img {
            transition: transform 0.3s;
        }

        .table img:hover {
            transform: scale(1.05);
        }

        /* Card styling */
        .card {
            border-radius: 10px;
        }

        /* Input focus */
        input.form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 5px rgba(255, 193, 7, 0.5);
        }
    </style>
@endsection
