<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ShopNova | Product Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/fontawesome.min.css"
        integrity="sha512-M5Kq4YVQrjg5c2wsZSn27Dkfm/2ALfxmun0vUE3mPiJyK53hQBHYCVAtvMYEC7ZXmYLg8DVG4tF8gD27WmDbsg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-light">

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow sticky-top">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand fw-bold text-warning d-flex align-items-center" href="{{ route('home') }}">
                <i class="fa fa-bag-shopping me-2"></i>ShopNova
            </a>

            <!-- Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navMenu">

                <!-- Center Menu -->
                <ul class="navbar-nav mx-auto fw-semibold">
                    <li class="nav-item">
                        <a class="nav-link active text-warning" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>

                <!-- Right Side -->
                <div class="d-flex align-items-center gap-3">

                    <!-- Search -->

                    <form class="d-flex" action="{{ route('productuser.search') }}" method="GET">

                        <input class="form-control form-control-sm" type="search" name="search"
                            placeholder="Search products">
                        <button type="submit" class="btn btn-warning btn-sm ms-1">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <!-- Cart -->
                    <a href="{{ route('cart.page') }}" class="position-relative text-light">
                        <i class="fa fa-shopping-cart fs-5"></i>
                        <span class="badge bg-warning text-dark position-absolute top-0 start-100 translate-middle">
                            {{ $count }}
                        </span>
                    </a>

                    <!-- User Auth -->
                    @if (Auth::check())
                        <div class="dropdown">
                            <a class="btn btn-outline-warning btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-user me-1"></i> Dashboard
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fa fa-gauge me-1"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.orders') }}">
                                        <i class="fa fa-box me-1"></i> My Orders
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-responsive-nav-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-responsive-nav-link>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-warning btn-sm">
                            <i class="fa fa-user me-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-warning btn-sm text-dark fw-bold">
                            Sign Up
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </nav>
    <!-- ================= PRODUCT DETAIL ================= -->
    <section class="py-5">
        <div class="container">
            <x-message></x-message>

            <div class="row g-4">
                <!-- Product Image -->
                <div class="col-md-6">
                    <img src="{{ asset('uploads/products/' . $product->image) }}" class="w-100 rounded shadow-sm"
                        alt="Product Image">
                </div>

                <!-- Product Info -->
                <div class="col-md-6">
                    <h2 class="fw-bold">{{ $product->name }}</h2>
                    <h4 class="fw-bold text-dark my-3">PKR {{ $product->price }}</h4>

                    <!-- Add to Cart -->
                    <form action="{{ route('add_to_cart', $product->id) }}" method="POST">
                        @csrf

                        <label class="fw-semibold">Quantity</label>
                        <input type="number" name="quantity" min="1" value="1"
                            class="form-control w-25 my-3">

                        <button class="btn btn-warning fw-bold w-100 py-3">
                            <i class="fa fa-cart-plus me-2"></i> Add to Bag
                        </button>
                    </form>

                    <p class="text-success fw-semibold mt-3 text-end">
                        <i class="fa fa-check-circle me-1"></i> In Stock
                    </p>

                    <h6 class="fw-semibold mt-4">Description</h6>
                    <p class="text-muted">{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= REVIEWS SECTION ================= -->
    <section id="reviews" class="py-5 bg-white">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Customer Reviews</h4>

                @auth
                    <button class="btn btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#reviewModal">
                        <i class="fa fa-pen me-1"></i> Write a Review
                    </button>
                @endauth
            </div>

            <!-- Example Review -->
            <div class="card shadow-sm mb-3">
                @foreach ($productRating as $rating)
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $rating->user->name }}</strong>
                            <div class="">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating->rating)
                                        <i class="fa fa-star text-warning"></i>
                                    @else
                                        <i class="fa fa-star text-secondary"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p class="text-muted mt-2 mb-0">
                            {{ $rating->comment }}
                            {{-- Excellent product quality. Highly recommended! --}}
                        </p>
                    </div>
                @endforeach
            </div>

            @guest
                <div class="alert alert-warning text-center">
                    Please <a href="{{ route('login') }}" class="fw-bold">login</a> to write a review.
                </div>
            @endguest

        </div>
    </section>

    <!-- ================= REVIEW MODAL ================= -->
    <div class="modal fade" id="reviewModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Write a Review</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('ratings.store', $product->id) }}" method="POST" name="productRatingForm"
                    id="productRatingForm">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="fw-semibold">Rating</label>
                            <select name="rating" class="form-select" required>
                                <option value="">Select rating</option>
                                <option value="5">★★★★★ Excellent</option>
                                <option value="4">★★★★☆ Very Good</option>
                                <option value="3">★★★☆☆ Good</option>
                                <option value="2">★★☆☆☆ Fair</option>
                                <option value="1">★☆☆☆☆ Poor</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Review</label>
                            <textarea name="comment" class="form-control" rows="4" placeholder="Share your experience..." required></textarea>
                            @error('comment')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-warning fw-bold">Submit Review</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- <section>
        <script>
            $("#productRatingForm").submit(function(event) {
                event.preventdefault();
                $.ajax({
                    url: "{{ route('ratings.store',$product->id) }}",
                    type: 'post',
                    data: $(this).serializeArray(),
                    dataType: 'json',
                    success: function(response) {

                    }

                });

            });
        </script>
    </section> --}}

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
