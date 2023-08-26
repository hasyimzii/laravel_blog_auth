@extends('auth.layout')

@section('title', 'Register')
@section('content')
<div class="auth-form">
    <h3 class="text-center mb-4">Register</h3>
    <form action="{{ route('auth.register') }}" method="post">
        @csrf
        <div class="form-group">
            <label><strong>Name</strong></label>
            <input type="name" class="form-control" name="name" autofocus required>
        </div>
        <div class="form-group">
            <label><strong>Email</strong></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label><strong>Password</strong></label>
            <input type="password" class="form-control" name="password" required>
        </div><br>
        <div class="form-group">
            <label><strong>Confirm Password</strong></label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div><br>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
    </form>
    <div class="text-center mt-2">
        <p>Have an account? <a href="{{ route('auth.showLogin') }}" class="text-primary">Login</a></p>
    </div>
</div>
@endsection