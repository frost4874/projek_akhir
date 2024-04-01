<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Berkas;
use App\Models\Biodata;

class DashboardMasterController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $master_berkas = Berkas::all();
        $card_array = ['bg-info','bg-success','bg-warning','bg-danger'];


        return view('master_admin.dashboard', compact('master_berkas', 'card_array'));
    }

    public function master()
    {
        $user = auth()->user()->nik;
        
        $biodatas = Biodata::where('nik', $user)->get();
        return view('master_admin.biodatamaster', compact('biodatas'));
    }
}
