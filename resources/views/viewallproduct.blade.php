@extends('homes.main')

@section('all_Products')

<div class="container py-5">

    <!-- Page Heading -->
    <div class="text-center mb-5">
        <h2 class="fw-bold display-6 text-dark">
            All <span class="text-warning">Products</span>
        </h2>
        <p class="text-muted">
            Browse our complete collection
        </p>
    </div>

    <!-- Products Grid -->
    <div class="row justify-content-center g-4">

        @foreach ($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">

                <div class="card border-0 shadow-sm h-100">

                    <!-- IMAGE -->
                    <div class="position-relative bg-light text-center p-3">

                        <!-- Discount Badge -->
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                            35% OFF
                        </span>

                        <!-- Add to Cart Icon -->
                        <a href="#"
                           class="position-absolute top-0 end-0 m-2 bg-white rounded-circle p-2 shadow text-dark">
                            <i class="fa fa-cart-plus"></i>
                        </a>

                        <!-- Product Image -->
                        <a href="{{ route('product.detail', $product->id) }}">
                            <img src="{{ asset('uploads/products/' . $product->image) }}"
                                 class="img-fluid"
                                 style="height:220px; object-fit:contain;"
                                 alt="Product Image">
                        </a>
                    </div>

                    <!-- CONTENT -->
                    <div class="card-body text-start">

                        <h6 class="fw-semibold fs-6 mb-1 text-secondary">
                            {{ $product->name }}
                        </h6>

                        <p class="fw-bold fs-6 text-dark mb-0">
                            PKR {{ $product->price }}
                        </p>

                    </div>

                </div>

            </div>
        @endforeach

    </div>

    <!-- Back / View All Button -->
    <div class="text-center mt-5">
        <a href="{{ route('home') }}" class="btn btn-warning btn-lg fw-bold px-5 shadow">
            Latest Products
        </a>
    </div>

</div>

@endsection
