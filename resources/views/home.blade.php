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

{{-- Perhatian: Tag <body> di bawah ini mungkin tidak diperlukan jika layouts.app sudah mendefinisikannya. --}}
{{-- Jika dibiarkan, bisa menyebabkan HTML tidak valid. Biasanya @section('content') hanya berisi konten utama. --}}
<body class="bg-gradient-to-br from-[#0f0c29] via-[#302b63] to-[#24243e] min-h-screen">

<div class="max-w-6xl mx-auto px-4 space-y-10 text-white font-[Poppins]">
    {{-- Welcome Box --}}
    <div class="rounded-2xl p-6 bg-gradient-to-r from-gray-800 to-gray-900 shadow-xl animate-pulse-slow">
        <div class="flex items-center space-x-4">
            <img
                src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}" {{-- Menambahkan fallback jika avatar tidak ada --}}
                alt="User Avatar"
                class="w-10 h-10 rounded-full object-cover border-2 border-indigo-500 shadow"
            >
            <h2 class="text-2xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-white to-indigo-300">
                Selamat Datang, {{ Auth::user()->username }}
            </h2>
            <button
                onclick="document.getElementById('editProfileModal').classList.remove('hidden')"
                class="ml-4 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow text-sm"
            >
                Edit Profil
            </button>
        </div>
        {{-- Tampilkan info tambahan --}}
        {{-- Mengubah text-black menjadi text-indigo-200 agar lebih kontras dengan background gelap --}}
        <div class="mt-2 text-indigo-200 text-sm space-y-1">
            @if(Auth::user()->bio)
                <div><span class="font-semibold text-indigo-100">Bio:</span> {{ Auth::user()->bio }}</div>
            @endif
            @if(Auth::user()->tanggal_lahir)
                <div><span class="font-semibold text-indigo-100">Tanggal Lahir:</span> {{ \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->format('d F Y') }}</div> {{-- Format tanggal --}}
            @endif
            @if(Auth::user()->whatsapp)
                <div><span class="font-semibold text-indigo-100">WhatsApp:</span> {{ Auth::user()->whatsapp }}</div>
            @endif
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

        {{-- Pastikan variabel $diamonds dikirim dari controller --}}
        @if(isset($diamonds) && $diamonds->count() > 0)
            <form method="POST" action="{{ url('/buy') }}" class="space-y-6">
                @csrf
                <label class="block text-indigo-300 font-medium">Pilih Paket Diamond:</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    {{-- Loop melalui data diamond dari database --}}
                    @foreach($diamonds as $diamond_package) {{-- Menggunakan nama variabel $diamond_package agar tidak bentrok jika ada variabel $diamond lain --}}
                        <label class="cursor-pointer group relative">
                            {{-- Kirim ID paket diamond sebagai value --}}
                            <input type="radio" name="diamond_id" value="{{ $diamond_package->id }}" class="sr-only peer" required>
                            <div class="p-4 rounded-lg border border-indigo-500/30 bg-gray-700 text-white text-center group-hover:scale-105 transition
                                        peer-checked:bg-indigo-600 peer-checked:border-indigo-400">
                                {{-- Tampilkan nama paket --}}
                                <div class="font-semibold">{{ $diamond_package->nama_paket }}</div>
                                {{-- Tampilkan jumlah diamond --}}
                                <div class="text-sm text-indigo-100">{{ $diamond_package->jumlah }} 💎</div>
                                {{-- Tampilkan harga paket --}}
                                <div class="text-xs text-indigo-200">Rp{{ number_format($diamond_package->harga, 0, ',', '.') }}</div>
                            </div>
                        </label>
                    @endforeach
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-pink-500 hover:opacity-90 text-white py-3 font-bold rounded-md shadow-md transition">
                    Beli Sekarang
                </button>
            </form>
        @else
            <p class="text-center text-indigo-300">Saat ini belum ada paket diamond yang tersedia.</p>
        @endif
    </div>

    {{-- History Box --}}
    <div class="rounded-2xl p-6 bg-gradient-to-br from-gray-800 via-gray-900 to-gray-800 shadow-lg">
        <h3 class="text-xl font-semibold text-indigo-300 mb-4 border-b border-indigo-600 pb-2">Riwayat Pembelian Diamond</h3>
        @if(!isset($transactions) || $transactions->isEmpty()) {{-- Menambahkan !isset($transactions) untuk keamanan --}}
            <p class="text-gray-300">Belum ada transaksi.</p>
        @else
            <ul class="space-y-3">
                @foreach($transactions as $tx)
                    <li class="flex justify-between items-center bg-gray-700/50 hover:bg-indigo-700/40 transition p-4 rounded-lg text-sm">
                        <div>
                            <span class="block text-indigo-100">{{ $tx->created_at->format('d M Y H:i') }}</span>
                            {{-- Jika Anda memiliki relasi 'diamond' di model Transaction --}}
                            @if($tx->diamond_id && $tx->relationLoaded('diamond') && $tx->diamond)
                                <span class="block text-xs text-gray-400">Paket: {{ $tx->diamond->nama_paket }}</span>
                            @elseif($tx->diamond_id)
                                <span class="block text-xs text-gray-400">Paket ID: {{ $tx->diamond_id }}</span>
                            @endif
                        </div>
                        <span class="text-white font-semibold">{{ $tx->jumlah_diamond }} 💎</span>
                        <span class="text-green-300 font-semibold">Rp{{ number_format($tx->total_harga, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <form method="POST" action="{{ route('logout') }}" class="my-8"> {{-- Menambahkan margin untuk logout button --}}
        @csrf
        <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md shadow-md transition">Logout</button>
    </form>

    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden"> {{-- Sedikit menggelapkan overlay modal --}}
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative">
            <button onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
            <h3 class="text-lg font-bold mb-4 text-indigo-700">Edit Profil</h3>
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4"> {{-- Menambahkan space-y-4 --}}
                @csrf
                @method('PUT')
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                    <textarea id="bio" name="bio" class="mt-1 w-full border border-gray-300 rounded p-2 text-black focus:ring-indigo-500 focus:border-indigo-500" rows="2">{{ old('bio', Auth::user()->bio) }}</textarea>
                </div>
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input id="tanggal_lahir" type="date" name="tanggal_lahir" class="mt-1 w-full border border-gray-300 rounded p-2 text-black focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('tanggal_lahir', Auth::user()->tanggal_lahir) }}">
                </div>
                <div>
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                    <input id="whatsapp" type="text" name="whatsapp" class="mt-1 w-full border border-gray-300 rounded p-2 text-black focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('whatsapp', Auth::user()->whatsapp) }}">
                </div>
                {{-- Anda perlu menambahkan field email di sini jika ingin bisa diedit dan uncomment validasi di controller --}}
                {{-- <div>
                    <label for="email_profile" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email_profile" type="email" name="email" class="mt-1 w-full border border-gray-300 rounded p-2 text-black focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('email', Auth::user()->email) }}" required>
                </div> --}}
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded font-semibold shadow-md">Submit</button> {{-- Menyesuaikan padding tombol --}}
            </form>
        </div>
    </div>

    {{-- Pastikan path ke js/script.js benar atau hapus jika tidak digunakan --}}
    {{-- <script src="{{ asset('js/script.js') }}"></script> --}}

</div>
@endsection
