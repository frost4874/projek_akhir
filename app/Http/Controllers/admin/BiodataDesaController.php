<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata;
use App\Models\KecamatanDesa;
use App\Models\DataRequest;
use App\Models\Desa;

class BiodataDesaController extends Controller
{
    public function index()
    {
        $npage = 5;
        $user = auth()->user()->nik;
        $jumlah_requ = DataRequest::where('status', 0)
        ->whereHas('biodata', function ($query) {
            $query->where('id_kec', auth()->user()->kecamatan)
                  ->where('id_desa', auth()->user()->desa);
        })
        ->count();
        $biodatas = Biodata::where('nik', $user)->get();
        return view('admin.biodatadesa', compact('biodatas', 'npage','jumlah_requ'));
    }
    public function ubah($nik)
    {
        $npage = 3;
        $data = Biodata::where('nik', $nik)->first();
        $jumlah_requ = DataRequest::where('status', 0)
        ->whereHas('biodata', function ($query) {
            $query->where('id_kec', auth()->user()->kecamatan)
                  ->where('id_desa', auth()->user()->desa);
        })
        ->count();
        return view('admin.ubahdesa', compact('data', 'npage','jumlah_requ'));
    }

    public function update(Request $request, $nik)
{
    $validatedData = $request->validate([
        'nama' => 'required|string|max:50',
        'jekel' => 'required|in:Laki-Laki,Perempuan',
        'tgl_lahir' => 'required|date',
        'tempat_lahir' => 'nullable|string|max:30',
        'alamat' => 'nullable|string',
        'telepon' => 'nullable|string|max:13',
        'email' => 'nullable|email|max:50',
        'website' => 'nullable|string|max:20',
        'kodepos' => 'nullable|string|max:50',
    ]);

    // Ambil data biodata berdasarkan NIK
    $biodata = Biodata::where('nik', $nik)->first();

    // Update data biodata
    $biodata->update($validatedData);

    // Periksa apakah bidang password diisi dalam permintaan
    if ($request->filled('password')) {
        // Validasi bidang password
        $request->validate([
            'password' => 'required|string|min:8', // Atur aturan validasi sesuai kebutuhan Anda
        ]);

        // Update password
        $biodata->password = bcrypt($request->password);
        $biodata->save();
    }

    // Redirect ke halaman lain atau tampilkan pesan sukses
    return redirect()->route('admin.biodata_desa')->with('success', 'Biodata berhasil diperbarui.');
}

}
