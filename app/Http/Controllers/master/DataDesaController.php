<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Biodata;
use App\Models\KecamatanDesa;
use App\Models\Desa;

class DataDesaController extends Controller
{
    public function index()
    {
        $npage= 2;
        $biodatas = Biodata::where('role', 'Admin Desa')->paginate(2);
        return view('master_admin.admindesa', compact('biodatas', 'npage'));
    }
    public function tambah(Request $request)
{
    $validatedData = $request->validate([
        // 'nik' => 'required|numeric|unique:biodata',
        'nama' => 'required|string|max:100',
        'jekel' => 'required|in:Laki-Laki,Perempuan',
        'kecamatan' => 'required|integer',
        'desa' => 'required|integer',
        'kota' => 'required|string|max:100',
        'tgl_lahir' => 'required|date|before_or_equal:' . Carbon::now()->subYears(17)->format('Y-m-d'),
        'password' => 'required|string|min:8',
        'telepon' => 'required|digits_between:10,13|regex:/^08\d{9,11}$/',
        'kodepos' => 'nullable|digits:5',
        'alamat' => 'nullable|string',
        'email' => 'required|email|unique:biodata,email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i|max:50',
    ]);

    $kecamatan = KecamatanDesa::find($validatedData['kecamatan']);
    $desa = Desa::find($validatedData['desa']);

    if (!$kecamatan || !$desa) {
        return back()->with('error', 'Kecamatan atau Desa tidak ditemukan');
    }

    Biodata::create([
        // 'nik' => $validatedData['nik'],
        'nama' => $validatedData['nama'],
        'jekel' => $validatedData['jekel'],
        'kecamatan' => $kecamatan->nama,
        'desa' => $desa->nama,
        'kota' => $validatedData['kota'],
        'tgl_lahir' => $validatedData['tgl_lahir'],
        'password' => Hash::make($validatedData['password']),
        'alamat' => $validatedData['alamat'],
        'telepon' => $validatedData['telepon'],
        'kodepos' => $validatedData['kodepos'],
        'email' => $validatedData['email'],
        'role' => 'Admin Desa',
        'status' => 'Aktif',
    ]);

    return redirect()->back()->with('success', 'Registrasi berhasil');
}

    public function update(Request $request, $nik)
    {
        // Validasiasi data yang dikirim dari formulir
        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'jekel' => 'required|in:Laki-Laki,Perempuan',
            'tgl_lahir' => 'required|date|before_or_equal:' . Carbon::now()->subYears(17)->format('Y-m-d'),
            'alamat' => 'nullable|string',
            'telepon' => 'required|string|digits_between:10,13|regex:/^08\d{9,11}$/',
            'email' => 'required|string|email|unique:biodata,email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i|max:50',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'website' => 'nullable|string|max:10',
            'kodepos' => 'nullable|string|digits:5',
        ]);

        // Ambil data biodata berdasarkan NIK
        $biodata = Biodata::where('nik', $nik)->firstOrFail();

        // Update data biodata
        $biodata->update($validatedData);


        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('admin.data_admindesa')->with('success', 'Biodata berhasil diperbarui.');
    }
    public function destroy($nik)
    {
        $biodata = Biodata::where('nik', $nik)->first();
        $biodata->delete();
        return redirect()->route('admin.data_admindesa')->with('success', 'Pejabat berhasil dihapus');
    }
}
