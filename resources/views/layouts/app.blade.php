<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" />
    <style>
        .sortable {
            cursor: pointer;
            user-select: none;
        }
        .custom-modal-position {
            display: flex;
            align-items: flex-start;
            margin-top: 10vh;
        }
    </style>
    <title>@yield('title')</title>
    @yield('styles')
</head>
<body>
    <div id="wrapper">
        <header id="header" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid p-0">
                <div id="header-logo">
                    <div class="d-flex justify-content-center align-items-center h-100 w-100">
                        <h5 class="m-0 fw-bold text-primary">Hiring-Exam</h5>
                    </div>
                </div>
                
                <a href="#" id="button-menu"><i class="fa-solid fa-bars"></i></a>
                <a href="#" id="button-menu-close"><i class="fa-solid fa-xmark"></i></a>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/profile-45x45.png') }}" alt="User" title="User" class="round" /> {{ auth()->guard('web')->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('edit-profile') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('change-password') }}">Change Password</a></li>
                            <li>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    Logout
                                </button>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        <nav id="column-left">
            <ul id="menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a class="collapsed {{ request()->routeIs('products', 'products.create', 'products.edit') ? 'active' : '' }}" 
                       data-bs-toggle="collapse" 
                       href="#products-menu" 
                       role="button" 
                       aria-expanded="{{ request()->routeIs('products', 'products.create', 'products.edit') ? 'true' : 'false' }}" 
                       aria-controls="products-menu">
                        <i class="fa-solid fa-heart"></i> Products
                    </a>
                    <ul id="products-menu" class="collapse {{ request()->routeIs('products', 'products.create', 'products.edit') ? 'show' : '' }}">
                        <li>
                            <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'active' : '' }}">Overview</a>
                        </li>
                        <li>
                            <a href="{{ route('products.create') }}" class="{{ request()->routeIs('products.create') ? 'active' : '' }}">Create Product</a>
                        </li>
                    </ul>
                </li>  
                <li>
                    <a class="collapsed {{ request()->routeIs('categories', 'categories.create', 'categories.edit') ? 'active' : '' }}" 
                       data-bs-toggle="collapse" 
                       href="#categories-menu" 
                       role="button" 
                       aria-expanded="{{ request()->routeIs('categories', 'categories.create', 'categories.edit') ? 'true' : 'false' }}" 
                       aria-controls="categories-menu">
                        <i class="fa-solid fa-table-list"></i> Categories
                    </a>
                    <ul id="categories-menu" class="collapse {{ request()->routeIs('categories', 'categories.create', 'categories.edit') ? 'show' : '' }}">
                        <li>
                            <a href="{{ route('categories') }}" class="{{ request()->routeIs('categories') ? 'active' : '' }}">Overview</a>
                        </li>
                        <li>
                            <a href="{{ route('categories.create') }}" class="{{ request()->routeIs('categories.create') ? 'active' : '' }}">Create Category</a>
                        </li>
                    </ul>
                </li>           
            </ul>
        </nav>        
        <div id="content">
           @yield('content')
        </div>
        <footer>
            <p>&copy; 2025 Aaron Aludo - Backend Developer Exam</p>
        </footer>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-position">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <div class="d-flex justify-content-center w-100">
                            <button class="btn btn-danger w-100" type="submit" id="submit-button-logout">
                                <span id="loader-logout" class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                                Logout
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main-form-loader-animation.js') }}"></script>
    <script>
        document.getElementById('logout-form').addEventListener('submit', function(e) {
            const submitButton = document.getElementById('submit-button-logout');
            const loader = document.getElementById('loader-logout');

            submitButton.disabled = true;
            loader.classList.remove('d-none');
        });
    </script>
    @yield('scripts')
</body>
</html>