@extends('layouts.app')

<style>
    /* Add this to your CSS file or in a <style> tag in your layout */

/* Base Styles */
:root {
  --primary: #6c5ce7;
  --secondary: #a29bfe;
  --accent: #fd79a8;
  --dark: #2d3436;
  --light: #f5f6fa;
  --success: #00b894;
  --danger: #d63031;
  --warning: #fdcb6e;
}

body {
  font-family: 'Poppins', sans-serif;
  background-color: #1a1a2e;
  color: var(--light);
  line-height: 1.6;
  background-image: 
    radial-gradient(circle at 10% 20%, rgba(108, 92, 231, 0.1) 0%, transparent 20%),
    radial-gradient(circle at 90% 80%, rgba(253, 121, 168, 0.1) 0%, transparent 20%);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

/* Alert Messages */
.alert {
  padding: 15px;
  margin-bottom: 20px;
  border-radius: 8px;
  font-weight: 500;
  display: flex;
  align-items: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.alert.success {
  background-color: var(--success);
  color: white;
}

.alert.danger {
  background-color: var(--danger);
  color: white;
}

.alert::before {
  content: "✓";
  margin-right: 10px;
  font-weight: bold;
}

.alert.danger::before {
  content: "!";
}

/* Game Card Styles */
.home-box, .diamond-box, .topup-box, .history-box {
  background: rgba(45, 52, 54, 0.8);
  border-radius: 16px;
  padding: 30px;
  margin-bottom: 30px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  position: relative;
  overflow: hidden;
}

.home-box::before, .diamond-box::before, .topup-box::before, .history-box::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--primary), var(--accent));
}

.home-box {
  background: linear-gradient(135deg, rgba(45, 52, 54, 0.9), rgba(44, 62, 80, 0.9));
}

.diamond-box {
  background: linear-gradient(135deg, rgba(108, 92, 231, 0.1), rgba(45, 52, 54, 0.9));
}

/* Typography */
h2, h3 {
  color: white;
  margin-top: 0;
  position: relative;
  padding-bottom: 10px;
}

h2 {
  font-size: 2.2rem;
  background: linear-gradient(90deg, #fff, var(--secondary));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 20px;
}

h2::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, var(--primary), var(--accent));
}

h3 {
  font-size: 1.8rem;
  margin-bottom: 20px;
  color: var(--secondary);
}

/* Credit Info */
.credit-info {
  background: rgba(0, 184, 148, 0.2);
  padding: 15px;
  border-radius: 8px;
  margin: 20px 0;
  font-size: 1.2rem;
  border-left: 4px solid var(--success);
}

.credit-info strong {
  color: var(--secondary);
}

/* Form Elements */
form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

label {
  font-weight: 500;
  color: var(--secondary);
  margin-bottom: -15px;
}

select, input[type="number"], input[type="text"] {
  padding: 15px;
  border-radius: 8px;
  border: none;
  background: rgba(255, 255, 255, 0.1);
  color: white;
  font-size: 1rem;
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.3s ease;
}

select:focus, input[type="number"]:focus, input[type="text"]:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 2px rgba(108, 92, 231, 0.3);
}

select option {
  background-color: var(--dark);
  color: white;
}

button {
  padding: 15px 25px;
  background: linear-gradient(135deg, var(--primary), var(--accent));
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 1px;
  box-shadow: 0 4px 15px rgba(108, 92, 231, 0.4);
}

button:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(108, 92, 231, 0.6);
}

button:active {
  transform: translateY(0);
}

/* History Box */
.history-box ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.history-box li {
  padding: 15px;
  margin-bottom: 10px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 8px;
  transition: all 0.3s ease;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.history-box li:hover {
  background: rgba(255, 255, 255, 0.1);
  transform: translateX(5px);
}

.history-box li:nth-child(odd) {
  background: rgba(108, 92, 231, 0.1);
}

.history-box li:nth-child(odd):hover {
  background: rgba(108, 92, 231, 0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
  .container {
    padding: 15px;
  }
  
  .home-box, .diamond-box, .topup-box, .history-box {
    padding: 20px;
  }
  
  h2 {
    font-size: 1.8rem;
  }
  
  h3 {
    font-size: 1.5rem;
  }
  
  .history-box li {
    flex-direction: column;
    align-items: flex-start;
    gap: 5px;
  }
}

/* Animation */
@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

.home-box {
  animation: pulse 6s infinite ease-in-out;
}

/* Glow Effect */
.glow {
  text-shadow: 0 0 10px rgba(168, 216, 234, 0.8);
}

/* Add this to your HTML head to load Poppins font */
/* <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> */
</style>

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
            <strong>Credit Anda:</strong> Rp{{ number_format(Auth::user()->credit ?? 0, 0, ',', '.') }}
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