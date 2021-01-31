@extends('layouts.user')

@section('title', Auth::user()->site_name . ' - Streamers')


@section('content')

    <style>
        .header-container {
            position: relative;
            top: -40px;
            text-align: center;
            z-index: 1;
            overflow-x: hidden;
        }

        .header-title {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: black;
            color: white;
            padding: 10px;
            border-radius: 20px;
            font-weight: bold;
        }

        .streamer-card {
            cursor: pointer;
            border-radius: 20px;
        }
    </style>

    <div style="height: auto !important;">
        <div class="m-1 mt-5" style="height: auto !important;">
            <div class="header-container">
                <img alt="imagen html de ejemplo"
                     src="https://i.pinimg.com/originals/ba/4d/80/ba4d801db37ad7ba4d455d742d46e680.jpg"
                     class="img-fluid"/>
                <h3 class="header-title col-sm-10">Bienvenidos a {{Auth::user()->site_name }}</h3>
            </div>
        </div>
        <br>
        <div class="card-group text-center ml-2">
            <h4>Ellos son los streamers destacados</h4>
        </div>
        <div class="card-group">

            @foreach($destacados as $streamer)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="card streamer-card" style="margin: 1rem;">
                        <a class="color-black" href="{!! url('user/chanel/'.$streamer['name']) !!}">
                            <div class="card-header">
                                <small class="text-muted text-center">
                                    <div class="text-center card-title card-title h5" style="letter-spacing: 1px;">
                                        @isset($streamer->streamer_attributes->live)
                                            @if($streamer->streamer_attributes->live == 'on')
                                                <span class="badge badge-success">Online</span>
                                            @else
                                                <span class="badge badge-danger">Offline</span>
                                            @endif
                                        @else
                                            <span class="badge badge-danger">Offline</span>
                                        @endisset
                                    </div>
                                </small>
                            </div>
                            <div class="card-img-top"
                                 style="background-image: url({{asset('/storage/user_images/'.$streamer['img_src'])}});
                                     height: 251px;
                                     background-position: center center;
                                     background-size: cover;"
                            >
                            </div>
                            <div class="card-body text-center">
                                <div class="text-center"
                                     style="letter-spacing: 1px;">{{$streamer['name']}}</div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- !! Adsense::show('responsive') !! -->

        <br>
        <div class="card-group text-center ml-2">
            <h3>Y hay muchos mas</h3>
        </div>
        <div class="row">
            @foreach($streamers as $streamer)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="card streamer-card" style="margin: 1rem;">
                        <a class="color-black" href="{!! url('user/chanel/'.$streamer['name']) !!}">
                            <div class="card-header">
                                <small class="text-muted text-center">
                                    <div class="text-center card-title card-title h5" style="letter-spacing: 1px;">
                                        @isset($streamer->streamer_attributes->live)
                                            @if($streamer->streamer_attributes->live == 'on')
                                                <span class="badge badge-success">Online</span>
                                            @else
                                                <span class="badge badge-danger">Offline</span>
                                            @endif
                                        @else
                                            <span class="badge badge-danger">Offline</span>
                                        @endisset
                                    </div>
                                </small>
                            </div>
                            <div class="card-img-top"
                                 style="background-image: url({{asset('/storage/user_images/'.$streamer['img_src'])}});
                                     height: 251px;
                                     background-position: center center;
                                     background-size: cover;"
                            >
                            </div>
                            <div class="card-body text-center">
                                <div class="text-center">
                                    <span class="text-center">{{$streamer['name']}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            <img alt="imagen html de ejemplo"
                 src="{{asset('/storage/banner-user.jpg')}}"
                 class="img-fluid"/>
        </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->

    <!-- /.row (main row) -->

@endsection

