<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller {

    public function index() {

        return view('login.index');
    }

    public function authenticate(Request $request) {

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if($user) {
            if($user->status == 0) {
                return redirect()->back()->with('warning', 'Silahkan hubungi Admin KSI.');
            }
        }
        else {
            return redirect()->back();
        }

        if(Auth::attempt($credentials)) {
            $request->session()->regenerateToken();

            return redirect()->route('dashboardUnit')->with('success', 'Login Berhasil: Selamat datang');
        }
        else {
            return redirect()->back()->with('error', 'Login gagal: Silahkan cek username dan password anda.');
        }
    }

    public function logout(Request $request) {

        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
