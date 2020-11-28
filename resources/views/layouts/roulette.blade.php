<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    @include('layouts.styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    @yield('content')

    @include('layouts.footer')
