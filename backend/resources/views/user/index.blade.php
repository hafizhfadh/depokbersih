@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar User</h1>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="mt-2 font-weight-bold text-primary">List</h6>
        <div class="float-right">
            <a href="{{ url('user/form/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            <a href="#" class="btn btn-primary refresh-button"><i class="fa fa-sync"></i></a>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <table id="datatable" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <th>Group</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Handphone</th>
                <th>Status</th>
                <th>Point</th>
                <th>Aksi</th>
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
                url: '{{ url('datatable/user') }}',
                type:'POST',
            },
            order: [
                [1, "DESC"]
            ],
            columns: [
                { data : 'groups' },
                { data : 'name' },
                { data : 'email' },
                { data : 'phone_number' },
                { data : 'status' },
                { data : 'point' },
                { data : 'action' }
            ]
        });
    });
</script>
@endpush
