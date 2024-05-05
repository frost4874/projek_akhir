<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\KecamatanDesa;
use App\Models\Desa;
use App\Models\Biodata;

class DataMasyarakatController extends Controller
{

public function index()
{
    // Ambil desa pengguna
    $npage = 1;
    $userDesa = auth()->user()->desa;

    // Ambil data masyarakat berdasarkan desa pengguna
    $biodatas = Biodata::where('desa', $userDesa)->where('role', 'Pemohon')->get();

    return view('admin.datamasyarakat', compact('biodatas','npage'));
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
    ]);

    // Since you're already passing kecamatan and desa names from the form, 
    // you don't need to fetch them from the database
    $user = auth()->user();

    // You can directly use the validated kecamatan and desa from the form
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