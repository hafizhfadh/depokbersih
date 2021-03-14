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
                        <input type="button" id="openreader-btn" value="Scan QRCode"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('lib/js-qrcode/css/qrcode-reader.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('lib/js-qrcode/js/qrcode-reader.js') }}" type="text/javascript"></script>
<script>
    $("#openreader-btn").qrCodeReader();
</script>
@endpush