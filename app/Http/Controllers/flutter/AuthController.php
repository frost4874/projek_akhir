<?php

namespace App\Http\Controllers\flutter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('nik', 'password');

        if (Auth::guard('biodata')->attempt($credentials)) {
            $user = Auth::guard('biodata')->user();
            $token = $user->createToken('MyApp')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function profile($nik)
    {
        $user = Biodata::where('nik', $nik)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'name' => $user->nama,
            'kecamatan' => $user->kecamatan,
            'desa' => $user->desa,
        ]);
    }

public function update(Request $request)
{
    $validatedData = $request->validate([
        'nik' => 'required|numeric',
        'nama' => 'required|string|max:50',
        'jekel' => 'required|in:Laki-Laki,Perempuan',
        'kota' => 'required|string|max:6',
        'tempat_lahir' => 'nullable|string|max:30',
        'tgl_lahir' => 'required|date',
        'pekerjaan' => 'nullable|string|max:20',
        'agama' => 'nullable|string|max:20',
        'warganegara' => 'nullable|string|max:10',
        'status_nikah' => 'nullable|string|max:20',
        'status_warga' => 'nullable|string|max:20',
        'alamat' => 'required|string|max:100',
        'telepon' => 'required|string|max:13',
        'email' => 'required|string|email|max:50',
        'kecamatan' => 'required|string',
        'desa' => 'required|string',
        'rt' => 'nullable|string|max:10',
        'rw' => 'nullable|string|max:10',
        'password' => 'nullable|string|min:8',
    ]);

    $nik = $validatedData['nik'];
    \Log::info("Requested NIK: $nik");

    $dataRequest = Biodata::where('nik', $nik)->first();

    if (!$dataRequest) {
        \Log::error("Data not found for NIK: $nik");
        return response()->json(['message' => 'Data not found'], 404);
    }

    if (isset($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }
    $dataRequest->update($validatedData);

    return response()->json(['message' => 'Data berhasil diperbarui'], 200);
}



    
}
