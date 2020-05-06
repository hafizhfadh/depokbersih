@extends('layouts.app')

@section('content')

<meta name="base_url" content="{{ url('user') }}">

<div class="row">
    <div class="col-sm">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mt-2 font-weight-bold text-primary">
                    Form User {{ $data? $data->name : 'Baru' }}
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="form" action=" {{ $type == 'create'? url('user/store') : url('user/update/'.$id) }}">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="">Group</label>
                            <select class="form-control select2" id="select-group" name="groups[]" id="" multiple></select>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ $data? $data->name : '' }}" id="">
                        </div>
                        <div class="form-group col-12">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $data? $data->email : '' }}" id="">
                        </div>
                        <div class="form-group col-12">
                            <label for="">No. Handphone</label>
                            <input type="text" class="form-control" name="phone_number" value="{{ $data? $data->phone_number : '' }}" id="" oninput="inputOnlyNumber(event)">
                        </div>
                        <div class="form-group col-12">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="address" value="{{ $data? $data->address : '' }}" id="">
                        </div>
                        <div class="form-group col-12">
                            <label for="">Token</label>
                            <input type="text" class="form-control" value="{{ $data? $data->token : '' }}" id="">
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    @if ($data)
        <div class="col-sm-5">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="mt-2 font-weight-bold text-primary">
                        QrCode {{ $data? $data->name : '' }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row justify-content-sm-center justify-content-md-center align-items-center">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                            ->merge('logo.png', 0.2, true)
                            ->size(350)->errorCorrection('H')
                            ->generate($data? $data->qrcode : 'Make me into an QrCode!')) !!}">
                        <div class="col">
                            <p class="text-wrap text-justify font-weight-bolder">{{ $data ? $data->qrcode : 'Not Found!' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            select2Generator('#select-group', '{{ url('user/group/list') }}');
            @if($data)
                let groups = @json($data->groups);
                $.each(groups, function(index, value) {
                    $('#select-group').append(`<option value="${value.id}" selected>${value.name}</option>`);
                });
            @endif
        });
    </script>
@endpush
