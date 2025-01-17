<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
<!-- <link rel="stylesheet" href="{{ asset('css/datatables.css') }}"> -->
    @include('layouts.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- right navbar links -->
        <ul class="navbar-nav ml-auto">
{{--            <li class="nav-item">
                <img src="{{ asset('/storage/user_images/'.Auth::user()->img_src )}}" class="img-circle elevation-2"
                     alt="User Image">
                <a class="nav-link" href="{{ route('logout') }}" role="button"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    <i class="fas fa-sign-out-alt"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>--}}
            <li class="dropdown user-menu">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <img src="{{ asset('/storage/user_images/'.Auth::user()->img_src )}}" class="user-image"
                         alt="User Image">
                    <span class="d-hidden-mini">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu sidebar-dark-primary">
                    <li class="user-header">
                        <img src="{{ asset('/storage/user_images/'.Auth::user()->img_src )}}" class="img-circle"
                             alt="User Image">
                        <p style="color: white;">{{ Auth::user()->name }}</p>
                    </li>
                    <li class="user-footer">
                        <div class="fa-pull-left">
                            <a href="{{route('showStreamerConfig')}}" class="btn btn-primary btn-flat">Perfil</a>
                        </div>
                        <div class="fa-pull-right">
                            <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="btn btn-danger btn-flat">Cerrar sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/home" class="brand-link">
            <img src="{{ asset('/storage/site_logo.png' )}}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light"> Streamer </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('/storage/user_images/'.Auth::user()->img_src )}}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('showStreamerConfig')}}" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="mx-auto">
                    @if(isset(Auth::user()->streamer_attributes->live ))
                        @if(Auth::user()->streamer_attributes->live == 'on')
                            <a id="btnOn" style="display: block" class="btn btn-success switchStatus">
                                <i class="fas fa-play"></i> Online
                            </a>
                            <a id="btnOff" style="display: none" class="btn btn-danger switchStatus">
                                <i class="fas fa-stop"></i> Offline
                            </a>
                        @else
                            <a id="btnOn" style="display: none" class="btn btn-success switchStatus">
                                <i class="fas fa-play"></i> Online
                            </a>
                            <a id="btnOff" style="display: block" class="btn btn-danger switchStatus">
                                <i class="fas fa-stop"></i> Offline
                            </a>
                        @endif
                    @else
                        <a id="btnOn" style="display: none" class="btn btn-success switchStatus">
                            <i class="fas fa-play"></i> Online
                        </a>
                        <a id="btnOff" style="display: block" class="btn btn-danger switchStatus">
                            <i class="fas fa-stop"></i> Offline
                        </a>
                    @endif

                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-header">Accesos</li>
                    <li class="nav-item">
                        <a href="{{ url('/streamer') }}"
                           class="nav-link {{request()->routeIs('streamer.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/streamer/message') }}"
                           class="nav-link {{request()->routeIs('streamer.messages') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Mensajes
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/streamer/codigos') }}"
                           class="nav-link {{request()->routeIs('streamer.codigos') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-barcode"></i>
                            <p>
                                Códigos
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/streamer/roulette') }}"
                           class="nav-link {{request()->routeIs('streamer.roulette') ? 'active' : '' }}">
                            <i class="nav-icon fab fa-superpowers"></i>
                            <p>
                                Ruleta
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/streamer/votaciones') }}"
                           class="nav-link {{request()->routeIs('streamer.votaciones') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-rocket"></i>
                            <p>
                                Votaciones
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/streamer/config')}}"
                           class="nav-link {{request()->routeIs('showStreamerConfig') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Configuración
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item collapse" style="display: none">
                        <a href="{{url('/streamer/premios')}}" class="nav-link">
                            <i class="nav-icon fas fa-gift"></i>
                            <p>
                                Premios
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>


                    <!--  <li class="nav-header">MISCELLANEOUS</li>
                     <li class="nav-item">
                         <a href="https://adminlte.io/docs/3.0" class="nav-link">
                             <i class="nav-icon fas fa-file"></i>
                             <p>Documentation</p>
                         </a>
                     </li> -->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->

        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="modal">
            @yield('modal')
        </section>
        <section>
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <span class="m-0 text-dark" style="font-size: 20px">@yield('panel_actual')</span>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/streamer')}}">Inicio</a></li>
                                <li class="breadcrumb-item active">@yield('page_actual')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.footer_streamer')
</div>
<!-- ./wrapper -->
@include('layouts.js')
<script>
    $(document).ready(function () {

        $('.switchStatus').on('click',function () {
            $('.wrapper').css('cursor','pointer');

            $.ajax({
                method: 'POST',
                url: '{{route('switchStatus')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                data: {
                    switch: true
                },
                success: function (response) {
                    if (response.success) {
                        if (response.status == 'on') {
                            console.log('on');
                            $('#btnOff').css('display', 'none');
                            $('#btnOn').css('display', 'block');

                        } else {
                            console.log('off');
                            $('#btnOff').css('display', 'block');
                            $('#btnOn').css('display', 'none');
                        }
                    }
                    $('.wrapper').css('cursor','default');
                },
                error: function () {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-center',
                        showConfirmButton: false,
                        timer: time,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'Error al cambiar status'
                    });
                    $('.wrapper').css('cursor','default');
                }
            })
        });
    });

</script>
@yield('scripts')
</body>
</html>
