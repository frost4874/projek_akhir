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
        $jumlah_requ = DataRequest::where('status', 0)
        ->whereHas('biodata', function ($query) {
            $query->where('id_kec', auth()->user()->kecamatan)
                  ->where('id_desa', auth()->user()->desa);
        })
        ->count();
        $pejabats = DataPejabat::where('id_desa', $id_desa)->get();
        $requests = DataRequest::where('id_desa', $id_desa)
                           ->whereIn('data_requests.status', [2])
                           ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
                           ->select('data_requests.*', 'biodata.nama as nama')
                           ->paginate(2);
        return view('admin.berkas', compact('npage', 'requests','jumlah_requ','pejabats'));
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

    public function viewCetak(Request $request, $id_request)
{
    $dataRequest = DataRequest::where('id_request', $request->id_request)->first();
    $request->validate([
        'nip' => 'required',
    ]);
    if ($dataRequest) {
        $dataRequest->nip = $request->nip;
        $dataRequest->save();

        // Redirect back with success message
        return redirect()->route('cetak.review', ['id_request' => $id_request])->with('success', 'Surat akan dicetak.');
    }

    return back()->with('failed', 'Gagal');
}
}
