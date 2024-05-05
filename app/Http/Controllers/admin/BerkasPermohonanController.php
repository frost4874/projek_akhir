<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berkas;
use App\Models\Biodata;
use App\Models\DataPejabat;
use App\Models\DataRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BerkasPermohonanController extends Controller
{
    public function index()
    {
        $npage = 2;
        $user = auth()->user();
        $id_desa = $user->desa;
        $requests = DataRequest::where('id_desa', $id_desa)
                           ->whereIn('data_requests.status', [2])
                           ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
                           ->select('data_requests.*', 'biodata.nama as nama')
                           ->get();
        return view('admin.berkas', compact('npage', 'requests'));
    }

    public function telahDiambil($id_berkas)
    {        
        // Contoh:
        $data = DataRequest::find($id_berkas);
        $data->status = 3;
        $data->save();

        // Atau Anda dapat melakukan apa pun yang sesuai dengan kebutuhan aplikasi Anda

        // Setelah operasi selesai, Anda dapat mengembalikan respons yang sesuai
        return redirect()->back()->with('success', 'Status telah diperbarui.');
    }
}
