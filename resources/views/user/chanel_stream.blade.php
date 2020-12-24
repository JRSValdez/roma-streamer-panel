<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{  Auth::user()->site_name }}</title>
    @include('layouts.styles')
    <script src="{{ asset('js/confetti.min.js') }}"></script>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background-color: #121212;
            box-sizing: border-box;
            animation: BGcolorChanging-6colors 10s linear infinite alternate both;
        }

        @keyframes BGcolorChanging-6colors {
            0% {
                background: #000000;
            }
            20% {
                background: #cc85f5;
            }
            40% {
                background: #db0267;
            }
            60% {
                background: #E010F5;
            }
            80% {
                background: #2F45A0;
            }
            100% {
                background: #582FA0;
            }
        }

        .anyClass {
            height: auto;
            max-height: 225px;
            overflow-y: scroll;
        }

        .bg-color {
            background-color: blue;
            border-radius: 5px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .showwinner {
            animation: aumento 2s linear 5 alternate both;
            /*animation: aumento 2s linear infinite alternate both;*/
        }

        @keyframes aumento {
            0% {
                font-size: 20px
            }
            50% {
                left: 30px;
            }
            100% {
                left: 30px
            }
        }
    </style>
</head>
<body>
@include('user.modales.modal_canjear_codigo')
@include('user.modales.modal_votaciones')
@include('user.modales.modal_ruleta')
@include('user.modales.modal_mensaje')
<div class="wrapper">
    <div class="sign-out-button text-right m-3">
        <a class="" href="{{ route('logout') }}" role="button"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #fff">
            Cerrar sesión
            <i class="fas fa-sign-out-alt"></i>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-lg-5">
                    <div>
                        <div>
                            @php($img = Auth::user()->img_src)
                            <img src="{{ asset('/storage/user_images/'.$img )}}" width="125px">
                        </div>
                        <div class="mt-3">
                            <label style="color: #fff; font-size: 30px;">{{ $nombre_streamer }}</label>
                            <div class="">
                                @isset($streamer->streamer_attributes->live)
                                    @if($streamer->streamer_attributes->live == 'on')
                                        <label style="padding:5px; background:green;color: white; border-radius: 20px; font-size: 15px;">
                                            Online
                                        </label>
                                    @else
                                        <label style="padding:5px; background:red;color: white; border-radius: 20px; font-size: 15px;">
                                            Offline
                                        </label>
                                    @endif
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div>
                        <img src="{{ asset('/storage/user_images/'.$logo )}}" width="125px">
                    </div>
                    <div class="mt-3">
                        <button id="canjear_codigo"
                                style="color: #fff; font-size: 25px; border: 3px solid #fff; border-radius: 35px; width: 80%"
                                class="btn btn-outline-secondary btn-lg" data-toggle="modal"
                                data-target="#canjear_codigos">Canjear código
                        </button>
                    </div>
                    <div class="mt-3">
                        <button id="votacion"
                                style="color: #fff; font-size: 25px; border: 3px solid #fff; border-radius: 35px; width: 80%"
                                class="btn btn-outline-secondary btn-lg" data-toggle="modal" data-target="#votaciones">
                            Votaciones
                        </button>
                    </div>
                    <div class="mt-3">
                        <button id="canjear_codigo"
                                style="color: #fff; font-size: 25px; border: 3px solid #fff; border-radius: 35px; width: 80%"
                                class="btn btn-outline-secondary btn-lg" data-toggle="modal" data-target="#ruleta">
                            Ruleta
                        </button>
                    </div>
                    <div class="mt-3">
                        <button id="canjear_codigo"
                                style="color: #fff; font-size: 25px; border: 3px solid #fff; border-radius: 35px; width: 80%"
                                class="btn btn-outline-secondary btn-lg" data-toggle="modal" data-target="#mensaje">
                            Enviar mensaje
                        </button>
                    </div>
                    <div class="mt-3">
                        <button id="canjear_codigo"
                                style="color: #fff; font-size: 25px; border: 3px solid #fff; border-radius: 35px; width: 80%"
                                class="btn btn-outline-secondary btn-lg" disabled="true">Apuestas
                        </button>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div></div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <footer class="text-left m-3" style="color: #fff">
        <strong>
            Copyright &copy; {!! date('Y') !!}
            <a target="_blank" href="http://roma-solutions.com">Roma Solutions</a>.
        </strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

</div>
@include('layouts.js')
<script type="text/javascript">
    function cerrar(elemento) {
        document.getElementById(elemento).style.display = "none";
    }
    function ans(id) {
        $.ajax({
            url: '/user/registrarvotacion',
            type: 'POST',
            data: {id},
        }).done(function(response){
        	if (response == 'add') {
        		alert('Se registro correctamente')
        	}else{
        		alert('Ya esta registrado en esta votacion');
        	}      
        });
    }
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#form-canjear-codigo').submit(e => {
            let codigo = $('#codigo').val();
            let id_free_fire = $('#id_free_fire').val();
            let nombre_free_fire = $('#nombre_free_fire').val();
            let servidor = $('#servidor').val();
            $.post('/user/canjearcodigo', {codigo, id_free_fire, nombre_free_fire, servidor}, function (response) {
                console.log(response)
                if (response == 'add') {
                    $('#add').hide('slow');
                    $('#add').show(3000);
                    $('#add').hide(2000);
                    $('#form-canjear-codigo').trigger('reset');
                } else if (response == 'noadd') {
                    $('#noadd').hide('slow');
                    $('#noadd').show(3000);
                    // $('#noadd').hide(2000);
                } else {
                    $('#canjeado').hide('slow');
                    $('#canjeado').show(3000);
                    // $('#canjeado').hide(2000);
                }
            });
            e.preventDefault();
        });

        $('#form-mensaje').submit(e => {
            let mensaje = $('textarea#mensaje').val();
            let streamer = '{!! $nombre_streamer !!}';
            $.post('/user/mensaje', {mensaje, streamer}, function (response) {
                console.log(response)
                if (response == 'enviado') {
                    $('#enviado').hide('slow');
                    $('#enviado').show(3000);
                    $('#enviado').hide(2000);
                    $('#form-mensaje').trigger('reset');
                } else if (response == 'noenviado') {
                    $('#noenviado').hide('slow');
                    $('#noenviado').show(3000);
                    // $('#noadd').hide(2000);
                } else {
                    $('#canjeado').hide('slow');
                    $('#canjeado').show(3000);
                    // $('#canjeado').hide(2000);
                }
            });
            e.preventDefault();
        });

        $('#form-ruleta').submit(e => {
            $.post('/user/ruleta', function (response) {
                if (response == 'add') {
                    $('#add-rul').hide('slow');
                    $('#add-rul').show(5000);
                    $('#add-rul').hide(3000);
                    $('#form-ruleta').trigger('reset');
                } else if (response == 'noadd') {
                    $('#noadd-ruls').hide('slow');
                    $('#noadd-ruls').show(5000);
                    $('#noadd-ruls').hide(3000);
                } else {
                    $('#noadd-rul').hide('slow');
                    $('#noadd-rul').show(5000);
                    $('#noadd-rul').hide(3000);
                }
            });
            e.preventDefault();
        });

        

        let cant = 1;
        let resta = 0;
        let total = 200;
        $(document).on('keyup', '#mensaje', function () {//*
            let valor = $(this).val();
            if (valor != '') {
                cant = (total - valor.length);
                $('#cant_char').html(cant);
            }
        });
    });
</script>
</body>
<!-- @include('layouts.footer_streamer') -->
</html>
