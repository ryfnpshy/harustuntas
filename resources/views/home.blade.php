@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert danger">{{ session('error') }}</div>
@endif

<div class="container">
    <div class="home-box">
        <h2>Selamat Datang, {{ Auth::user()->username }}</h2>

        <div class="credit-info">
            <strong>Uang Anda:</strong> Rp{{ number_format(Auth::user()->credit ?? 0, 0, ',', '.') }}
        </div>

        <div class="diamond-box">
            <h3>Beli Diamond Mobile Legends</h3>

            <form method="POST" action="{{ url('/buy') }}">
                @csrf
                <label for="jumlah">Pilih Jumlah Diamond:</label>
                <select name="jumlah" id="jumlah" required>
                    @for($i = 100; $i <= 1500; $i += 100)
                        <option value="{{ $i }}">{{ $i }} Diamond - Rp{{ number_format(($i / 100) * 15000, 0, ',', '.') }}</option>
                    @endfor
                </select>

                <button type="submit">Beli Sekarang</button>
            </form>
        </div>
    </div>
</div>

<hr style="margin: 40px 0;">

<div class="topup-box">
    <h3>Top Up Credit</h3>

    @if(session('topup'))
        <div class="alert success">{{ session('topup') }}</div>
    @endif

    <form method="POST" action="{{ url('/topup') }}">
        @csrf
        <input type="number" name="amount" min="10000" placeholder="Masukkan jumlah top up (min 10.000)" required>
        <button type="submit">Top Up Sekarang</button>
    </form>
</div>

<hr style="margin: 40px 0;">

<div class="history-box">
    <h3>Riwayat Pembelian Diamond</h3>
    @if($transactions->isEmpty())
        <p>Belum ada transaksi.</p>
    @else
        <ul>
            @foreach($transactions as $tx)
                <li>
                    {{ $tx->created_at->format('d M Y H:i') }} - 
                    {{ $tx->jumlah_diamond }} Diamond - 
                    Rp{{ number_format($tx->total_harga, 0, ',', '.') }}
                </li>
            @endforeach
        </ul>
    @endif
</div>

@endsection