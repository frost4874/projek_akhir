<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata;
use App\Models\KecamatanDesa;
use App\Models\Desa;

class BiodataDesaController extends Controller
{
    public function index()
    {
        $npage = 3;
        $user = auth()->user()->nik;
        
        $biodatas = Biodata::where('nik', $user)->get();
        return view('admin.biodatadesa', compact('biodatas', 'npage'));
    }
    public function ubah($nik)
    {
        $npage = 3;
        $data = Biodata::where('nik', $nik)->first();
        return view('admin.ubahdesa', compact('data', 'npage'));
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
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'website' => 'nullable|string|max:20',
            'kodepos' => 'nullable|string|max:50',
        ]);

        // Ambil data biodata berdasarkan NIK
        $biodata = Biodata::where('nik', $nik)->firstOrFail();

        // Update data biodata
        $biodata->update($validatedData);


        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('admin.biodata_desa')->with('success', 'Biodata berhasil diperbarui.');
    }
}
