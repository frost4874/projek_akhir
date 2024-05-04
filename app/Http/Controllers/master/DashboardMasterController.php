<?php

namespace App\Http\Controllers\Master;

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

class DashboardMasterController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $master_berkas = Berkas::all();
        $card_array = ['bg-info','bg-success','bg-warning','bg-danger'];


        return view('master_admin.dashboard', compact('master_berkas', 'card_array'));
    }
    public function masterRequest(Request $request, $id_berkas, $judul_berkas)
{
    $npage = 0;
    $status = 4;
    $requests = DataRequest::where('id_berkas', $id_berkas)
                       ->where('status', $status)
                       ->join('biodata', 'data_requests.nik', '=', 'biodata.nik')
                       ->select('data_requests.*', 'biodata.nama as nama')
                       ->get();
    return view('master_admin.request', [
        'id_berkas' => $id_berkas,
        'judul_berkas' => $judul_berkas,
        'requests' => $requests, // Memasukkan $requests ke dalam array
        'npage' => $npage, // Juga, pastikan untuk menyertakan npage dalam array
    ]);
}


    public function reviewSurat($id_request)
{

    // Mengambil data request berdasarkan ID
    $request = DataRequest::where('id_request', $id_request)->first();
    $npage= 0;
    // Mengambil data kecamatan dan desa dari tabel Biodata
    $berkas = Berkas::where('id_berkas', $request->id_berkas)->first();
    $bio = Biodata::where('nik', $request->nik)->first();
    $pejabat = DataPejabat::where('nip', $request->nip)->first();
    $alamat_desa = Biodata::where('desa', $bio->desa)->where('role', 'Admin Desa')->first();
    // Parsing nilai form_tambahan menjadi array asosiatif
    $form_tambahan_array = [];
    if ($request->form_tambahan) {
    $form_tambahan_pairs = explode(', ', $request->form_tambahan);
    foreach ($form_tambahan_pairs as $pair) {
        // Pisahkan $pair menjadi dua bagian berdasarkan tanda titik dua (:)
        $pair_parts = explode(':', $pair);
        
        // Pastikan ada dua bagian setelah pemisahan
        if (count($pair_parts) === 2) {
            // Ambil bagian pertama sebagai kunci (key) dan bagian kedua sebagai nilai (value)
            $key = trim($pair_parts[0]); // Hapus spasi di awal dan akhir kunci
            $value = trim($pair_parts[1]); // Hapus spasi di awal dan akhir nilai
            // Simpan dalam array asosiatif $form_tambahan_array
            $form_tambahan_array[$key] = $value;
        }
    }}
    
    // Lakukan manipulasi data yang diperlukan sebelum dikirim ke view
    $data = [
        'nm_kec' => $bio->kecamatan,
        'nm_desa' => $bio->desa,
        'alamatdesa' => $alamat_desa->alamat,
        'tgl_acc' => $request->acc,
        'id_berkas' => $request->id_berkas,
        'no_urut' => $request->no_urut,
        'kode_belakang' => $berkas->kode_belakang,
        'nm_pejabat' => $pejabat->nm_pejabat,
        'jabatan' => $pejabat->jabatan,
        'judul_berkas' => $berkas->judul_berkas,
        'template' => $this->replaceVariables($berkas->template, [
            'nama' => $bio->nama,
            'nik' => $bio->nik,
            'jekel' => $bio->jekel,
            'tempat_lahir' => $bio->tempat_lahir,
            'tanggal_lahir' => $bio->tgl_lahir,
            'warganegara' => $bio->warganegara,
            'agama' => $bio->agama,
            'pekerjaan' => $bio->status_warga,
            'status_nikah' => $bio->status_nikah,
            'alamat' => $bio->alamat,
            'rt' => $bio->rt,
            'rw' => $bio->rw,
            'desa' => ucwords(strtolower($bio->desa)),
            'kecamatan' => ucwords(strtolower($bio->kecamatan)),
            'nama_pejabat' => $pejabat->nm_pejabat,
            'jabatan' => $pejabat->jabatan,
            'alamat_domisili' => isset($form_tambahan_array['Alamat_Domisili']) ? $form_tambahan_array['Alamat_Domisili'] : '',
            'domisili_sejak' => isset($form_tambahan_array['Domisili_Sejak']) ? $form_tambahan_array['Domisili_Sejak'] : '',
            'tujuan_permohonan' => isset($form_tambahan_array['Tujuan_Permohonan']) ? $form_tambahan_array['Tujuan_Permohonan'] : '',
            'keterangan_tambahan' => isset($form_tambahan_array['Keterangan_Tambahan']) ? $form_tambahan_array['Keterangan_Tambahan'] : '',
            'nama_anak' => isset($form_tambahan_array['Nama_Anak']) ? $form_tambahan_array['Nama_Anak'] : '',
            'jekel_anak' => isset($form_tambahan_array['Jekel_Anak']) ? $form_tambahan_array['Jekel_Anak'] : '',
            'tempat_lahir_anak' => isset($form_tambahan_array['Tempat_Lahir_Anak']) ? $form_tambahan_array['Tempat_Lahir_Anak'] : '',
            'sekolah' => isset($form_tambahan_array['Sekolah']) ? $form_tambahan_array['Sekolah'] : '',
            'jurusan' => isset($form_tambahan_array['Jurusan']) ? $form_tambahan_array['Jurusan'] : '',
            'semester' => isset($form_tambahan_array['Semester']) ? $form_tambahan_array['Semester'] : '',
            'nama_organisasi' => isset($form_tambahan_array['Nama_Organisasi']) ? $form_tambahan_array['Nama_Organisasi'] : '',
            'alamat_organisasi' => isset($form_tambahan_array['Alamat_Organisasi']) ? $form_tambahan_array['Alamat_Organisasi'] : '',
            'nama_ketua_organisasi' => isset($form_tambahan_array['Nama_Ketua_Organisasi']) ? $form_tambahan_array['Nama_Ketua_Organisasi'] : '',
            'nik_ayah' => isset($form_tambahan_array['Nik_Ayah']) ? $form_tambahan_array['Nik_Ayah'] : '',
            'nik_ibu' => isset($form_tambahan_array['Nik_Ibu']) ? $form_tambahan_array['Nik_Ibu'] : '',
            'nama_usaha' => isset($form_tambahan_array['Nama_Usaha']) ? $form_tambahan_array['Nama_Usaha'] : '',
            'tahun_usaha' => isset($form_tambahan_array['Tahun_Usaha']) ? $form_tambahan_array['Tahun_Usaha'] : '',
            'alamat_usaha' => isset($form_tambahan_array['Alamat_Usaha']) ? $form_tambahan_array['Alamat_Usaha'] : '',
        ]),
        // Tambahkan manipulasi data lainnya sesuai kebutuhan
    ];

    // Panggil view dan kirimkan data
    return view('master_admin.review', compact('data', 'npage', 'request'));
}

