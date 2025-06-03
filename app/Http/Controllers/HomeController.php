<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\Transaction;
use App\Models\Diamond; // <-- TAMBAHKAN INI

class HomeController extends Controller
{
    
public function index()
{
    $user = Auth::user();
    $diamonds = Diamond::orderBy('harga', 'asc')->get();

    $transactions = Transaction::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('home', compact('transactions', 'diamonds', 'user'));
}
    public function buy(Request $request)
    {
        // Validasi bahwa diamond_id yang dikirim ada dan valid
        $request->validate([
            'diamond_id' => 'required|exists:diamonds,id',
        ]);

        $selectedDiamond = Diamond::findOrFail($request->input('diamond_id'));

        $jumlah = $selectedDiamond->jumlah; // Ambil jumlah dari paket yang dipilih
        $harga = $selectedDiamond->harga;   // Ambil harga dari paket yang dipilih
        $namaPaket = $selectedDiamond->nama_paket; // Ambil nama paket

        $user = Auth::user();

        if ($user->credit < $harga) {
            return back()->with('error', 'Credit tidak cukup untuk membeli ' . $namaPaket . '.');
        }

        $user->credit -= $harga;
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'diamond_id' => $selectedDiamond->id, // Simpan ID paket diamond
            'jumlah_diamond' => $jumlah,
            'total_harga' => $harga,
            // Anda mungkin ingin menambahkan 'nama_paket' di transaksi jika perlu,
            // tapi lebih baik mengambilnya melalui relasi jika menampilkan riwayat.
        ]);

        return back()->with('success', 'Berhasil membeli ' . $namaPaket . ' (' . $jumlah . ' Diamond).');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->bio = $request->bio;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->whatsapp = $request->whatsapp;
        try {
            $user->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return back()->with('success', 'Profil berhasil diupdate!');
    }
}
