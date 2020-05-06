@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Klien</h1>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="mt-2 font-weight-bold text-primary">List</h6>
        <div class="float-right">
            <a href="{{ url('client/form/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            <a href="#" class="btn btn-primary refresh-button"><i class="fa fa-sync"></i></a>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <table id="datatable" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <th>NIK</th>
                <th>NPWP</th>
                <th>Nama</th>
                <th>No. Handphone</th>
                <th>Email</th>
                <th>Pekerjaan</th>
                <th>TTL</th>
                <th>Alamat</th>
                <th>Kartu identitas</th>
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
            responsive: true,
            autoWidth: false,
            responsive: true,
            defaultContent: '-',
            destroy: true,
            ajax: {
                url: '{{ url('datatable/client') }}',
                type:'POST',
            },
            order: [
                [1, "DESC"]
            ],
            columns: [
                { data : 'nik' },
                { data : 'npwp' },
                { data : 'name' },
                { data : 'phone_number' },
                { data : 'email' },
                { data : 'job_list.name' },
                { data : 'birthplacedate' },
                { data : 'address' },
                { data : 'identity_card' },
                { data : 'action' }
            ]
        });
    });
</script>
@endpush
