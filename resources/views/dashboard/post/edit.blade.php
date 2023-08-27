@extends('dashboard.layouts.app')

@section('title', 'Edit Blog')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.post.index') }}">Posts List</a></li>
    <li class="breadcrumb-item" aria-current="page">Edit Post</li>
  </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Edit Post</h4>
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
                    <form action="{{ route('dashboard.post.update', $post->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- {{--
                        <div class="form-group">
                            <label for="foto">Gambar Blog (Pastikan resolusi 1000x1000 px)</label><br>
                            <img class="pb-2" width="150"
                                src="{{ isset($blog->image) ? asset($blog->image) : '' }}">
                            <input type="text" name="old_image"
                                value="{{ isset($blog->image) ? $blog->image : null }}" hidden>
                            <input type="file" class="form-control-file py-1" id="foto" name="image">
                            <i>ukuran maksimal 4MB</i>
                        </div>
                        --}} -->
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Post Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Insert post title..." value="{{ $post->title }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label >Post Content</label>
                            <textarea id="summernote" name="content">{!! $post->content !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Post Status (Choose one):</label>
                            <select class="form-control" id="sel1" name="status">
                                <!-- {{--
                                @forelse($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty
                                @endforelse
                                --}} -->
                                <option value="draft" {{ ($post->status == 'draft') ? 'selected' : '' }}>Save to draft</option>
                                <option value="published" {{ ($post->status == 'published') ? 'selected' : '' }}>Publish now</option>
                                <option value="archived" {{ ($post->status == 'archived') ? 'selected' : '' }}>Archive post</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block text-white">
                            <i class="fa fa-pencil mr-1"></i> Update Post
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
