<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        {{-- Yield the page title --}}
        @hasSection('title')
            <title>@yield('title')</title>
        @else
            <title>Results - justGO</title>
        @endif

        {{-- Vite Files --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Icons CSS -->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/icons/css/all.min.css') }}" />
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('css/compiled-jquery.css') }}">
    </head>

    @php
        // Add page args as classes on the body
        if ( isset($_SERVER['REQUEST_URI']) ) {
            $page_full_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $page_path = explode("/", $page_full_path );
            $page_parent = '';

            if ( $page_full_path == '/' ) {
                $body_classes[] = 'page-home';
            } else {
                foreach ($page_path as $arg_key => $arg_name) {
                    if(!$arg_name) {
                        continue;
                    }
                    $body_classes[] = 'page' . $page_parent . '-' . $arg_name;
                    $page_parent = $page_parent . '-' .$arg_name;
                }
            }
        }

        // Query strings
        if ( isset($_SERVER['QUERY_STRING']) ) {
            parse_str($_SERVER['QUERY_STRING'], $page_args);

            if( array_key_exists('page', $page_args) ) {
                $body_classes[] = 'page-pagination-paged';
            }
        }
    @endphp

    <body class="antialiased bg-light {{ implode(" ", $body_classes) }} @yield('body_classes')">
        <div class="header-area">
        	<div class="container-sm bg-white px-4 pt-4">
                <div class="row">
                    <div class="col align-self-center">
                        <a href="/">
                            <img src="images/logo.svg" class="img-fluid" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="btn btn-link float-end text-black d-md-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        	<i data-feather="menu"></i>
                        </a>
                        <nav class="navbar navbar-expand-md float-end p-0 d-none d-md-block">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                	<a class="nav-link active" href="#">Book</a>
                                </li>
                                <li class="nav-item">
                                	<a class="nav-link" href="#">Help</a>
                                </li>
                                <li class="nav-item">
                                	<a class="nav-link" href="#">Legal</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        {{-- Render Content --}}
        @yield('content')

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <div class="list-group list-group-flush">
                    <a class="list-group-item" href="#">Bus</a></li>
                    <a class="list-group-item" href="#">Flight</a></li>
                    <a class="list-group-item" href="#">Best Deals</a></li>
                    <a class="list-group-item" href="#">How to Pay</a></li>
                    <a class="list-group-item" href="#">Groups</a></li>
                    <a class="list-group-item" href="#">Corporate</a></li>
                    <a class="list-group-item" href="#">Sell tickets</a></li>
                    <a class="list-group-item" href="#">List your Bus</a></li>
                </div>
            </div>
        </div>

        {{-- Header Scripts Stack --}}
        @stack('scripts-footer')

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.matchHeight-min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/complied-jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <!-- Plugins JavaScript -->
        <script src="https://unpkg.com/feather-icons"></script>
		<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    </body>
</html>
