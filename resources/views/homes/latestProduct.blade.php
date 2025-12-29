@extends('homes.main')
@section('search')
    <form class="d-flex" action="{{ route('product.search') }}" method="GET">
        <input class="form-control form-control-sm" type="search" name="search" placeholder="Search products">
        <button type="submit" class="btn btn-warning btn-sm ms-1">
            <i class="fa fa-search"></i>
        </button>
    </form>
@endsection
@section('latest_Products')
    <section class="py-5 bg-light">
        <div class="container">

            <!-- Section Heading -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Latest Products</h2>
                <a href="{{ route('viewallproducts') }}" class="btn btn-warning fw-bold">
                    View All Products
                </a>
            </div>

            <!-- Products Grid -->
            <div class="row g-4">

                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="card border-0 shadow-sm h-100">

                            <!-- Product Image -->
                            <a href="{{ route('product.detail', $product->id) }}">
                                <img src="{{ asset('uploads/products/' . $product->image) }}" class="card-img-top"
                                    alt="{{ $product->name }}">
                            </a>

                            <!-- Product Info -->
                            <div class="card-body text-center d-flex flex-column">

                                <h6 class="fw-semibold mb-1">
                                    {{ $product->name }}
                                </h6>

                                <p class="text-warning fw-bold mb-2">
                                    ${{ $product->price }}
                                </p>

                                <div class="mt-auto d-grid gap-2">
                                    <a href="{{ route('product.detail', $product->id) }}" class="btn btn-dark btn-sm">
                                        View Details
                                    </a>
                                    <button class="btn btn-outline-warning btn-sm">
                                        <i class="fa fa-cart-plus me-1"></i> Add to Cart
                                    </button>
                                </div>

                            </div>

                            <!-- Badge -->
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                New
                            </span>

                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
