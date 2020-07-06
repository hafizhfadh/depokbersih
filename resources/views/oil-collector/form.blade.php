@extends('layouts.app')

@section('content')

<meta name="base_url" content="{{ url('oil-collector') }}">

<div class="row">
    <div class="col-sm">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mt-2 font-weight-bold text-primary">
                    Form Kolektor Minyak
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="form" action=" {{ $type == 'create'? url('oil-collector/store') : url('oil-collector/update/'.$id) }}">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="">Member</label>
                            <select class="form-control select2" id="select-users" name="user_id" id=""></select>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Liter</label>
                            <input type="number" class="form-control" name="liter" value="{{ $data? $data->liter : '' }}"
                                id="">
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        select2Generator('#select-users', '{{ url('user/list') }}');
        @if ($data)
            let users = @json($data);
            console.table(users);
        $.each(users, function (index, value) {
            $('#select-users').append(`<option value="${value.id}" selected>${value.name}</option>`);
        });
        @endif
    });
</script>
@endpush