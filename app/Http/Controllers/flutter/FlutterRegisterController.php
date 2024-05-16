<?php

namespace App\Http\Controllers\flutter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Biodata;
use App\Models\KecamatanDesa;
use App\Models\Desa;

class FlutterRegisterController extends Controller
{
    public function register(Request $request)
{
    $dirktp = "foto_ktp/";
    $dirkk = "foto_kk/";
    $imagekk = $request->file('foto_kk');
    $imagektp = $request->file('foto_ktp');
    $imgnamektp = $request->input('nik') . '_ktp' . "." . "jpg";
    $imgnamekk = $request->input('nik') . '_kk' . "." . "jpg";

    if ($request->has('foto_ktp')) {
        $request->validate([
            'foto_ktp' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        Storage::disk('public')->put($dirktp.$imgnamektp, file_get_contents($imagektp));
        Log::info('Foto KTP berhasil disimpan: ' . $dirktp.$imgnamektp);
    }

    if ($request->has('foto_kk')) {
        $request->validate([
            'foto_kk' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        Storage::disk('public')->put($dirkk.$imgnamekk, file_get_contents($imagekk));
        Log::info('Foto KK berhasil disimpan: ' . $dirkk.$imgnamekk);
    }

    Log::info('Data yang diterima:', $request->all());
    
    // Validasi data
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
    ]);
    
    // Ambil nama kecamatan dan desa dari formulir
    $kecamatanNama = $validatedData['kecamatan'];
    $desaNama = $validatedData['desa'];
    
    // Ambil kecamatan dan desa dari database
    $kecamatan = KecamatanDesa::where('nama', $kecamatanNama)->first();
    $desa = Desa::where('nama', $desaNama)->first();

    if ($kecamatan && $desa) {
        // Memasukkan pesan log sebelum menyimpan data
        Log::info('Memulai proses registrasi');
        
        
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
            'foto_ktp' => $imgnamektp ?? null,
            'foto_kk' => $imgnamekk ?? null,
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