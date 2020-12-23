<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    @include('layouts.styles')
    <style>
        .sign-out-button {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 2;
        }
        .sign-out-button a {
            color: white !important;
            text-decoration: none;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed" style="overflow-x: hidden">

<div>
    <div class="sign-out-button">
        <a class="" href="{{ route('logout') }}" role="button"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Cerrar sesión
            <i class="fas fa-sign-out-alt"></i>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    @yield('content')
</div>

{{--@include('layouts.footer')--}}
