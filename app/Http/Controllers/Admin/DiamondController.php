<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diamond; // Pastikan model Diamond sudah di-import
use Illuminate\Http\Request;

class DiamondController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diamonds = Diamond::latest()->paginate(10); // Ambil semua diamond, urutkan terbaru, paginasi
        return view('auth.admin.diamonds.index', compact('diamonds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.admin.diamonds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        Diamond::create($request->all());

        return redirect()->route('admin.diamonds.index')
                         ->with('success', 'Paket diamond berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diamond $diamond)
    {
        // Anda mungkin tidak butuh halaman show terpisah jika semua info ada di edit atau index
        // return view('admin.diamonds.show', compact('diamond'));
        return redirect()->route('auth.admin.diamonds.edit', $diamond->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diamond $diamond)
    {
        return view('auth.admin.diamonds.edit', compact('diamond'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diamond $diamond)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        $diamond->update($request->all());

        return redirect()->route('admin.diamonds.index')
                         ->with('success', 'Paket diamond berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diamond $diamond)
    {
        $diamond->delete();

        return redirect()->route('admin.diamonds.index')
                         ->with('success', 'Paket diamond berhasil dihapus.');
    }
}