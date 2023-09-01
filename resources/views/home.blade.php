@extends('layouts.app')

@section('title')
    @yield('title')
@endsection

@section('body')
<nav class="navbar bg-dark bg-body-tertiary" data-bs-theme="dark">
  <div class="container my-1">
    <a class="navbar-brand" href="{{ route('home') }}">
      <!-- <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> -->
      Website
    </a>
    @if(auth()->check())
        <a href="{{ route('dashboard.index') }}" class="btn btn-light">
            <i class="fas fa-sign-in me-1"></i> Dashboard
        </a>
    @else
        <a href="{{ route('dashboard.index') }}" class="btn btn-primary">
            <i class="fas fa-sign-in me-1"></i> Login
        </a>
    @endif
  </div>
</nav>

<div class="container">
    <div class="input-group mt-4">
        <input type="text" class="form-control" placeholder="Search posts" aria-label="Search posts" aria-describedby="button-search">
        <button class="btn btn-dark" type="button" id="button-search"><i class="fas fa-search"></i></button>
    </div>
    <div class="row">
        @forelse($post as $item)
            <div class="col-4 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title fs-5">{{ $item->title }}</h4>
                        <div class="d-flex align-items-center text-secondary mb-2">
                            <span class="fs-6 fw-light">
                                <i class="fas fa-user"></i> 
                                {{ $item->user->name }}
                            </span>
                            <span class="fs-6 fw-light ms-3">
                                <i class="fas fa-calendar-alt"></i> 
                                {{ \Carbon\Carbon::parse($item->published_date)->isoFormat('ddd, DD MMM YYYY') }}
                            </span>
                        </div>
                        <p class="card-text">{!! Str::limit($item->content, $limit = 50, $end = '...') !!}</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('postDetail', $item->id) }}" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
@endsection