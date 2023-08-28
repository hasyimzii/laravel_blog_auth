@extends('dashboard.layouts.app')

@section('title', 'Post Detail')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.post.index') }}">Posts List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Post Detail</li>
  </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Post Detail</h4>
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
        <!-- Post Section -->
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <form>
                        <!-- {{--
                        <div class="form-group row">
                            <b class="col-sm-2 col-form-label">Gambar</b>
                            <div class="col-sm-10">
                                <img alt="ecommerce" class="object-cover object-center w-full h-full block" width="200"
                                    src="{{ is_null($blog->image) ? asset('assets/images/blank.png') : asset($blog->image) }}">
                            </div>
                        </div>
                        --}} -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Author</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $post->user->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Title</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $post->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Post Content</label>
                            <div class="pt-1 text-dark">
                                {!! $post->content !!}
                            </div>
                        </div>
                        <div class="form-group row align-middle">
                            <label class="col-sm-3 col-form-label">Post Status</label>
                            <div class="col-sm-9">
                                @if($post->status == 'published')
                                    <span class="badge badge-success">Published</span>
                                @elseif($post->status == 'draft')
                                    <span class="badge badge-warning text-white">Draft</span>
                                @else
                                    <span class="badge badge-secondary">Archived</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Published Date</label>
                            <div class="col-sm-9">
                                @if($post->status == 'published')
                                    <input type="text" readonly class="form-control-plaintext" 
                                    value="{{ \Carbon\Carbon::parse($post->published_date)->isoFormat('ddd, DD MMM YYYY') }}">
                                @else
                                    <input type="text" readonly class="form-control-plaintext" 
                                        value="Not published"> 
                                @endif 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Comment Section -->
        <div class="card">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-comment-tab" data-toggle="tab" 
                    data-target="#nav-comment" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                        Comments ({{ $post_comment->count() }})
                    </button>
                    <button class="nav-link" id="nav-like-tab" data-toggle="tab" 
                    data-target="#nav-like" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                        Likes and Dislikes ({{ $post_like->count() }})
                    </button>
                </div>
            </nav>
            <div class="card-body pb-0">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-comment" role="tabpanel" aria-labelledby="nav-comment-tab">
                        @forelse($post_comment as $item)
                            <div class="card py-2 px-4">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div>
                                        <span class="text-primary fw-normal lh-1">{{ $item->user->name }}</span>
                                        <p class="text-secondary fw-light fst-italic lh-1">
                                            {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('ddd, DD MMM YYYY') }}
                                        </p>
                                        <p class="mb-0 fw-semiold lh-1">{{ $item->comment }}</p>
                                    </div>
                                    <div>
                                        <i class="fas fa-thumbs-up ml-2"></i> {{ $item->comment_like()->where('is_like', true)->count() }}
                                        <i class="fas fa-thumbs-down ml-2"></i> {{ $item->comment_like()->where('is_like', false)->count() }}
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div class="tab-pane fade" id="nav-like" role="tabpanel" aria-labelledby="nav-like-tab">
                        @forelse($post_like as $item)
                            <div class="card py-2 px-4">
                                <span class="text-primary fw-normal lh-1">{{ $item->user->name }}</span>
                                <p class="text-secondary fw-light fst-italic lh-1">
                                    {{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('ddd, DD MMM YYYY') }}
                                </p>
                                <p class="mb-0 fw-semiold lh-1">
                                    @if($item->is_like)
                                        Liked this post <i class="fas fa-thumbs-up ml-1"></i>
                                    @else
                                        Disiked this post <i class="fas fa-thumbs-down ml-1"></i>
                                    @endif
                                </p>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
