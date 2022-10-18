<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('dashboard.auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Alert::success('info', 'Logout Berhasil');
        return redirect('/');
    }

    public function login(Request $request)
    {

        $validated = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);


        $cekUsername = User::where('username', $validated['username'])->get();

        if (count($cekUsername->all()) > 0 == false) {
            Alert::error('error', 'Username tidak ditemukan');
            return redirect()->route('home');
        }

        $passwordValid = Hash::check($request->password, $cekUsername[0]['password']);
        if (!$passwordValid) {
            Alert::error('error', 'Password salah');
            return redirect()->route('home');
        }

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $roles = $user->roles[0]->role;
            if ($roles === 'Admin') {
                $request->session()->regenerate();
                Alert::success('info', 'Login Admin Berhasil');
                return redirect()->route('admin.statistik')->with('pesan', 'berhasil login');
            } else if ($roles === 'Petani') {
                $request->session()->regenerate();
                Alert::success('info', 'Login Petani Berhasil');
                return redirect()->route('petani.statistik')->with('pesan', 'berhasil login');
            } else if ($roles === 'Pembeli') {
                $request->session()->regenerate();
                Alert::success('info', 'Login Pembeli Berhasil');
                return redirect()->route('dashboard.pemilik.index')->with('pesan', 'berhasil login');
            }
        }

        Alert::success('error', 'Cek Email dan Password');
        return redirect()->route('home');
    }
}
