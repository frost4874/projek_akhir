<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $npage = 3;
        $userDesa = auth()->user()->desa;
        $status = 3;
        $jumlah_requ = DataRequest::where('status', 0)
        ->whereHas('biodata', function ($query) {
            $query->where('id_kec', auth()->user()->kecamatan)
                  ->where('id_desa', auth()->user()->desa);
        })
        ->count();
        $requests = DataRequest::where('id_desa', $userDesa)
                        ->where('data_requests.status', $status)
                        ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
                        ->join('berkas', 'data_requests.id_berkas', '=', 'berkas.id_berkas')
                        ->select('data_requests.*', 'biodata.nama as nama', 'berkas.judul_berkas as judul_berkas')
                        ->paginate(5);

        
        return view('admin.laporan', ['requests' => $requests], compact('npage','jumlah_requ'));
    }

    public function cetak_pdf()
    {
        $userdesa = auth()->user()->desa;
        $requests = DataRequest::where('id_desa', $userdesa)->where('data_requests.status', 3)
        ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
        ->get(['data_requests.*', 'biodata.nama']);
        $pdf = PDF::loadview('admin.laporan_pdf', ['requests' => $requests]);
        return $pdf->download('laporan-pdf.pdf');
    }

    public function print()
{
    // Ambil informasi desa dari pengguna yang sedang login
    $userdesa = auth()->user()->desa;

    // Ambil data permohonan yang sesuai dengan desa pengguna yang sedang login dan memiliki status 4
    $requests = DataRequest::where('id_desa', $userdesa)->where('data_requests.status', 3)
        ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
        ->get(['data_requests.*', 'biodata.nama']);

    // Kirim data yang telah difilter ke tampilan untuk dicetak
    return view('admin.laporan_cetak', ['requests' => $requests]);
}


public function rangeprint(Request $request)
{
    // Ambil data dari form filter
    $tanggalDari = $request->input('tanggal_dari');
    $tanggalSampai = $request->input('tanggal_sampai');
    $userdesa = auth()->user()->desa;
    // Lakukan query berdasarkan filter tanggal
    $requests = DataRequest::whereBetween('acc', [$tanggalDari, $tanggalSampai])->where('id_desa', $userdesa)
                           ->where('data_requests.status', 3)
                           ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
                           ->get(['data_requests.*', 'biodata.nama']);

    // Kirim data ke view PDF dan buat objek PDF
    $pdf = PDF::loadView('admin.laporan_pdf', compact('requests'));

    // Download PDF
    return $pdf->download('laporan.pdf');
}
}
