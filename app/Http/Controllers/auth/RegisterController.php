<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biodata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\KecamatanDesa;
use App\Models\Desa;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|numeric|unique:biodata',
            'nama' => 'required|string|max:100',
            // 'email' => 'required|string|max:50',
            'jekel' => 'required|in:Laki-Laki,Perempuan',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'kota' => 'required|string|max:6',
            'tgl_lahir' => 'required|date',
            'password' => 'required|string|min:8',
        ]);

        // Ambil ID kecamatan dan desa dari formulir
        $kecamatanId = $validatedData['kecamatan'];
        $desaId = $validatedData['desa'];

        // Ambil nama kecamatan dan desa berdasarkan ID
        $kecamatan = KecamatanDesa::find($kecamatanId);
        $desa = Desa::find($desaId);

        if ($kecamatan && $desa) {
            $biodata = Biodata::create([
                'nik' => $validatedData['nik'],
                'nama' => $validatedData['nama'],
                // 'email' => $validatedData['email'],
                'jekel' => $validatedData['jekel'],
                'kecamatan' => $kecamatan->nama,
                'desa' => $desa->nama,
                'kota' => $validatedData['kota'],
                'tgl_lahir' => $validatedData['tgl_lahir'],
                'password' => Hash::make($validatedData['password']),
                'status' => 'Aktif',
            ]);
            
            Auth::login($biodata);          
            return back()->with('success', 'Registrasi berhasil');
        } else {
            return back()->withInput()->withErrors(['error' => 'Kecamatan atau desa tidak valid']);
        }
    }
}
