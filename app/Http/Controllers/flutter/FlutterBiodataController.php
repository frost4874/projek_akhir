<?php

namespace App\Http\Controllers\flutter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Biodata;

class FlutterBiodataController extends Controller
{
    public function index()
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
