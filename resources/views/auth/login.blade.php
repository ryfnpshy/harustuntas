@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#1a1a2e] p-4 sm:p-6 lg:p-8" 
     style="background-image: radial-gradient(circle at 10% 20%, rgba(108, 92, 231, 0.1) 0%, transparent 20%), radial-gradient(circle at 90% 80%, rgba(253, 121, 168, 0.1) 0%, transparent 20%);">
    <div class="w-full max-w-md bg-[#2d3436] bg-opacity-90 rounded-xl shadow-2xl overflow-hidden backdrop-filter backdrop-blur-sm border border-gray-700 border-opacity-30 animate-fade-in">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#6c5ce7] to-[#fd79a8]"></div>
        
        <div class="p-8 sm:p-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-[#a29bfe] relative pb-4">
                    Login
                    <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-gradient-to-r from-[#6c5ce7] to-[#fd79a8] rounded-full"></span>
                </h2>
                <p class="mt-2 text-[#f5f6fa] opacity-80">Enter your credentials to continue</p>
            </div>

            @if(session('error'))
                <div class="mb-6 p-4 bg-[#d63031] text-white rounded-lg flex items-center shadow-lg">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-[#f5f6fa] mb-2">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Enter username" 
                        required
                        class="w-full px-4 py-3 bg-[rgba(255,255,255,0.1)] border border-[rgba(255,255,255,0.2)] rounded-lg text-white placeholder-[rgba(255,255,255,0.6)] focus:outline-none focus:ring-2 focus:ring-[#6c5ce7] focus:border-transparent transition duration-200"
                    >
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-[#f5f6fa] mb-2">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter password" 
                        required
                        class="w-full px-4 py-3 bg-[rgba(255,255,255,0.1)] border border-[rgba(255,255,255,0.2)] rounded-lg text-white placeholder-[rgba(255,255,255,0.6)] focus:outline-none focus:ring-2 focus:ring-[#6c5ce7] focus:border-transparent transition duration-200"
                    >
                </div>
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-gradient-to-r from-[#6c5ce7] to-[#fd79a8] text-white font-semibold rounded-lg shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[#6c5ce7] focus:ring-offset-2 focus:ring-offset-[#2d3436] transition-all duration-300 transform hover:-translate-y-1 uppercase tracking-wider"
                >
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-[rgba(255,255,255,0.7)]">Belum punya akun? 
                    <a href="{{ url('/register') }}" class="text-[#a29bfe] hover:text-[#fd79a8] font-medium transition duration-200 hover:underline">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection