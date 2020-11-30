@extends('layouts.streamer')

@section('title', 'Streamer')

@section('panel_actual')
    <i class="fab fa-superpowers mr-2 ml-2"></i>Panel de ruleta
@endsection

@section('page_actual', 'Ruleta')

@section('content')
    @include('streamer.modales.modal_ruleta')
    <div class="container-fluid">
        <section class="content">
            <div class="text-right">
                <button class="btn bg-gradient-primary" data-toggle="modal" data-target="#createSpinWheelModal"><i class="fas fa-hand-sparkles mr-2 ml-2"></i> Crear Ruleta</button>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Ruletas</h3>
{{--                    <div class="card-tools">--}}
{{--                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">--}}
{{--                            <input style="height: inherit;" type="text" name="table_search" class="form-control pull-right" placeholder="Search">--}}
{{--                            <div class="input-group-btn">--}}
{{--                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="card-body table-responsive no-padding">
                    <table id="tabla_ruleta" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Recompensa</th>
                                <th>Participantes</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tabla_ruleta').DataTable({
                {{--processing: true,--}}
                {{--serverSide:true--}}
                {{--ajax: "{!! route('streamer.getcodigos') !!}",--}}
                {{--columns: [--}}
                {{--    { data: 'id', name: 'id' },--}}
                {{--    { data: 'name', name: 'name' },--}}
                {{--    { data: 'email', name: 'email' },--}}
                {{--    { data: 'email', name: 'email' },--}}
                {{--    { data: 'email', name: 'email' },--}}
                {{--    { data: 'email', name: 'email' },--}}
                {{--]--}}
            });
        });
    </script>
@endsection
