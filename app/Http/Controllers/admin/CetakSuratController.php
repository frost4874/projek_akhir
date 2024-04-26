<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CetakSuratController extends Controller
{
    public function cetakSurat(Request $request)
    {
        $id_request = $request->input('id_request');
        $id_berkas = $request->input('id_berkas');
        $nik = $request->input('nik');
        $nip = $request->input('pejabat');
        $tgl_acc = $request->input('tgl_acc');

        $status = $request->input('status');
        if ($status == 0) {
            $no_urut = $request->input('no_urut');
            DB::table('data_request')
                ->where('id_request', $id_request)
                ->update(['acc' => $tgl_acc, 'no_urut' => $no_urut, 'status' => 1]);
        } else {
            $data_agenda = DB::table('data_request')
                ->select('no_urut')
                ->where('id_request', $id_request)
                ->first();
            $no_urut = $data_agenda->no_urut;
            DB::table('data_request')
                ->where('id_request', $id_request)
                ->update(['acc' => $tgl_acc]);
        }

        // Definisikan fungsi tgl_indo() di sini
        function tgl_indo($tanggal){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);
        
            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $data = DB::table('data_request')
            ->join('data_user', 'data_request.nik', '=', 'data_user.nik')
            ->join('master_berkas', 'data_request.id_berkas', '=', 'master_berkas.id_berkas')
            ->where('data_request.nik', $nik)
            ->where('data_request.id_berkas', $id_berkas)
            ->first();

        // Proses pengambilan data dari $data dan konversi format tanggal
        $id_request = $data->id_request;
        $nik = $data->nik;
        $nama = $data->nama;
        $tempat = $data->tempat_lahir;
        $tgl = tgl_indo($data->tanggal_lahir);
        $tgl2 = tgl_indo($data->tanggal_request);
        $format1 = date('Y', strtotime($tgl2));
        $format2 = date('d-m-Y', strtotime($tgl));
        $format3 = date('d F Y', strtotime($tgl2));
        $agama = $data->agama;
        $jekel = $data->jekel;
        $warganegara = $data->warganegara;
        $rt = $data->rt;
        $rw = $data->rw;
        $alamat = $data->alamat;
        $status_warga = $data->status_warga;
        $status_nikah = $data->status_nikah;
        $keperluan = $data->keperluan;
        $keterangan = $data->keterangan;
        $status = $data->status;
        $acc = $data->acc;
        $id_berkas = $data->id_berkas;
        $judul_berkas = $data->judul_berkas;
        $kode_berkas = $data->kode_berkas;
        $kode_belakang = $data->kode_belakang;
        $template = $data->template;
        $jekel_anak = $data->jekel_anak;
        $nama_anak = $data->nama_anak;
        $tempat_lahir_anak = $data->tempat_lahir_anak;
        $tanggal_lahir_anak = $data->tanggal_lahir_anak;
        $sekolah = $data->sekolah;
        $jurusan = $data->jurusan;
        $semester = $data->semester;
        $nm_organisasi = $data->nm_organisasi;
        $alamat_Organisasi = $data->alamat_organisasi;
        $nm_ketua = $data->nm_ketua;
        $status_nikah = $data->status_nikah;
        $nik_ayah = $data->nik_ayah;
        $nik_ibu = $data->nik_ibu;
        $nama_usaha = $data->nama_usaha;
        $tahun_usaha = $data->tahun_usaha;
        $alamat_usaha = $data->alamat_usaha;
        $idpekerjaan = $data->idpekerjaan;
        $tujuan = $data->tujuan;

        // Format tanggal
        $format4 = date('d F Y', strtotime($acc));

        // Proses pengambilan data desa, kecamatan, dan pejabat dari database
        $data2 = DB::table('mst_kec')
            ->join('mst_desa', 'mst_kec.id_kec', '=', 'mst_desa.id_kec')
            ->where('mst_desa.id_desa', $data->id_desa)
            ->where('mst_desa.id_kec', $data->id_kec)
            ->first();
        $ds = $data2->nm_desa;
        $desa = ucwords("$ds");
        $kecamatan = ucwords($data2->nm_kec);

        $data3 = DB::table('data_pejabat')
            ->where('nip', $nip)
            ->first();
        $nm_pejabat = $data3->nm_pejabat;
        $jabatan = $data3->jabatan;

        // Proses pengolahan data tambahan (jika ada)
        if ($form_tambahan != 0) {
            $array_delimiter2 = [];
            $array_value2 = [];
            $pecahform = explode(',', $form_tambahan);
            foreach ($pecahform as $form) {
                $pecahvariabel = explode(':', $form);
                $array_delimiter2[] = '"$' . $pecahvariabel[0] . '"';
                $array_value2[] = $pecahvariabel[1];
            }
        }

        return view('cetak_surat', compact('data', 'data2', 'nm_pejabat', 'tgl_acc', 'array_delimiter', 'array_value', 'array_delimiter2', 'array_value2'));
    }
}
