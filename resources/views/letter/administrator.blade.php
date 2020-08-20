@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Histori Permintaan Surat Kebersihan</h1>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="mt-2 font-weight-bold text-primary">List</h6>
        <div class="float-right">
            <a href="{{ url('letter/form/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            <a href="#" class="btn btn-primary refresh-button"><i class="fa fa-sync"></i></a>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <table id="datatable" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <th>User</th>
                <th>Status</th>
                <th>Created</th>
                <th>Start Date</th>
                <th>Expired Date</th>
                <th>Action</th>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            defaultContent: '-',
            responsive: true,
            destroy: true,
            ajax: {
                url: '{{ url('datatable/letter') }}',
                type:'POST',
            },
            order: [
                [1, "DESC"]
            ],
            columns: [
                { data : 'user.name' },
                { data : 'status' },
                { data : 'created_at' },
                { data : 'start_date' },
                { data : 'expired_date' },
                { data : 'action' }
            ]
        });
    });
</script>
@endpush
