<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Streamer | Ganadores Codigo</title>
	@include('layouts.styles')
	<script src="{{ asset('js/confetti.min.js') }}"></script>
	<style type="text/css">
		body{
			margin: 0;
			padding: 0;
			background-color: #121212;
			box-sizing: border-box;
			animation: BGcolorChanging-6colors 10s linear infinite alternate both;
		}
		@keyframes BGcolorChanging-6colors{
			0%{
				background: #000000;
			}
			20%{
				background: #cc85f5;
			}
			40%{
				background: #db0267;
			}
			60%{
				background: #E010F5;
			}
			80%{
				background: #2F45A0;
			}
			100%{
				background: #582FA0;
			}
		}

		.anyClass {
			height: auto;
	     	max-height:225px;
	     	overflow-y: scroll;
		}
		.bg-color{
			background-color: blue;
			border-radius: 5px;
			padding-left: 10px;
			padding-right: 10px;
		}
		.showwinner{
			animation: aumento 2s linear 5 alternate both;
			/*animation: aumento 2s linear infinite alternate both;*/
		}
		@keyframes aumento {
            0% {font-size: 20px}
            50% {left: 30px;}
            100% {left: 30px}
        }
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="text-center mt-0" style="background-color: rgba(0, 0, 0, 0.5);">
      		<label style="color: #BDC2CC; font-size: 30px;">Ganador del sorteo con código: <i>{!! $codigo !!}</i></label>
      	</div>
      	<div class="text-center">
      		<label style="color: #fff; font-size: 20px;">Tipo de sorteo: <i>{!! $elegir_ganador !!}</i></label>
      	</div>
        <div class="content mt-3">        	
	      <div class="container-fluid">	      	
	        <div class="row">
	          <!-- left column -->
	          <div class="col-md-7 text-center ml-5 mt-5">
	          	<div>
	          		<div>
	          			@php($img = Auth::user()->img_src)
	          			<img src="{{ asset('/storage/user_images/'.$img )}}" width="125px">
	          		</div>
	          		<div>
	          			<label style="color: #fff; font-size: 30px;">{{ Auth::user()->name }}</label>
	          		</div>
	          	</div>
	          	<div class="text-center ml-4 mt-3">
	          		<label id="felicidades" style="font-size: 45px; color: #fff;"></label><br>
	          		<label id="show_winner" style="font-size: 30px; color: #fff;">Buena suerte!</label>
	          	</div>
	          </div>

	          <div class="col-md-4 text-center" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 15px; padding: 15px;">
	          	<div class="mt-0">
	          		<label style="color: #fff; font-size: 35px;">Lista de participantes</label>
	          	</div>
	          	<div class="mt-2">
	          		<label style="color: #fff; font-size: 25px;">Total de participantes: {!! $total_participantes !!}</label>
	          	</div>
	          	<div class="mt-2">
	          		<button id="generar" style="color: #fff; font-size: 25px; border: 3px solid #fff; border-radius: 35px; width: 100%" class="btn btn-outline-secondary btn-lg">Obtener ganador</button>
	          	</div>
	          	<div class="mt-2">
	          		<label style="color: #fff; font-size: 25px;" id="total_giro">Total de giros: 0</label>
	          	</div>
	          	<div class="section-content mt-4">
			     	<ul class="anyClass p-2 pt-3 text-left pl-4" style="color: #fff; font-size: 16px; border: 2px solid #fff; border-radius: 7px; list-style-type: none; width: 100%">
			     		@php($cantidad = 0)
			     		@foreach($participantes as $participante)			     			
			       			<li id="item-{!! $cantidad = $cantidad+1 !!}"><label>{!! $participante->nombre_free_fire !!} | {!! $participante->id_free_fire !!} | {!! $participante->servidor !!} <span class="fecha_c">({!! $participante->fecha_canjeado !!})</span></label></li>
			       		@endforeach
			     	</ul>
	          	</div>
	          </div>
	          <!--/.col (right) -->
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
		$(document).ready(function(){
			$('.fecha_c').hide();
			var giro = 1;
			var num;
			$(document).on('click', '#generar', function(){
				$('#show_winner').addClass('showwinner');
				$('#felicidades').addClass('showwinner');
				$('#felicidades').text('Felicidades!!!');
				$('#item-'+num).removeClass('bg-color');

				if ('{!! $elegir_ganador !!}' === 'Azar') {
					$('.fecha_c').text('');
					num = Math.round(Math.random() * ('{!! $cantidad !!}') + 1);
					if (num > '{!! $cantidad !!}') {
						num = num-1;
					}
				}else{
					num = 1;
					$('.fecha_c').show();
				}
				var ganador = $('#item-'+num).text();
				$('#item-'+num).addClass('bg-color');
				$('#total_giro').text('Total de giros: '+giro);
				$('#show_winner').text(ganador);
				confetti.start(10000, 100, 2000);
				giro +=1;
			});		 	
		});
	</script>
</body>
<!-- @include('layouts.footer_streamer') -->
</html>