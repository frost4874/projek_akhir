<?php

namespace App\Http\Controllers\flutter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Import class Log
use App\Models\Biodata;
use App\Models\KecamatanDesa;
use App\Models\Desa;

class FlutterRegisterController extends Controller
{
    public function register(Request $request)
{
    // Memasukkan pesan log sebelum validasi data
    Log::info('Memulai proses registrasi');
    Log::info('Data yang diterima:', $request->all());

    $validatedData = $request->validate([
        'nik' => 'required|numeric|unique:biodata',
        'nama' => 'required|string|max:100',
        'telepon' => 'nullable|digits_between:10,13',
        'email' => 'nullable|email|max:50',
        'jekel' => 'required|in:Laki-Laki,Perempuan',
        'kecamatan' => 'required|string|max:100',
        'desa' => 'required|string|max:100',
        'kota' => 'required|string|max:6',
        'tgl_lahir' => 'required|date',
        'alamat' => 'nullable|string',
        'password' => 'required|string|min:8',
        // 'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // 'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Memasukkan pesan log setelah validasi data
    Log::info('Data berhasil divalidasi');

    // Simpan gambar KTP
    if ($request->hasFile('foto_ktp')) {
        $fotoKtp = $request->file('foto_ktp');
        $ext = $fotoKtp->getClientOriginalExtension();
        $nik = $validatedData['nik'];
        $fotoKtpFileName = $nik . '_ktp.' . $ext;
        $fotoKtpPath = $fotoKtp->storeAs('public/foto_ktp', $fotoKtpFileName);
    
        // Memasukkan pesan log setelah penyimpanan gambar KTP
        Log::info('Gambar KTP berhasil disimpan', ['path' => $fotoKtpPath]);
    }
    

    // Simpan gambar KK
if ($request->hasFile('foto_kk')) {
    $fotoKk = $request->file('foto_kk');
    $ext = $fotoKk->getClientOriginalExtension();
    $nik = $validatedData['nik'];
    $fotoKkFileName = $nik . '_kk.' . $ext;
    $fotoKkPath = $fotoKk->storeAs('public/foto_kk', $fotoKkFileName);

    // Memasukkan pesan log setelah penyimpanan gambar KK
    Log::info('Gambar KK berhasil disimpan', ['path' => $fotoKkPath]);
}


    // Ambil nama kecamatan dan desa dari formulir
    $kecamatanNama = $validatedData['kecamatan'];
    $desaNama = $validatedData['desa'];

    // Ambil kecamatan dan desa dari database
    $kecamatan = KecamatanDesa::where('nama', $kecamatanNama)->first();
    $desa = Desa::where('nama', $desaNama)->first();

    if ($kecamatan && $desa) {
        $biodata = Biodata::create([
            'nik' => $validatedData['nik'],
            'nama' => $validatedData['nama'],
            'jekel' => $validatedData['jekel'],
            'email' => $validatedData['email'],
            'telepon' => $validatedData['telepon'],
            'kecamatan' => $kecamatan->nama,
            'desa' => $desa->nama,
            'kota' => $validatedData['kota'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'alamat' => $validatedData['alamat'],
            'password' => Hash::make($validatedData['password']),
            'foto_ktp' => $fotoKtpFileName,
            'foto_kk' => $fotoKkFileName,
            'role' => 'Pemohon',
            'status' => 'Tidak Aktif',
        ]);

        // Memasukkan pesan log jika registrasi berhasil
        Log::info('Registrasi berhasil', ['user' => $biodata]);

        return response()->json([
            'message' => 'Registrasi berhasil',
            'user' => $biodata,
        ], 200);
    } else {
        // Memasukkan pesan log jika kecamatan atau desa tidak valid
        Log::info('Kecamatan atau desa tidak valid');

        return response()->json([
            'error' => 'Kecamatan atau desa tidak valid'
        ], 400);
    }
}

}
