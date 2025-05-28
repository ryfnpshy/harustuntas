@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#0F0F2D] px-4">
    <div class="bg-[#1E1E2F] rounded-xl shadow-lg p-8 w-full max-w-md text-white">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold">Register</h1>
            <div class="w-16 h-1 mx-auto mt-2 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full"></div>
            <p class="mt-3 text-gray-300">Buat akun anda dan selesaikan tubes</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                <p class="font-bold">Please fix these errors:</p>
                <ul class="list-disc list-inside text-sm mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/register') }}" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block text-sm font-semibold mb-1">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required
                    class="w-full px-4 py-3 rounded-lg bg-[#2D2D44] text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required
                    class="w-full px-4 py-3 rounded-lg bg-[#2D2D44] text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <button type="submit"
                class="w-full py-3 rounded-lg font-semibold text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 shadow-md transition duration-200">
                REGISTER
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-400">
            Sudah punya akun? <a href="{{ url('/login') }}" class="text-purple-400 hover:underline">Login di sini</a>
        </div>
    </div>
</div>
@endsection
