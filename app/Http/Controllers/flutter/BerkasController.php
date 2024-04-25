<?php

namespace App\Http\Controllers\flutter;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller; // Import Controller class dari namespace yang benar
use Illuminate\Http\Request;
use App\Models\Berkas;
use App\Models\DataRequest;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\Biodata;

class BerkasController extends Controller
{
    public function index()
    {
        // Mengambil semua kolom dari model Berkas
        $berkas = Berkas::all();

        // Mengonversi koleksi berkas menjadi array yang berisi judul_berkas dan id_berkas
        $judul_dan_id_berkas = $berkas->map(function($item) {
            return [
                'id_berkas' => $item->id_berkas,
                'judul_berkas' => $item->judul_berkas,
                'form_tambahan' => $item->form_tambahan
            ];
        })->toArray();

        return response()->json([
            'success' => true,
            'berkas' => $judul_dan_id_berkas,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'id_berkas' => 'required',
            'nik' => 'required',
            'form_tambahan' => 'required',
            'id_kec' => 'required',
            'id_desa' => 'required',
            'status' => 'required',
            'tanggal_request' => 'required',
            'keterangan' => 'required',
        ]);

        // Simpan data ke dalam database
        $requestData = DataRequest::create($validatedData);

        // Jika berhasil disimpan, kirim response berhasil
        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    public function show($nik)
    {
        $dataRequests = DataRequest::where('nik', $nik)
            ->with('berkas:id_berkas,judul_berkas')
            ->get();

        if ($dataRequests->isEmpty()) {
            return response()->json(['message' => 'Data not found'], 404);
        } else {
            return response()->json($dataRequests);
        }
    }

    public function update(Request $request, $id_request)
{
    // Validasi data
    $validatedData = $request->validate([
        'form_tambahan' => 'required',
        'keterangan' => 'required',
    ]);

    // Cari data request yang akan diperbarui berdasarkan 'id_request'
    $dataRequest = DataRequest::find($id_request);

    // Jika data request tidak ditemukan, kirim response 404
    if (!$dataRequest) {
        return response()->json(['message' => 'Data not found'], 404);
    }

    // Perbarui data request dengan data yang divalidasi
    $dataRequest->update($validatedData);

    // Kirim response berhasil
    return response()->json(['message' => 'Data berhasil diperbarui'], 200);
}

public function riwayat(Request $request)
    {
        $nik = $request->nik;
        $riwayats = DataRequest::where('nik', $nik)
        ->with('berkas:id_berkas,judul_berkas')
        ->get();

        return response()->json($riwayats);
    }


}
