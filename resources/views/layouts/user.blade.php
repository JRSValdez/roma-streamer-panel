<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    @include('layouts.styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->


        <!-- right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" role="button"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    <i class="fas fa-sign-out-alt"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->

            <div >
                @yield('content')
            </div><!-- /.container-fluid -->
    

    @include('layouts.footer')
