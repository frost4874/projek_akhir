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
        $requests = DataRequest::where('id_desa', $userDesa)
                        ->where('data_requests.status', $status)
                        ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
                        ->join('berkas', 'data_requests.id_berkas', '=', 'berkas.id_berkas')
                        ->select('data_requests.*', 'biodata.nama as nama', 'berkas.judul_berkas as judul_berkas')
                        ->paginate(5);

        
        return view('admin.laporan', ['requests' => $requests], compact('npage'));
    }

    public function cetak_pdf()
    {
        $requests = DataRequest::all();
 
        $pdf = PDF::loadview('admin.laporan_pdf', ['requests' => $requests]);
        return $pdf->download('laporan-pdf');
    }

    public function print()
{
    // Ambil informasi desa dari pengguna yang sedang login
    $userdesa = auth()->user()->desa;

    // Ambil data permohonan yang sesuai dengan desa pengguna yang sedang login dan memiliki status 4
    $requests = DataRequest::where('id_desa', $userdesa)->where('status', 4)->get();

    // Kirim data yang telah difilter ke tampilan untuk dicetak
    return view('admin.laporan_cetak', ['requests' => $requests]);
}


public function filter(Request $request)
{
    // Ambil data dari form filter
    $tanggalDari = $request->input('tanggal_dari');
    $tanggalSampai = $request->input('tanggal_sampai');
    
    // Konversi format tanggal
    $tanggalDari = date('Y-m-d', strtotime($tanggalDari));
    $tanggalSampai = date('Y-m-d', strtotime($tanggalSampai));

    // Lakukan query berdasarkan filter tanggal dan paginasi
    $requests = DataRequest::whereBetween('acc', [$tanggalDari, $tanggalSampai])->paginate(5);

    // Kirim data ke view dengan objek LengthAwarePaginator
    return view('admin.laporan', compact('requests'));
}
}
