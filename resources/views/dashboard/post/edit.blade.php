@extends('admin.layouts.app')

@section('title', 'Edit Blog')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Edit Blog</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('admin.blog.toogle', $blog->id) }}">
            @if ($blog->active)
                <button type="button" class="btn btn-danger">
                    <i class="fas fa-times-circle mr-1"></i> Tutup Form
                </button>
            @else
                <button type="button" class="btn btn-success text-white">
                    <i class="fas fa-check-circle mr-1 text-white"></i> Buka Form
                </button>
            @endif
        </a>
        <span class="mr-3"></span>
        <a href="{{ route('admin.blog.index') }}">
            <button type="button" class="btn btn-light">
                <i class="fas fa-arrow-circle-left mr-1"></i> Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form col-12">
                    <form action="{{ route('admin.blog.update', $blog->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Blog (Pilih satu):</label>
                            <select class="form-control" id="sel1" name="category_id">
                                @forelse($category as $item)
                                    <option value="{{ $item->id }}"
                                        {{ ($item->id == $blog->category->id) ? 'selected' :'' }}>
                                        {{ $item->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <label>Judul Blog</label>
                                <input type="text" class="form-control" name="name" placeholder="Tulis judul blog..."
                                    value="{{ $blog->name }}" required>
                            </div>
                        </div><br>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <label>Form Url Blog (Opsional)</label>
                                <input type="text" class="form-control" name="form_url" placeholder="Tulis form url..."
                                    value="{{ $blog->form_url }}">
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label>Deskripsi Blog</label>
                            <textarea id="summernote" name="description">{!! $blog->description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Gambar Blog (Pastikan resolusi 1000x1000 px)</label><br>
                            <img class="pb-2" width="150"
                                src="{{ isset($blog->image) ? asset($blog->image) : '' }}">
                            <input type="text" name="old_image"
                                value="{{ isset($blog->image) ? $blog->image : null }}" hidden>
                            <input type="file" class="form-control-file py-1" id="foto" name="image">
                            <i>ukuran maksimal 4MB</i>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block text-white">
                            <i class="fa fa-pencil mr-1"></i> Edit Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#summernote').summernote({
      placeholder: 'Deskripsi',
      tabsize: 2,
      height: 100
    });
  </script>
@endsection

@push('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editor').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['tools', ['undo', 'redo']],
                ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript']],
                ['font', ['style', 'fontname', 'fontsize']],
                ['align', ['paragraph', 'height']],
                ['list', ['ul', 'ol']],
                ['insert', ['link', 'table', 'hr']],
                ['misc', ['help']],
            ]
        });
    });
</script>
@endpush
