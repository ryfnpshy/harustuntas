@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded-md mb-4 shadow-md flex items-center gap-2">
        <span class="font-bold">✓</span> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-500 text-white p-4 rounded-md mb-4 shadow-md flex items-center gap-2">
        <span class="font-bold">!</span> {{ session('error') }}
    </div>
@endif
<body class="bg-gradient-to-br from-[#0f0c29] via-[#302b63] to-[#24243e] min-h-screen">

<div class="max-w-6xl mx-auto px-4 space-y-10 text-white font-[Poppins]">
    {{-- Welcome Box --}}
    <div class="rounded-2xl p-6 bg-gradient-to-r from-gray-800 to-gray-900 shadow-xl animate-pulse-slow">
        <div class="flex items-center space-x-4">
            <img 
                src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                alt="User Avatar" 
                class="w-10 h-10 rounded-full object-cover border-2 border-indigo-500 shadow"
            >
            <h2 class="text-2xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-white to-indigo-300">
                Selamat Datang, {{ Auth::user()->username }}
            </h2>
        </div>
    </div>

    {{-- Credit Info --}}
    <div class="bg-green-800/20 border-l-4 border-green-500 p-4 rounded-md">
        <span class="text-lg font-medium text-indigo-200">Credit Anda:</span> 
        <span class="font-semibold text-white">Rp{{ number_format(Auth::user()->credit ?? 0, 0, ',', '.') }}</span>
    </div>

    {{-- Diamond Purchase Box --}}
    <div class="rounded-2xl p-6 bg-gradient-to-br from-indigo-900/50 to-gray-800/80 shadow-lg">
        <h3 class="text-xl font-semibold text-indigo-300 mb-6 border-b border-indigo-600 pb-2">Beli Diamond Mobile Legends</h3>

        <form method="POST" action="{{ url('/buy') }}" class="space-y-6">
            @csrf
            <label class="block text-indigo-300 font-medium">Pilih Jumlah Diamond:</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @for($i = 100; $i <= 1500; $i += 100)
                    <label class="cursor-pointer group relative">
                        <input type="radio" name="jumlah" value="{{ $i }}" class="sr-only peer" required>
                        <div class="p-4 rounded-lg border border-indigo-500/30 bg-gray-700 text-white text-center group-hover:scale-105 transition 
                                    peer-checked:bg-indigo-600 peer-checked:border-indigo-400">
                            <div class="font-semibold">{{ $i }} 💎</div>
                            <div class="text-sm text-indigo-200">Rp{{ number_format(($i / 100) * 15000, 0, ',', '.') }}</div>
                        </div>
                    </label>
                @endfor
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-pink-500 hover:opacity-90 text-white py-3 font-bold rounded-md shadow-md transition">
                Beli Sekarang
            </button>
        </form>
    </div>

    {{-- History Box --}}
    <div class="rounded-2xl p-6 bg-gradient-to-br from-gray-800 via-gray-900 to-gray-800 shadow-lg">
        <h3 class="text-xl font-semibold text-indigo-300 mb-4 border-b border-indigo-600 pb-2">Riwayat Pembelian Diamond</h3>
        @if($transactions->isEmpty())
            <p class="text-gray-300">Belum ada transaksi.</p>
        @else
            <ul class="space-y-3">
                @foreach($transactions as $tx)
                    <li class="flex justify-between bg-gray-700/50 hover:bg-indigo-700/40 transition p-4 rounded-lg text-sm">
                        <span class="text-indigo-100">{{ $tx->created_at->format('d M Y H:i') }}</span>
                        <span class="text-white font-semibold">{{ $tx->jumlah_diamond }} 💎</span>
                        <span class="text-green-300 font-semibold">Rp{{ number_format($tx->total_harga, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
