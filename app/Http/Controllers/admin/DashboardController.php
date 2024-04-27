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
    $npage = 0;
    $no_agenda = null;
    $user = auth()->user();
    $id_kec = $user->kecamatan;
    $id_desa = $user->desa;
    $form_tambahan = Berkas::getFormTambahanById($id_berkas);
    $biodatas = Biodata::where('desa', $id_desa)->where('role', 'pemohon')->get();
    $pejabats = DataPejabat::where('id_desa', $id_desa)->get();

    $today = Carbon::today(); // Ambil tanggal hari ini
    $no_agenda = DataRequest::whereDate('created_at', $today)->max('no_urut');
    $no_agenda = $no_agenda ? $no_agenda + 1 : 1;

    // $sql_agenda = "SELECT no_urut FROM data_requests where id_kec='$id_kec' and id_desa='$id_desa' order by no_urut DESC limit 1";
    // $no_urut = DB::select($sql_agenda);
    // $no_agenda = $no_urut ? $no_urut[0]->no_urut + 1 : 1;

    // $pejabats = DB::table('data_pejabat')
    //                 ->where('id_kec', $id_kec)
    //                 ->where('id_desa', $id_desa)
    //                 ->get();

    // Ambil data permohonan yang sesuai dengan desa admin dan id_berkas yang diberikan
    $requests = DataRequest::where('id_desa', $id_desa)
                           ->where('id_berkas', $id_berkas) // Filter berdasarkan id_berkas
                           ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
                           ->select('data_requests.*', 'biodata.nama as nama')
                           ->get();

    if (Carbon::now()->diffInDays($today) >= 1) {
        $no_agenda = 1;
        }

    return view('admin.request', [
        'id_berkas' => $id_berkas,
        'judul_berkas' => $judul_berkas,
        'form_tambahan' => $form_tambahan,
        'biodatas' => $biodatas,
        'pejabats' => $pejabats,
        'no_agenda' => $no_agenda,
        'requests' => $requests,
    ],compact('npage'));

}
public function edit($nik, $id_request, $id_berkas, $judul_berkas)
    {
        $npage = 0;
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
        ],compact('npage'));
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
public function viewCetak(Request $request, $id_request)
{
    $dataRequest = DataRequest::where('id_request', $request->id_request)->first();
    $request->validate([
        'no_urut' => 'required',
        'nip' => 'required',
        'acc' => 'required',
    ]);
    if ($dataRequest) {
        $dataRequest->no_urut = $request->no_urut;
        $dataRequest->nip = $request->nip;
        $dataRequest->acc = $request->acc;
        $dataRequest->save();

        // Redirect back with success message
        return redirect()->route('cetak.review', ['id_request' => $id_request])->with('success', 'Surat akan dicetak.');
    }

    return back()->with('failed', 'Gagal');
}

public function reviewCetak($id_request)
{
    $user = auth()->user();
    // Mengambil data request berdasarkan ID
    $request = DataRequest::where('id_request', $id_request)->first();
    Log::info($request);
    $npage= 0;
    // Mengambil data kecamatan dan desa dari tabel Biodata
    $berkas = Berkas::where('id_berkas', $request->id_berkas)->first();
    $bio = Biodata::where('nik', $request->nik)->first();
    $pejabat = DataPejabat::where('nip', $request->nip)->first();
    
    // Lakukan manipulasi data yang diperlukan sebelum dikirim ke view
    $data = [
        'nm_kec' => $user->kecamatan,
        'nm_desa' => $user->desa,
        'alamatdesa' => $user->alamat,
        'tgl_acc' => $request->acc,
        'id_berkas' => $request->id_berkas,
        'no_urut' => $request->no_urut,
        'kode_belakang' => $berkas->kode_belakang,
        'nm_pejabat' => $pejabat->nm_pejabat,
        'jabatan' => $pejabat->jabatan,
        'judul_berkas'=>$berkas->judul_berkas,
        'template'=>$berkas->template,
        'nama' =>$bio->nama,
        'alamat' => $bio->alamat,
        // Tambahkan manipulasi data lainnya sesuai kebutuhan
    ];

    // Panggil view dan kirimkan data
    return view('admin.cetak', compact('data', 'npage'));
}
 
}
