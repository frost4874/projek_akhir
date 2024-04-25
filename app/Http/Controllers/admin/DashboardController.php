<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berkas;
use App\Models\Biodata;
use App\Models\DataRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $npage = 0;
        $user = auth()->user();
        $id_kec = $user->kecamatan;
        $id_desa = $user->desa;

        $master_berkas = Berkas::all();
        $card_array = ['bg-info','bg-success','bg-warning','bg-danger'];


        return view('admin.dashboard', compact('master_berkas', 'id_kec', 'id_desa', 'card_array','npage'));
    }

    public function adminRequest(Request $request, $id_berkas, $judul_berkas)
{
    $user = auth()->user();
    $id_desa = $user->desa;
    $form_tambahan = Berkas::getFormTambahanById($id_berkas);
    $biodatas = Biodata::where('desa', $id_desa)->where('role', 'pemohon')->get();

    // Ambil data permohonan yang sesuai dengan desa admin dan id_berkas yang diberikan
    $requests = DataRequest::where('id_desa', $id_desa)
                           ->where('id_berkas', $id_berkas) // Filter berdasarkan id_berkas
                           ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
                           ->select('data_requests.*', 'biodata.nama as nama')
                           ->get();

    return view('admin.request', [
        'id_berkas' => $id_berkas,
        'judul_berkas' => $judul_berkas,
        'form_tambahan' => $form_tambahan,
        'biodatas' => $biodatas,
        'requests' => $requests, // Mengirimkan data permohonan ke view
    ]);

}
public function edit($nik, $id_request, $id_berkas, $judul_berkas)
    {
        // Fetch data for the form based on NIK
        $data = DataRequest::where('nik', $nik)->where('id_request', $id_request)->first();
        $biodata = Biodata::where('nik', $nik)->first();

        // Check if data request exists
        if (!$data) {
            return redirect()->back()->with('error', 'Data request tidak ditemukan.');
        }

        return view('admin.review', [
            'data' => $data,
            'biodata' => $biodata,
            'id_berkas' => $id_berkas,
            'judul_berkas' => $judul_berkas,
        ]);
    }

public function update(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'id_request' => 'required|integer',
        'id_berkas' => 'required|integer',
        'keperluan' => 'required|string',
    ]);

    // Find the data request
    $dataRequest = DataRequest::where('id_request', $request->id_request)
        ->where('id_berkas', $request->id_berkas)
        ->first();

    // Check if the data request exists
    if ($dataRequest) {
        // Update the data request with the new note
        $dataRequest->keperluan = $request->keperluan;
        $dataRequest->save();
        
        // Get the id_berkas from the data request
        $id_berkas = $dataRequest->id_berkas;

        // Get the judul_berkas from the Berkas table
        $judul_berkas = Berkas::find($id_berkas)->judul_berkas;

        // Redirect back with success message
        return redirect()->route('admin.request', ['id_berkas' => $id_berkas, 'judul_berkas' => $judul_berkas])
            ->with(['success', 'Catatan berhasil diperbarui.', 'judul_berkas' => $judul_berkas]);
    }

    // If data request not found, redirect back with error message
    return redirect()->back()->with('error', 'Data request tidak ditemukan.');
}



public function accRequest($id_request)
{
    // Temukan permintaan data yang sesuai
    $dataRequest = DataRequest::find($id_request);

    // Periksa apakah data request ditemukan
    if ($dataRequest) {
        // Ubah status menjadi 1
        $dataRequest->status = 1;
        $dataRequest->keperluan = 'Telah di ACC';
        $dataRequest->save();

        // Redirect back with success message
        return redirect('/dashboard');
    }

    // Jika data request tidak ditemukan, kembalikan dengan pesan error
    return redirect()->back()->with('error', 'Data request tidak ditemukan.');
}

public function tambahRequest(Request $request)
{
    $validatedData = $request->validate([
        'nik' => 'required|max:16',
        'id_berkas' => 'required|string|max:20',
        'keterangan' => 'required|string',
        'form_tambahan' => 'nullable|string|max:255',
    ]);

    $masukan = '';
foreach ($request->all() as $key => $value) {
    if (!in_array($key, ['_token', 'nama', 'nik', 'id_berkas', 'keterangan', 'kirim'])) {
        $variabel = str_replace(" ", "_", $key);
        $masukan .= $variabel . ':' . $value . ', ';
    }
}

$masukan = rtrim($masukan, ', ');

    // Buat objek DataRequest baru
    $newRequest = new DataRequest();
    $newRequest->nik = $validatedData['nik'];
    $newRequest->tanggal_request = $request->tanggal_request;
    $newRequest->status = 0;
    $newRequest->id_berkas = $validatedData['id_berkas'];
    $newRequest->keterangan = $validatedData['keterangan'];
    $newRequest->form_tambahan = $masukan;
    $newRequest->id_kec = auth()->user()->kecamatan;
    $newRequest->id_desa = auth()->user()->desa;
    
    // tambahkan pengisian atribut lainnya sesuai kebutuhan

    // Simpan request baru
    $newRequest->save();

    // Redirect atau kembalikan respons sesuai kebutuhan
    return redirect()->back()->with('success', 'Request baru telah ditambahkan!');
}
 
}
