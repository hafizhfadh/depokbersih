@extends('layouts.app')

@section('content')

<meta name="base_url" content="{{ url('posts') }}">

<div class="row">
    <div class="col-sm">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mt-2 font-weight-bold text-primary">
                    Form Post [{{ $data? $data->title : 'Baru' }}]
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="form" action=" {{ $type == 'create'? url('user/store') : url('user/update/'.$id) }}">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $data? $data->title : '' }}"
                                id="">
                        </div>
                        <div class="form-group col-12">
                            <label for="">Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail"
                                value="{{ $data? $data->thumbnail : '' }}" id="">
                        </div>
                        <div class="form-group col-12">
                            <label for="">Description</label>
                            <textarea type="text" class="form-control" name="description"
                                id="editor">{{ $data? $data->description : '' }}</textarea>
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
<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        select2Generator('#select-group', '{{ url('user / group / list') }}');
        @if ($data)
            let groups = @json($data -> groups);
        $.each(groups, function (index, value) {
            $('#select-group').append(`<option value="${value.id}" selected>${value.name}</option>`);
        });
        @endif
    });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush