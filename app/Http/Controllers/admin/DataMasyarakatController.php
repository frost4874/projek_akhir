<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

}
