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
	<!-- !! Adsense::show('rectangle') !! -->
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
                            <img src="{{ asset('/storage/user_images/'.$streamer->img_src)}}" width="125px">
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
                    <!-- !! Adsense::show('responsive') !! -->
                    <!-- !! Adsense::show('responsive') !! -->
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
                        <button id="mensajeval"
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
                    <!-- !! Adsense::show('responsive') !! -->
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
            let streamer = '{!! $nombre_streamer !!}';
            $.post('/user/canjearcodigo', {codigo, id_free_fire, nombre_free_fire, servidor, streamer}, function (response) {
                let icono;
                let titulo;
                if (response == 'add') {
                    icono = 'success';
                    titulo = 'El código se canjeo correctamente.'
                    $('#form-canjear-codigo').trigger('reset');
                } else if (response == 'noadd') {
                    icono = 'error';
                    titulo = 'El código ingresado no es correcto.'
                }else if (response == 'inactivo') {
                    icono = 'warning';
                    titulo = 'El código ingresado no esta activado.'
                } else {
                    icono = 'warning';
                    titulo = 'El código ingresado ya fue registrado.'
                }

                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 7000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })

                Toast.fire({
                  icon: icono,
                  title: titulo
                })
            });
            e.preventDefault();
        });

        $('#form-mensaje').submit(e => {
            let mensaje = $('textarea#mensaje').val();
            let streamer = '{!! $nombre_streamer !!}';
            $.post('/user/mensaje', {mensaje, streamer}, function (response) {
                let icono;
                let titulo;
                if (response == 'enviado') {
                    icono = 'success';
                    titulo = 'Mensaje enviado.'
                    $('#form-mensaje').trigger('reset');
                    $('#cant_char').html('200');
                } else if (response == 'noenviado') {
                    icono = 'error';
                    titulo = 'El mensaje no fue enviado.'
                } else {
                    icono = 'warning';
                    titulo = 'Cantidad maxima de caracteres alcanzada.'
                }

                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 7000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })

                Toast.fire({
                  icon: icono,
                  title: titulo
                })
            });
            e.preventDefault();
        });

        $('#form-ruleta').submit(e => {
        	let streamer = '{!! $nombre_streamer !!}';
            $.post('/user/ruleta',{streamer}, function (response) {
                let icono;
                let titulo;
                if (response == 'add') {
                    icono = 'success';
                    titulo = 'Se registro en la ruleta.'
                    $('#form-ruleta').trigger('reset');
                } else if (response == 'noadd') {
                    icono = 'warning';
                    titulo = 'Ya esta registrado en la ruleta.'
                } else {
                    icono = 'error';
                    titulo = 'No hay ruletas activas.'
                }

                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 7000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })

                Toast.fire({
                  icon: icono,
                  title: titulo
                })
            });
            e.preventDefault();
        });

        $('#mensajeval').on('click', function(){
        	let mensaje = $('textarea#mensaje').val();
        	if (mensaje.length === 0) {
        		$('#cant_char').html('200');
        	}        	
        });

        $('#votacion').on('click', function(){
        	$('#registrado').hide();        	
        	$('#add-votacion').hide();        	
        });



        let cant = 1;
        let resta = 0;
        let total = 200;
        $(document).on('keyup', '#mensaje', function () {//*
            let valor = $(this).val();
            if (valor.length > 0) {
                cant = (total - valor.length);                
                if (valor.length <= 200 && valor.length >= 0) {
                	$('#cant_char').html(cant);
                }
            }
        });
    });

    function ans(id) {
    	let streamer = '{!! $nombre_streamer !!}';
    	let qid = '{!! $question_id !!}';
        $.ajax({
            url: '/user/registrarvotacion',
            type: 'POST',
            data: {id, streamer, qid},
        }).done(function(response){
            let icono;
            let titulo;
        	if (response == 'add') {
                icono = 'success';
                titulo = 'Se registro correctamente.'
        	}else{
        		icono = 'warning';
                titulo = 'Ya esta registrado para esta votación.'
        	}

            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 7000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: icono,
              title: titulo
            })
        });
    }
</script>
</body>
<!-- @include('layouts.footer_streamer') -->
</html>
