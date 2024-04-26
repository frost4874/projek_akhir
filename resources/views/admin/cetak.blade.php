@extends('layouts.app')
@php
    $title = 'Berkas Permohonan';

    if (!function_exists('tgl_indo')) {
        // Jika belum, definisikan fungsi tgl_indo()
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

    // Pastikan array $pecahkan memiliki indeks yang diharapkan sebelum mencoba mengaksesnya
    if (isset($pecahkan[2]) && isset($bulan[(int)$pecahkan[1]])) {
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    } else {
        // Handle jika indeks tidak ditemukan
        return "Format tanggal tidak valid";
    }
}

    }
@endphp
@section('title', 'Berkas Permohonan')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cetak Surat</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6"></div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th colspan="2"></th>
                                                    </tr>
                                                    <tr>
                                                        <th>&emsp;&emsp;&emsp;&emsp;<img src="img/kabmalang.png"
                                                                width="90" height="107" alt=""></th>
                                                        <th>
                                                            <center>
                                                                <font size="4">PEMERINTAHAN KABUPATEN MALANG</font><br>
                                                                <font size="4">KECAMATAN {{ strtoupper($data['nm_kec']) }} </font><br>
                                                                <font size="5"><b>DESA {{ strtoupper($data['nm_desa']) }} </b></font><br>
                                                                <font size="3"><i>{{ $data['alamat'] }}</i></font><br><br>
                                                            </center>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">
                                                            <hr style="margin:0px" color="black">
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">
                                                            <center> <br><br>
                                                                <h3><b>SURAT KETERANGAN / PENGANTAR</b></h3>

                                                                <span>Nomor : {{ $data['id_berkas'] }} / {{ $data['no_urut'] }} /
                                                                    {{ $data['kode_belakang'] }} </span>
                                                            </center>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">
                                                            <!-- Tambahkan konten surat di sini sesuai kebutuhan -->
                                                        </th>
                                                    </tr>
                                                    <tr font="Times New Roman">
                                                        <th></th>
                                                        <th>Malang, {{ tgl_indo($data['tgl_acc']) }}
                                                        @if($data['jabatan'] == 'Kepala')
                                                            {{ $data['jabatan'].' Desa' }}
                                                        @else
                                                            {!! 'an. Kepala Desa<br>'.$data['jabatan'] !!}
                                                        @endif
                                                        <br><br><br><br>{{ $data['nm_pejabat'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
