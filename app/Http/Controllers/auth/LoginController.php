<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i',
            'password' => 'required',
        ]);
        // Periksa apakah pengguna ada berdasarkan email
    $user = Biodata::where('email', $request->email)->first();

    // Jika tidak ada pengguna dengan email yang diberikan
    if (!$user) {
        return back()->withErrors([
            'email' => 'Email tidak terdaftar.',
        ])->withInput($request->only('email'));
    }

    // Periksa apakah password benar
    if (!\Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'password' => 'Password salah.',
        ])->withInput($request->only('email'));
    }
        if (Auth::guard('biodata')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Check user role after login
            $user = Auth::guard('biodata')->user();

            $request->session()->put('nama', $user->nama);
            $request->session()->put('password', $user->password);
            $request->session()->put('nik', $user->nik);
            $request->session()->put('id_kec', $user->id_kec);
            $request->session()->put('id_desa', $user->id_desa);

            if ($user->role === 'Admin Master') {
                return redirect()->route('admin.dashboard_master'); // Redirect master user to master dashboard
            } elseif ($user->role === 'Admin Desa') {
                return redirect()->route('admin.dashboard'); // Redirect admin desa to their dashboard
            }elseif ($user->role === 'Pemohon') {
                return redirect()->route('pemohon.dashboard'); // Redirect admin desa to their dashboard
            }

            // Default redirect for other roles
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email dan Password Salah.',
        ]);
    }
}

