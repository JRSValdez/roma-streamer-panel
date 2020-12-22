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
        <div class="content mt-3">          
          <div class="container-fluid">         
            <div class="row">
              <!-- left column -->
              <div class="col-md-7 text-center ml-3 mt-5">
                    <div class="text-center ml-4">
                        <button style="float:left; background-color: #e30052; width: 100%; font-size: 35px; border: none;" id='spin' class="btn btn-primary btn-lg">Girar Ruleta!</button>
                    </div>
                    <div>
                        <label class="btn btn-primary btn-lg" id="ganador" style="font-size: 30px; color: #fff; background-color: #e30052; position: absolute; width: 600px; border-radius: 5px; margin-top: 220px; margin-left: -60px; border: none; cursor: default; visibility: hidden;">Gira la Ruleta!</label>
                        <canvas id="canvas" width="500" height="500"></canvas>
                    </div>
              </div>

              <div class="col-md-4 text-center mt-5" style="border-radius: 15px; padding: 15px;">
                <div class="mt-0">
                    <label style="color: #fff; font-size: 35px;">Lista de participantes</label>
                </div>
                <div class="mt-2">
                    <label style="color: #fff; font-size: 25px;">Total de participantes: {!! $total_participantes !!}</label>
                </div>
                <div class="mt-2">
                    <button onclick="copiarganador()" id="copiar" style="color: #fff; font-size: 25px; border: 3px solid #fff; border-radius: 35px; width: 100%" class="btn btn-outline-secondary btn-lg">Copiar ganador</button>
                </div>
                <div class="mt-2">
                    <label style="color: #fff; font-size: 25px;" id="total_giro">Total de giros: 0</label>
                </div>
                <div class="section-content mt-4" style="visibility: hidden;">
                    <ul class="anyClass p-2 pt-3 text-left pl-4" style="color: #fff; font-size: 16px; border: 2px solid #fff; border-radius: 7px; list-style-type: none; width: 100%">
                        @php($cantidad = 0)
                        @foreach($participantes as $participante)                           
                            <li id="item-{!! $cantidad = $cantidad+1 !!}"><label>{!! $participante->name !!} <span class="fecha_c">({!! $participante->fecha_canjeado !!})</span></label></li>
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
    <script>
        var options = JSON.parse('{!! $participantes !!}');

        var startAngle = 0;
        var arc = Math.PI / (options.length / 2);
        var spinTimeout = null;

        var spinArcStart = 10;
        var spinTime = 0;
        var spinTimeTotal = 0;

        var ctx;

        document.getElementById("spin").addEventListener("click", spin);

        function byte2Hex(n) {
            var nybHexString = "0123456789ABCDEF";
            return String(nybHexString.substr((n >> 4) & 0x0F, 1)) + nybHexString.substr(n & 0x0F, 1);
        }

        function RGB2Color(r, g, b) {
            return '#' + byte2Hex(r) + byte2Hex(g) + byte2Hex(b);
        }

        function getColor(item, maxitem) {
            var phase = 0;
            var center = 128;
            var width = 127;
            var frequency = Math.PI * 2 / maxitem;

            red = Math.sin(frequency * item + 2 + phase) * width + center;
            green = Math.sin(frequency * item + 0 + phase) * width + center;
            blue = Math.sin(frequency * item + 4 + phase) * width + center;

            return RGB2Color(red, green, blue);
        }


        function drawRouletteWheel() {
            var canvas = document.getElementById("canvas");
            if (canvas.getContext) {
                var outsideRadius = 210;
                var textRadius = 160;
                var insideRadius = 125;

                ctx = canvas.getContext("2d");
                ctx.clearRect(0, 0, 500, 500);

                ctx.strokeStyle = "black";
                ctx.lineWidth = 2;

                ctx.font = 'bold 12px Helvetica, Arial';

                for (var i = 0; i < options.length ; i++) {
                    var angle = startAngle + i * arc;
                    //ctx.fillStyle = colors[i];
                    ctx.fillStyle = getColor(i, options.length);

                    ctx.beginPath();
                    ctx.arc(250, 250, outsideRadius, angle, angle + arc, false);
                    ctx.arc(250, 250, insideRadius, angle + arc, angle, true);
                    ctx.stroke();
                    ctx.fill();

                    ctx.save();
                    ctx.shadowOffsetX = -1;
                    ctx.shadowOffsetY = -1;
                    ctx.shadowBlur = 0;
                    ctx.shadowColor = "rgb(220,220,220)";
                    ctx.fillStyle = "black";
                    ctx.translate(250 + Math.cos(angle + arc / 2) * textRadius,
                        250 + Math.sin(angle + arc / 2) * textRadius);
                    ctx.rotate(angle + arc / 2 + Math.PI );
                    var text = options[i].name;
                    ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
                    ctx.restore();
                }

                //Arrow
                ctx.fillStyle = "black";
                ctx.beginPath();
                ctx.moveTo(250 - 4, 250 - (outsideRadius + 5));
                ctx.lineTo(250 + 4, 250 - (outsideRadius + 5));
                ctx.lineTo(250 + 4, 250 - (outsideRadius - 5));
                ctx.lineTo(250 + 9, 250 - (outsideRadius - 5));
                ctx.lineTo(250 + 0, 250 - (outsideRadius - 13));
                ctx.lineTo(250 - 9, 250 - (outsideRadius - 5));
                ctx.lineTo(250 - 4, 250 - (outsideRadius - 5));
                ctx.lineTo(250 - 4, 250 - (outsideRadius + 5));
                ctx.fill();
            }
        }
        var catidad_giros = 0;
        function spin() {
            document.getElementById('ganador').style.visibility = 'hidden';
            catidad_giros = catidad_giros + 1;
            document.getElementById('total_giro').innerText = 'Total de giros: '+catidad_giros;
            spinAngleStart = Math.random() * 10 + 10;
            spinTime = 0;
            spinTimeTotal = Math.random() * 3 + 4 * 1000;
            rotateWheel();
        }

        function rotateWheel() {
            spinTime += 10;
            if (spinTime >= spinTimeTotal) {
                stopRotateWheel();
                return;
            }
            var spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
            startAngle += (spinAngle * Math.PI / 180);
            drawRouletteWheel();
            spinTimeout = setTimeout('rotateWheel()', 25);
        }

        function stopRotateWheel() {
            clearTimeout(spinTimeout);
            var degrees = startAngle * 180 / Math.PI + 90;
            var arcd = arc * 180 / Math.PI;
            var index = Math.floor((360 - degrees % 360) / arcd);
            ctx.save();
            ctx.font = 'bold 30px Helvetica, Arial';
            var text = options[index].name
            let label = document.getElementById('ganador');
            label.innerText = text;
            confetti.start(10000, 100, 2000);
            document.getElementById('ganador').style.visibility = 'visible';
        }

        function easeOut(t, b, c, d) {
            var ts = (t /= d) * t;
            var tc = ts * t;
            return b + c * (tc + -3 * ts + 3 * t);
        }

        drawRouletteWheel();

        function copiarganador() {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById('ganador').textContent);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);

            alert("Ganador copiado exitosamente");
        }
    </script>
</body>
<!-- @include('layouts.footer_streamer') -->
</html>