<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ShopNova | Online Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow sticky-top">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand fw-bold text-warning d-flex align-items-center" href="{{route('home')}}">
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
                        <a class="nav-link active text-warning" href="{{route('home')}}">Home</a>
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
                    <form class="d-flex">
                        <input class="form-control form-control-sm" type="search" placeholder="Search products">
                        <button class="btn btn-warning btn-sm ms-1">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <!-- Cart -->
                    <a href="{{route('cart.page')}}" class="position-relative text-light">
                        <i class="fa fa-shopping-cart fs-5"></i>
                        {{-- <span class="badge bg-warning text-dark position-absolute top-0 start-100 translate-middle">
                            {{ $count }}
                        </span> --}}
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
                                    <a class="dropdown-item" href="{{route('users.orders')}}">
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


    <!-- ================= HERO ================= -->
    <section class="bg-dark text-light py-5"
        style="background:url('https://source.unsplash.com/1600x600/?shopping') center/cover;">
        <div class="container text-center py-5">
            <h1 class="display-4 fw-bold">
                Shop Smarter with <span class="text-warning">ShopNova</span>
            </h1>
            <p class="lead mb-4">
                Premium products • Best prices • Fast delivery
            </p>
            <a href="#" class="btn btn-warning btn-lg fw-bold me-2">Shop Now</a>
            <a href="#" class="btn btn-outline-light btn-lg fw-bold">Explore</a>
        </div>
    </section>

    <!-- ================= FEATURES ================= -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow rounded">
                        <i class="fa fa-truck-fast fs-1 text-warning mb-3"></i>
                        <h5>Fast Delivery</h5>
                        <p class="text-muted">Quick & reliable shipping nationwide</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow rounded">
                        <i class="fa fa-shield-halved fs-1 text-warning mb-3"></i>
                        <h5>Secure Payment</h5>
                        <p class="text-muted">100% secure checkout experience</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow rounded">
                        <i class="fa fa-headset fs-1 text-warning mb-3"></i>
                        <h5>24/7 Support</h5>
                        <p class="text-muted">We are always here for you</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= LATEST PRODUCTS ================= -->
    <section class="py-5">
        @yield('latest_Products')

        @yield('all_Products')

        @yield('Detail_Product')

        @yield('View_Cart')

        @yield('User_Ratings')
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-dark text-light pt-5">
        <div class="container">
            <div class="row g-4">

                <div class="col-md-4">
                    <h5 class="text-warning fw-bold">ShopNova</h5>
                    <p>Your trusted online shopping destination.</p>
                </div>

                <div class="col-md-2">
                    <h6 class="fw-bold">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Home</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Shop</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Contact</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h6 class="fw-bold">Support</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Privacy Policy</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Terms</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h6 class="fw-bold">Follow Us</h6>
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

            </div>

            <hr class="border-secondary">

            <p class="text-center small mb-0 pb-3">
                © 2025 ShopNova. All Rights Reserved
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
