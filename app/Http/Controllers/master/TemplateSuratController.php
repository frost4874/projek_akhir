<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berkas;
use Illuminate\Support\Facades\Auth;

class TemplateSuratController extends Controller
{
    public function index()
    {
        $master_berkas = Berkas::all();
        return view('master_admin.templatesurat', compact('master_berkas'));
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'judul_berkas' => 'required|string|max:255',
            'kode_berkas' => 'required|string|max:10',
            'kode_belakang' => 'required|string|max:10',
            'template' => 'required|string',
            'form_tambahan' => 'nullable|string|max:255',
        ]);
        $formTambahan = explode(',', $request->form_tambahan);
        // Ganti spasi dengan garis bawah (_) pada setiap elemen form tambahan
        foreach ($formTambahan as $key => $value) {
            $formTambahan[$key] = str_replace(' ', '_', $value);
        }
        // Simpan data berkas baru ke database
        $berkas = new Berkas();
        $berkas->judul_berkas = $validatedData['judul_berkas'];
        $berkas->kode_berkas = $validatedData['kode_berkas'];
        $berkas->kode_belakang = $validatedData['kode_belakang'];
        $berkas->template = $validatedData['template'];
        $berkas->form_tambahan = implode(',', $formTambahan); 
        // $berkas->form_tambahan = str_replace(" ", "_", $validatedData->form_tambahan);
        // $berkas->form_tambahan = $validatedData['form_tambahan'];
        $berkas->save();

        // Redirect ke halaman atau tampilkan pesan sukses
        return redirect()->route('admin.templatesurat')->with('success', 'Data berkas berhasil disimpan.');
    }
    public function update(Request $request, $id_berkas)
    {
        $master_berkas = Berkas::findOrFail($id_berkas);
        $master_berkas->update([
            'judul_berkas' => $request->input('judul_berkas'),
            'kode_berkas' => $request->input('kode_berkas'),
            'kode_belakang' => $request->input('kode_belakang'),
            'template' => $request->input('template'),
            'form_tambahan' => $request->input('form_tambahan'),
        ]);

        return redirect()->back()->with('success', 'Berkas berhasil diperbarui.');
    }
    public function destroy($id_berkas)
    {
        $berkas = Berkas::where('id_berkas', $id_berkas)->first();
        if ($berkas) {
            $berkas->delete();
            return redirect()->back()->with('success', 'Berkas berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Berkas tidak ditemukan.');
        }
    }

}