private function replaceVariables($template, $data)
{
    // Lakukan penggantian variabel dalam template dengan nilai yang sesuai dari data
    foreach ($data as $key => $value) {
        // Mencocokkan variabel yang diapit oleh tanda dollar ($) dengan regular expression
        $pattern = '/(?<!\w)\$' . preg_quote($key, '/') . '(?!\w)/i';
        // Melakukan penggantian hanya pada variabel yang sesuai dengan pola yang cocok
        $template = preg_replace($pattern, $value, $template);
    }

    return $template;
}

    public function master()
    {
        $user = auth()->user()->nik;
        
        $biodatas = Biodata::where('nik', $user)->get();
        return view('master_admin.biodatamaster', compact('biodatas'));
    }
    public function ubah($nik)
    {
        $data = Biodata::where('nik', $nik)->first();
        return view('master_admin.editmaster', compact('data'));
    }

    public function update(Request $request, $nik)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'jekel' => 'required|in:Laki-Laki,Perempuan',
            'tgl_lahir' => 'required|date',
            'telepon' => 'nullable|string|max:13',
            'email' => 'nullable|string|email|max:50',
        ]);

        // Ambil data biodata berdasarkan NIK
        $biodata = Biodata::where('nik', $nik)->firstOrFail();

        // Update data biodata
        $biodata->update($validatedData);


        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('admin.biodata_master')->with('success', 'Biodata berhasil diperbarui.');
    }
}
