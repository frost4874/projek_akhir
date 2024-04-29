<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataRequest;
use Illuminate\Support\Facades\Auth;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $npage = 3;
        $requests = DataRequest::All();
        return view('admin.laporan',['requests'=>$requests], compact('npage'));
    }
    public function cetak_pdf()
    {
    	$requests = DataRequest::all();
 
    	$pdf = PDF::loadview('admin.laporan_pdf',['requests'=>$requests]);
    	return $pdf->download('laporan-pdf');
    }
    public function print()
    {
    	$requests = DataRequest::All();
    	return view('admin.laporan_cetak', ['requests' => $requests]);
    }
}
