@extends('layouts.app')

@section('content')

<meta name="base_url" content="{{ url('client') }}">

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mt-2 font-weight-bold text-primary">
                    Form Klien
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="form" action=" {{ $type == 'create'? url('client/store') : url('client/update/'.$id) }}">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">NIK</label>
                                    <input type="text" class="form-control" name="nik" value="{{ $data? $data->nik : '' }}" id="">
                                </div>
                                <div class="form-group col-6">
                                    <label for="">NPWP</label>
                                    <input type="text" class="form-control" name="npwp" value="{{ $data? $data->npwp : '' }}" id="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $data? $data->name : '' }}" id="">
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">No. Hanphone</label>
                                    <input type="text" class="form-control" name="phone_number" value="{{ $data? $data->phone_number : '' }}" id="">
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ $data? $data->email : '' }}" id="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">Tempat Lahir</label>
                                    <select class="form-control select2" id="select-birthplace" name="birthplace_id"></select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="birthdate" value="{{ $data? $data->birthdate : '' }}" id="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Pekerjaan</label>
                                <select class="form-control select2" id="select-job" name="job_list_id"></select>
                            </div>
                            <div class="form-group">
                                <label for="">Kartu Identitas  <a href="{{ $data? $data->identity_card? Storage::url('client/identity_card/'.$data->identity_card) : '' : '' }}" target="_blank">{{ $data?  $data->identity_card : '' }}</a></label>
                                <input type="file" class="form-control" name="identity_card_file" id="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Provinsi</label>
                                <select class="form-control select2 province-all" id="select-province" name="province_id" data-province="#select-province" data-regency="#select-regency" data-district="#select-district" data-village="#select-village"></select>
                            </div>
                            <div class="form-group">
                                <label for="">Kota/Kabupaten</label>
                                <select class="form-control select2 regency-all" id="select-regency" name="regency_id" data-province="#select-province" data-regency="#select-regency" data-district="#select-district" data-village="#select-village"></select>
                            </div>
                            <div class="form-group">
                                <label for="">Kecamatan</label>
                                <select class="form-control select2 district-all" id="select-district" name="district_id" data-province="#select-province" data-regency="#select-regency" data-district="#select-district" data-village="#select-village"></select>
                            </div>
                            <div class="form-group">
                                <label for="">Kelurahan</label>
                                <select class="form-control select2 village-all" id="select-village" name="village_id" data-province="#select-province" data-regency="#select-regency" data-district="#select-district" data-village="#select-village"></select>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" name="address" value="{{ $data? $data->address : '' }}" id="">
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">RT</label>
                                    <input type="text" class="form-control" name="rt" value="{{ $data? $data->rt : '' }}" id="">
                                </div>
                                <div class="form-group col-6">
                                    <label for="">RW</label>
                                    <input type="text" class="form-control" name="rw" value="{{ $data? $data->rw : '' }}" id="">
                                </div>
                            </div>
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
        $(document).ready(function() {
            let countBirthplace = 1;
            select2Generator('#select-job', '{{ url('jobs') }}', 'Pilih Pekerjaan');
            $.post('{{ url('birthplaces') }}', { last_id : true }, function(data) {
                countBirthplace = data.data.id;
            })
            $('#select-birthplace').select2({
                width: '100%',
                ajax: {
                    url: '{{ url('birthplaces') }}',
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        }
                    },
                },
                cache: true,
                tags : true,
                createTag: function (params) {
                    countBirthplace++;
                    var term = $.trim(params.term);

                    if (term === '') {
                        return null;
                    }

                    return {
                        id: countBirthplace,
                        text: term,
                        newTag: true // add additional parameters
                    }
                }
            });
            $('#select-birthplace').change(function() {
                let data = $(this).select2('data');
                let value = data[data.length - 1];
                if (value.newTag) {
                    $.ajax({
                        url: '{{ url('birthplace/store') }}',
                        type: 'post',
                        data: { id : value.id, name : value.text }
                    })
                }
            });
            @if($data)
                let data = @json($data);
                console.log(data);
                $('#select-province').append(`<option value="${data.province.id}" selected>${data.province.name}</option>`);
                $('#select-regency').append(`<option value="${data.regency.id}" selected>${data.regency.name}</option>`);
                $('#select-village').append(`<option value="${data.village.id}" selected>${data.village.name}</option>`);
                $('#select-district').append(`<option value="${data.district.id}" selected>${data.district.name}</option>`);
                $('#select-birthplace').append(`<option value="${data.birthplace.id}" selected>${data.birthplace.name}</option>`);
                $('#select-job').append(`<option value="${data.job_list.id}" selected>${data.job_list.name}</option>`);
            @endif
        });
    </script>
@endpush
