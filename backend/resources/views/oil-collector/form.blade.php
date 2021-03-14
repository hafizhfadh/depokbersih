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
                            <label for="">Unit</label>
                            <select class="form-control" name="unit" id="">
                                <option value="mililiter">Mililiter</option>
                                <option value="liter">Liter</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Type</label>
                            <select class="form-control" name="type" id="">
                                <option value="cash">Cash</option>
                                <option value="savings">Tabungan</option>
                                <option value="alms">Sedekah</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Amount</label>
                            <input type="number" class="form-control" name="amount" value="{{ $data? $data->amount : '' }}"
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
            let user = @json($data->user);
            $('#select-users').append(`<option value="${user.id}" selected>${user.name}</option>`);
        @endif
    });
</script>
@endpush