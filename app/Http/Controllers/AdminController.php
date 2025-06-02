<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Diamond;




class AdminController extends Controller
{
    
    public function index()
    {
        $totalUsers = \App\Models\User::count();
        $totalDiamond = \App\Models\Diamond::count();
        $totalTransactions = \App\Models\Transaction::count();
        $latestTransactions = \App\Models\Transaction::with(['user','diamond'])->latest()->take(5)->get();
        return view('auth.admin.index', compact('totalUsers', 'totalDiamond', 'totalTransactions', 'latestTransactions'));
    }

    // Topup
    // Get
    public function GShowTopup()
    {
        $users = User::all(); // ambil semua user
        return view('auth.admin.topup.index', compact('users'));
    }


    // Put
    public function PAddTopup(Request $request)
    {
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'jumlah_diamond' => 'required|numeric|min:1',
        //     'total_harga' => 'required|numeric|min:1',
        // ]);

        // try {
        //     // $user = User::findOrFail($request->user_id);
        //     // $user->total_harga = $request->total_harga;
        //     // $user->jumlah_diamond = ($user->jumlah_diamond ?? 0) + $request->jumlah_diamond;
        //     // $user->save();

        //     Transaction::create([
        //         'user_id' => $request->user_id,
        //         'jumlah_diamond' => $request->jumlah_diamond,
        //         'total_harga' => $request->total_harga,
        //     ]);

        //     return redirect('/admin/topup')->with('success', 'Topup berhasil!');
        // } catch (\Exception $e) {
        //     return back()->withErrors(['Gagal melakukan topup. Silakan coba lagi.']);
        // }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jumlah_topup' => 'required|numeric|min:1',
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $user->credit = ($user->jumlah_topup ?? 0) + $request->jumlah_topup;
            $user->save();

            return redirect('/admin/topup')->with('success', 'Topup Credit berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors(['Gagal melakukan topup credit. Silakan coba lagi.']);
        }
    }


    // Crud User
    // Get
    public function GShowUser()
    {
        $users = User::all();
        return view('auth.admin.users.index', compact('users'));
    }

    // Get
    public function GCreateUser()
    {
        return view('auth.admin.users.create');
    }

    // Put
    public function PCreateUser(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:4',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240', // max 10MB
            'is_admin' => 'nullable|boolean',
        ]);

        try 
        {
            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            }
    
            User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'avatar' => $avatarPath,
                'is_admin' => $request->boolean('is_admin'), // Pastikan nilainya boolean
            ]);
    
            return redirect('/admin/user')->with('success', 'Akun berhasil dibuat!');

        } catch (\Exception $e) {
        return back()->withErrors(['Gagal membuat akun. Silakan coba lagi.'])->withInput();
    }

    }
    
    public function GUpdateUser($id)
    {
        $user = User::findOrFail($id);
        return view('auth.admin.users.edit', compact('user'));
    }

    public function PUpdateUser(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:4',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'name' => $request->username,
            'username' => $request->username,
            'is_admin' => $request->boolean('is_admin'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return redirect('/admin')->with('success', 'Akun berhasil diperbarui!');
    }




    public function PDeleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('/admin')->with('success', 'Akun berhasil dihapus!');
        } else {
            return redirect('/admin')->with('error', 'Akun tidak ditemukan!');
        }
    }

    public function PTopupUser(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $user = User::find($id);
        if ($user) {
            $user->balance += $request->amount;
            $user->save();
            return redirect('/admin/topup')->with('success', 'Topup berhasil!');
        } else {
            return redirect('/admin/topup')->with('error', 'Akun tidak ditemukan!');
        }
    }
}
