<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\Transaction;

class HomeController extends Controller
{
    
public function index()
{
    $user = Auth::user();

    $transactions = Transaction::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('home', compact('transactions'));
}
    public function buy(Request $request) {
        $jumlah = $request->input('jumlah');
        $harga = ($jumlah / 100) * 15000;

        $user = Auth::user();

        if ($user->credit < $harga) {
            return back()->with('error', 'Credit tidak cukup untuk membeli ' . $jumlah . ' Diamond.');
        }

        $user->credit -= $harga;
        $user->save();

            Transaction::create([
                'user_id' => $user->id,
                'jumlah_diamond' => $jumlah,
                'total_harga' => $harga,
            ]);

        return back()->with('success', 'Berhasil membeli ' . $jumlah . ' Diamond.');
    }
}
