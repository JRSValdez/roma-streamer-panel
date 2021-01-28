@extends('layouts.streamer')

@section('title', Auth::user()->site_name . ' - Dashboard')

@section('panel_actual')
    <i class="fas fa-tachometer-alt mr-2 ml-2"></i> Dashboard
@endsection

@section('page_actual', 'Dashboard')

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="content-fluid">
        <div class="row">
            <div class="col-lg-6">
                <span>URL Canal: <span id="url">{{ $url }}<span></span>
            </div>
            <div class="col-lg-5">
                <button class="btn btn-info btn-sm" onclick="copiar()">Copiar URL</button>
            </div>
        </div>       
        
        <hr>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$messages_count}}</h3>
                    <p>Mensajes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-3 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$polls_count}}</h3>
                    <p>Encuestas creadas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-rocket"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-3 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$roulette_count}}</h3>
                    <p>Ruletas creadas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-life-ring"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-3 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$codes_count}}</h3>

                    <p>Codigos creados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-qrcode"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <script type="text/javascript">
        function copiar() {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById('url').textContent);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);

            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 5000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'Se copio la URL correctamente!'
            })
        }
    </script>
    <!-- /.row -->
    <!-- Main row -->
    <!-- /.row (main row) -->
@endsection

