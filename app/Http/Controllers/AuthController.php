<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller; // ✅ ini yang benar
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;





class AuthController extends Controller
{
    
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/home');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:4'
        ]);

        User::create([
            'name' => $request->username, // bisa pakai username sebagai name sementara
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat!');
    }

    public function home()
    {
        $transactions = Transaction::where('user_id', Auth::id())->latest()->get();
        return view('home', compact('transactions'));
        dd(Auth::id());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function buy(Request $request)
{
    $request->validate([
        'jumlah' => 'required|integer|in:100,200,300,400,500,600,700,800,900,1000,1100,1200,1300,1400,1500'
    ]);

    $jumlah = $request->input('jumlah');
    $harga = ($jumlah / 100) * 15000;

    $user = Auth::user();

    if ($user->credit < $harga) {
        Log::warning('Credit kurang', ['user_id' => $user->id]);
        return back()->with('error', 'Credit tidak cukup');
    }

    $user->credit -= $harga;
    $user->save();

    $trx = Transaction::create([
        'user_id' => $user->id,
        'jumlah_diamond' => $jumlah,
        'total_harga' => $harga,
    ]);

    Log::info('Transaction created', $trx->toArray());

    return back()->with('success', 'Berhasil beli');
}

public function topup(Request $request)
{
    $request->validate([
        'amount' => 'required|integer|min:10000'
    ]);

    $user = Auth::user();
    $user->credit += $request->amount;
    $user->save();



    return back()->with('topup', 'Top up berhasil sebesar Rp' . number_format($request->amount, 0, ',', '.'));
}



}
