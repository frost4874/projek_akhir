<?php

namespace App\Http\Controllers\flutter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata;

class FlutterLoginController extends Controller
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
            'nik' => $user->nik,
            'name' => $user->nama,
            'email' => $user->email,
            'jekel' => $user->jekel,
            'kecamatan' => $user->kecamatan,
            'desa' => $user->desa,
            'kota' => $user->kota,
            'tempat_lahir' => $user->tempat_lahir,
            'tgl_lahir' => $user->tgl_lahir,
            'agama' => $user->agama,
            'alamat' => $user->alamat,
            'telepon' => $user->telepon,
            'status_warga' => $user->status_warga,
            'warganegara' => $user->warganegara,
            'status_nikah' => $user->status_nikah,
            'rt' => $user->rt,
            'rw' => $user->rw,
        ]);
    }

}
