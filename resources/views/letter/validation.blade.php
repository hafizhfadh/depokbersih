@extends('layouts.app')

@section('content')

<meta name="base_url" content="{{ url('letter') }}">

<div class="row">
    <div class="col-sm">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mt-2 font-weight-bold text-primary">
                    Letter Validation
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="wrapper">
                        <div id="loadingMessage">? Unable to access video stream (please make sure you have a webcam enabled)</div>
                        <div class="d-flex justify-content-center">
                            <canvas id="canvas" hidden width="100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('html5-qrcode.min.js') }}" type="text/javascript"></script>
<script>
    isScanning=false; /* variable to stop or start scanning loop */

function qrReaderInitLoginWeb(callback=null){
    
    var loadingMessage  = document.getElementById("loadingMessage"), /*element for show loading message */
        wrapper         = $(".wrapper"),
        canvasElement   = document.getElementById("canvas"),
        canvas          = canvasElement.getContext("2d"),
        video           = document.createElement("video"),
        streamTemp      = null;

    function drawLine(begin, end, color) { /* draw image from camera device to canvas */
        canvas.beginPath();
        canvas.moveTo(begin.x, begin.y);
        canvas.lineTo(end.x, end.y);
        canvas.lineWidth = 4;
        canvas.strokeStyle = color;
        canvas.stroke();
    }

    function tick() { /* function that call every second */
        
        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            loadingMessage.hidden   = true;
            canvasElement.hidden    = false;

            /* for responsive canvas */
            var m=(parseInt(wrapper.css("width"),10) / 670 );
            var h=video.videoHeight *m;
            var w=video.videoWidth *m;

            if(h<1){h=1}
            if(w<1){w=1}

            canvasElement.height = h;
            canvasElement.width  = w;

            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

            var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);

            var code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: "dontInvert",
            });

            if (code) {/* if code from qrcode found */
                
                drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");

                isScanning = false;

                if(callback!=null){
                    /* code.data is the output from scanning qrcode */
                    /* code.data is a string */

                    callback(code.data);
                }
            }
        }else{
            loadingMessage.innerText = "Loading video...";
        }

        if(isScanning){
            /* Continue scanning ... */
            requestAnimationFrame(tick);
        }else{
            /* Stopping scan ... */
            streamTemp.getTracks()[0].stop()
        }
        
    }
    
    /* Use facingMode: environment to attemt to get the front camera on phones */
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
        video.srcObject = stream;
        video.setAttribute("playsinline", true); /* required to tell iOS safari we don't want fullscreen */
        video.play();

        isScanning = true;
        streamTemp = stream;

        requestAnimationFrame(tick);
    });
}

</script>
@endpush