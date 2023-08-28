@extends('dashboard.layouts.body')

@section('title', 'Create Post')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.post.index') }}">Posts List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create Post</li>
  </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Create Post</h4>
        </div>
    </div>
    <div class="col-sm-6 my-auto p-md-0 justify-content-sm-end d-flex">
        <a href="{{ route('dashboard.post.index') }}">
            <button type="button" class="btn btn-light">
                <i class="fas fa-arrow-circle-left mr-1"></i> Back
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
                    <form action="{{ route('dashboard.post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- {{--
                        <div class="form-group">
                            <label for="foto">Gambar Blog (Pastikan resolusi 1000x1000 px)</label>
                            <input type="file" class="form-control-file py-1" id="foto" name="image">
                            <i>ukuran maksimal 4MB</i>
                        </div>
                        </div> 
                        --}} -->
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Post Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Insert post title..." required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label >Post Content</label>
                            <textarea id="summernote" name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Post Status (Choose one):</label>
                            <select class="form-select" id="sel1" name="status">
                                <!-- {{--
                                @forelse($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty
                                @endforelse
                                --}} -->
                                <option value="draft">Save to draft</option>
                                <option value="published">Publish now</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-plus-circle mr-1"></i> Create post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['tools', ['undo', 'redo']],
                ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript']],
                ['font', ['style', 'fontsize']],
                ['align', ['paragraph']],
                ['list', ['ul', 'ol']],
                ['insert', ['link', 'table', 'hr']],
                ['misc', ['help']],
            ]
        });
    });
</script>
@endpush
