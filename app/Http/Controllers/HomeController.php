<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class HomeController extends Controller
{
    public function index() {
        return view('home');
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

        return back()->with('success', 'Berhasil membeli ' . $jumlah . ' Diamond.');
    }
}
