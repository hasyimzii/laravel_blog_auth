@extends('auth.layout')

@section('title', 'Login')
@section('content')
<div class="auth-form">
    <h3 class="text-center mb-4">Login</h3>
    <form action="{{ route('auth.login') }}" method="post">
        @csrf
        <div class="form-group">
            <label><strong>Email</strong></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus required>
        </div>
        <div class="form-group">
            <label><strong>Password</strong></label>
            <input type="password" class="form-control" name="password" required>
        </div><br>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>
    </form>
    <div class="text-center mt-2">
        <p>Don't have an account? <a href="{{ route('auth.showRegister') }}" class="text-primary">Register</a></p>
    </div>
</div>
@endsection