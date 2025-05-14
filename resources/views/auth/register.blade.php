@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-box">
        <h2>Register</h2>

        @if($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/register') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>

        <p class="switch-link">Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a></p>
    </div>
</div>
@endsection
