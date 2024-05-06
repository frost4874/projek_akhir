<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Models\KecamatanDesa;
use App\Models\Desa;
use App\Models\Biodata;
use App\Models\DataRequest;

class DataMasyarakatController extends Controller
{

public function index()
{
    // Ambil desa pengguna
    $npage = 1;
    $userDesa = auth()->user()->desa;

    // Ambil data masyarakat berdasarkan desa pengguna
    $biodatas = Biodata::where('desa', $userDesa)->where('role', 'Pemohon')->get();
    $jumlah_requ = DataRequest::where('status', 0)
        ->whereHas('biodata', function ($query) {
            $query->where('id_kec', auth()->user()->kecamatan)
                  ->where('id_desa', auth()->user()->desa);
        })
        ->count();
    return view('admin.datamasyarakat', compact('biodatas','npage','jumlah_requ'));
}

    public function update(Request $request, $nik)
    {
        // Validasiasi data yang dikirim dari formulir
        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'jekel' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:30',
            'tgl_lahir' => 'required|date',
            'pekerjaan' => 'nullable|string|max:20',
            'agama' => 'nullable|string|max:20',
            'warganegara' => 'nullable|string|max:10',
            'status_nikah' => 'nullable|string|max:20',
            'status_warga' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:13',
            'email' => 'nullable|string|email|max:50',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
        ]);

        // Ambil data biodata berdasarkan NIK
        $biodata = Biodata::where('nik', $nik)->firstOrFail();

        // Update data biodata
        $biodata->update($validatedData);


        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('admin.data_masyarakat')->with('success', 'Biodata berhasil diperbarui.');
    }
    public function destroy($nik)
    {
        $biodata = Biodata::where('nik', $nik)->first();
        $biodata->delete();
        return redirect()->route('admin.data_masyarakat')->with('success', 'Pejabat berhasil dihapus');
    }

    public function register(Request $request)
{
    $validatedData = $request->validate([
        'nik' => 'required|numeric|unique:biodata',
        'nama' => 'required|string|max:100',
        'email' => 'required|string|max:50',
        'jekel' => 'required|in:Laki-Laki,Perempuan',
        'kecamatan' => 'required|string|max:100',
        'desa' => 'required|string|max:100',
        'kota' => 'required|string|max:6',
        'tgl_lahir' => 'required|date',
        'password' => 'required|string|min:8',
        'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Simpan gambar KTP
    $fotoKtp = $request->file('foto_ktp');
    $fotoKtpFileName = $validatedData['nik'] . '_ktp.' . $fotoKtp->getClientOriginalExtension();
    $fotoKtpPath = $fotoKtp->storeAs('public/foto_ktp', $fotoKtpFileName);

    // Simpan gambar KK
    $fotoKk = $request->file('foto_kk');
    $fotoKkFileName = $validatedData['nik'] . '_kk.' . $fotoKk->getClientOriginalExtension();
    $fotoKkPath = $fotoKk->storeAs('public/foto_kk', $fotoKkFileName);

    // Simpan data biodata
    $user = auth()->user();
    $biodata = Biodata::create([
        'nik' => $validatedData['nik'],
        'nama' => $validatedData['nama'],
        'email' => $validatedData['email'],
        'jekel' => $validatedData['jekel'],
        'kecamatan' => $validatedData['kecamatan'],
        'desa' => $validatedData['desa'],
        'kota' => $validatedData['kota'],
        'tgl_lahir' => $validatedData['tgl_lahir'],
        'password' => Hash::make($validatedData['password']),
        'foto_ktp' => $fotoKtpFileName,
        'foto_kk' => $fotoKkFileName,
        'role' => 'Pemohon',
        'status' => 'Aktif',
    ]);

    Auth::login($user);

    return back()->with('success', 'Registrasi berhasil');
}




public function verifRegist($nik)
{
    // Temukan permintaan data yang sesuai
    $dataRequest = Biodata::where('nik', $nik)->first();
    // Periksa apakah data request ditemukan
    if ($dataRequest) {
        // Ubah status menjadi 'Aktif'
        $dataRequest->status = 'Aktif';
        $dataRequest->save();
        
        return back()->with('success', 'Verifikasi berhasil');
        }


}
}