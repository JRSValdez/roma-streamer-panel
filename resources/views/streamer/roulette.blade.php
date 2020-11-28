@extends('layouts.streamer')

@section('title', 'Streamer')

@section('content')
    <div>
        <section class="content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="input-group input-group-sm">
                        <p id="link-message" class="link-muted">http://crazystream.co/loots/widgets?id_streamer=1127&amp;token=6fyvjpsapCOhQLbH1pSf1GC3eyVV9q4GGQFDxJQtGIEviGtvFVrj01jj54Qo</p>
                        <span class="btn-group">
                            <button type="button" class="btn btn-info btn-info">Copiar</button>
                        </span>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5>Ruletas</h5>
                            <table class="table dataTable" width="100%">
                                <tbody class="">
                                <tr class="">
                                    <th>Recompensa</th>
                                    <th>Participantes</th>
                                    <th>Estado</th>
                                    <th>Aciones</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <i class="fa ion-checkmark-round" title="Activar"></i>
                                        <i class="fa ion-close-round" title="Desactivar"></i>
                                        <i class="fa ion-trash-a" title="Elimiar"></i>
                                        <a target="_blank" title="Ir a la ruleta"><i class="fa ion-trophy"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header with-border ">

                                <h4><i class="fa fa-chart-bar"></i> Total mensajes: Últimos 3 Meses</h4>
                            </div>
                            <div class="">
                                <div style="height: 300px; position: relative;">
                                    <div>
                                        <div>
                                            <div
                                                style="position: absolute; max-width: 120px; top: 278px; left: 48px; text-align: center;">
                                                Sept
                                            </div>
                                            <div
                                                style="position: absolute; max-width: 120px; top: 278px; left: 174px; text-align: center;">
                                                Oct
                                            </div>
                                            <div
                                                style="position: absolute; max-width: 120px; top: 278px; left: 297px; text-align: center;">
                                                Nov
                                            </div>
                                        </div>
                                        <div
                                            style="position: absolute;">
                                            <div
                                                style="position: absolute; top: 263px; left: 18px; text-align: right;">0
                                            </div>
                                            <div
                                                style="position: absolute; top: 197px; left: 9px; text-align: right;">50
                                            </div>
                                            <div
                                                style="position: absolute; top: 132px; left: 1px; text-align: right;">100
                                            </div>
                                            <div
                                                style="position: absolute; top: 66px; left: 1px; text-align: right;">150
                                            </div>
                                            <div
                                                style="position: absolute; top: 1px; left: 1px; text-align: right;">200
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body-->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

