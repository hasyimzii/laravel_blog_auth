@extends('admin.layouts.app')

@section('title', 'Tambah Blog')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Tambah Blog</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
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
                    <form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Blog (Pilih satu):</label>
                            <select class="form-control" id="sel1" name="category_id">
                                @forelse($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <label>Judul Blog</label>
                                <input type="text" class="form-control" name="name" placeholder="Tulis judul blog..."
                                    required>
                            </div>
                        </div><br>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <label>Form Url Blog (Opsional)</label>
                                <input type="text" class="form-control" name="form_url" placeholder="Tulis form url...">
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label >Deskripsi Blog</label>
                            <textarea id="summernote" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Gambar Blog (Pastikan resolusi 1000x1000 px)</label>
                            <input type="file" class="form-control-file py-1" id="foto" name="image">
                            <i>ukuran maksimal 4MB</i>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Data</button>
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
