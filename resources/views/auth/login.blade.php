@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-box">
        <h2>Login</h2>

        @if(session('error'))
            <div class="alert danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p class="switch-link">Belum punya akun? <a href="{{ url('/register') }}">Daftar di sini</a></p>
    </div>
</div>
@endsection
