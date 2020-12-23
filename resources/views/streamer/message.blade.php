@extends('layouts.streamer')

@section('title', Auth::user()->site_name . ' - Mensajes')

@section('panel_actual')
    <i class="fas fa-envelope mr-2 ml-2"></i>Panel de mensajes
@endsection

@section('page_actual', 'Mensajes')

@section('content')
    <div>
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
{{--                    <div class="input-group input-group-sm">--}}
{{--                        <div class="row"  style="width: 100%">--}}
{{--                            <div class="col-md-11" style="width: 100%">--}}
{{--                                <p id="link-message" class="links-copy">Links</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-1 text-right">--}}
{{--                                <span class="input-group-btn">--}}
{{--                                    <button type="button" class="btn bg-gradient-info" onclick="">Copiar</button>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="card mt-12">
                        <div class="card-header">
                            <h3 class="card-title">Últimos loots</h3>
                        </div>
                        <div class="card-body table-responsive no-padding">
                            <table id="tabla_mensaje" class="table table-bordered table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Mensaje</th>
                                    </tr>
                                </Thead>
                            </table>
                        </div>
                    </div>
                </div>
{{--                <div class="col-lg-4">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="card-header with-border ">--}}

{{--                                <h4><i class="fa fa-chart-bar"></i> Total mensajes: Últimos 3 Meses</h4>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <div style="height: 300px; position: relative;">--}}
{{--                                    <div>--}}
{{--                                        <div>--}}
{{--                                            <div--}}
{{--                                                style="position: absolute; max-width: 120px; top: 278px; left: 48px; text-align: center;">--}}
{{--                                                Sept--}}
{{--                                            </div>--}}
{{--                                            <div--}}
{{--                                                style="position: absolute; max-width: 120px; top: 278px; left: 174px; text-align: center;">--}}
{{--                                                Oct--}}
{{--                                            </div>--}}
{{--                                            <div--}}
{{--                                                style="position: absolute; max-width: 120px; top: 278px; left: 297px; text-align: center;">--}}
{{--                                                Nov--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div--}}
{{--                                            style="position: absolute;">--}}
{{--                                            <div--}}
{{--                                                style="position: absolute; top: 263px; left: 18px; text-align: right;">0--}}
{{--                                            </div>--}}
{{--                                            <div--}}
{{--                                                style="position: absolute; top: 197px; left: 9px; text-align: right;">50--}}
{{--                                            </div>--}}
{{--                                            <div--}}
{{--                                                style="position: absolute; top: 132px; left: 1px; text-align: right;">100--}}
{{--                                            </div>--}}
{{--                                            <div--}}
{{--                                                style="position: absolute; top: 66px; left: 1px; text-align: right;">150--}}
{{--                                            </div>--}}
{{--                                            <div--}}
{{--                                                style="position: absolute; top: 1px; left: 1px; text-align: right;">200--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.box-body-->--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </section>
    </div>
@endsection
@section('scripts')
<script src="{!! asset('js/mensaje.js') !!}"></script>
@endsection

