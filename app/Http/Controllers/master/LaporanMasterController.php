<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataRequest;
use App\Models\Desa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LaporanMasterController extends Controller
{
    public function index()
    {
        $status = 3;
        $npage= 4;
        $requests = DataRequest::where('data_requests.status', $status)
                        ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
                        ->join('berkas', 'data_requests.id_berkas', '=', 'berkas.id_berkas')
                        ->select('data_requests.*', 'biodata.nama as nama', 'berkas.judul_berkas as judul_berkas')
                        ->paginate(2);
        return view('master_admin.laporan',compact('requests','npage'));
    }
    public function masterprint(Request $request)
{
    // Ambil data dari form filter
    $tanggalDari = $request->input('tanggal_dari');
    $tanggalSampai = $request->input('tanggal_sampai');
    $desaId = $request->input('desa'); // Ubah nama variabel menjadi 'desaId'

    // Cari nama desa berdasarkan ID desa
    $desa = Desa::find($desaId);

    // Jika desa ditemukan, ambil namanya, jika tidak, set nama desa menjadi null
    $namaDesa = $desa ? $desa->nama : null;

    \Log::info($namaDesa); // Log nama desa

    // Lakukan query berdasarkan filter tanggal dan desa
    $query = DataRequest::where('data_requests.status', 3)
                        ->join('biodata', 'data_requests.nik', '=', 'biodata.nik');

    // Jika kedua tanggal dan desa kosong
    if (empty($tanggalDari) && empty($tanggalSampai) && empty($namaDesa)) {
        $requests = $query->get(['data_requests.*', 'biodata.nama']);
    } else {
        // Pilih kolom sebelum get()
        $query->select('data_requests.*', 'biodata.nama');

        // Filter berdasarkan tanggal jika tidak kosong
        if (!empty($tanggalDari) && !empty($tanggalSampai)) {
            $query->whereBetween('acc', [$tanggalDari, $tanggalSampai]);
        }

        // Filter berdasarkan desa jika tidak kosong
        if (!empty($namaDesa)) {
            $query->where('data_requests.id_desa', $namaDesa); // Ubah menjadi nama desa
        }

        // Ambil hasil query
        $requests = $query->get();
    }

    // Kirim data ke view PDF dan buat objek PDF
    $pdf = PDF::loadView('admin.laporan_pdf', compact('requests'));

    // Download PDF
    return $pdf->download('laporan.pdf');
}



}
