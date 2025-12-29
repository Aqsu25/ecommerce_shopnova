<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Shop :: Administrative Panel</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('PhpYoutube/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('PhpYoutube/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('PhpYoutube/css/custom.css') }}">

    {{-- tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- boostrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <div class="navbar-nav pl-2">
                <!-- <ol class="breadcrumb p-0 m-0 bg-white">
      <li class="breadcrumb-item active">Dashboard</li>
     </ol> -->
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                        <img src="{{ asset('PhpYoutube/img/avatar5.png') }}" class='img-circle elevation-2'
                            width="40" height="40" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                        <h4 class="h4 mb-0"><strong>{{ Auth::user()->name }}</strong></h4>
                        <div class="mb-3">{{ Auth::user()->email }}</div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>

                        <!-- Log out               -->
                        <div class="list-inline-item logout text-red">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt mr-2 text-red"></i>
                                    Logout
                                </x-responsive-nav-link>
                            </form>
                        </div>

                        {{-- <a href="{{ route('logout') }}" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </a> --}}
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('home')}}" class="brand-link">
                <img src="{{ asset('PhpYoutube/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light text-capitilize">ShopNova
                </span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        {{-- dropdown-category --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p class="d-inline">Category</p>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.create') }}">
                                        <i class="fas fa-plus me-2"></i> Add Category
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        <i class="fas fa-list me-2"></i> View Categories
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- dropdown-sub-category --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p class="d-inline">Sub-Category</p>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('subcategory.create') }}">
                                        <i class="fas fa-plus me-2"></i> Create
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('subcategory.index') }}">
                                        <i class="fas fa-list me-2"></i> View
                                    </a>
                                </li>
                            </ul>
                        </li>


                        {{-- dropdown-Product --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="nav-icon fas fa-tag"></i>
                                <p class="d-inline">Product</p>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('products.create') }}">
                                        <i class="fas fa-plus me-2"></i> Create
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('products.index') }}">
                                        <i class="fas fa-list me-2"></i> View
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- dropdown-order --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="nav-icon fas fa-shopping-bag"></i>
                                <p class="d-inline">Orders</p>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('view.order') }}">
                                        <i class="fas fa-plus me-2"></i> View
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('products.index') }}">
                                        <i class="fas fa-list me-2"></i> Product-View
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- dropdown-user --}}
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="nav-icon  fas fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('dashboard')
                <!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                @yield('content')
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">

            <strong>Copyright &copy; 2014-2022 AmazingShop All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('PhpYoutube/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('PhpYoutube/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('PhpYoutube/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('PhpYoutube/js/demo.js') }}"></script>
</body>

</html>
