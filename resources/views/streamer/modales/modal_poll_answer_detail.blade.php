{{--{!! Form::open(['route' => 'streamer.roulette.createroulette']) !!}--}}
{{--{{ Form::token() }}--}}
    <div class="modal fade" id="pollAnswersDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-rocket mr-2 ml-2"></i> Resultados de las Votaciones</h3>
                            <button class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-6">
                                    <div id="answer1">
                                    </div>
                                    <div id="answer_detail1">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div id="answer2">
                                    </div>
                                    <div id="answer_detail2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--{!! Form::close() !!}--}}
