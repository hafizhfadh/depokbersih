@extends('layouts.app')

@section('content')

<meta name="base_url" content="{{ url('oil-collector') }}">

<div class="row">
    <div class="col-sm">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mt-2 font-weight-bold text-primary">
                    Form Pengajuan Surat Kebersihan
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="form" action=" {{ url('letter/store') }}">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="">Applicant</label>
                            <select class="form-control select2" id="select-users" name="user_id" id=""></select>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Requested Letter Date</label>
                            <input type="text" id="startDate" class="form-control" name="start_date" placeholder="For Date">
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
        dateGenerator('#startDate',{
            minDate: new Date(Date.now()),
            maxDate: '+30Y',
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true
        });
    });
</script>
@endpush