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
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
    <li class="">
        <a href="{{ route('cetak.print', ['id_request' => $request->id_request]) }}" class="btn btn-info"><i class="fas fa-print"></i> Cetak Surat</a>
    </li>
</ol>
<input type="hidden" name="no_urut" value="{{ session('no_urut') }}">
            </div>
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
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2"></th>
                                        <br>
                                    </tr>
                                    <tr>
                                        <th style="padding-right: 10px; vertical-align: top; height: 120px;">
                                            &emsp;&emsp;&emsp;&emsp;<img src="/asset/images/jember.png" width="90" height="100" alt="">
                                        </th>
                                        <th style="padding-left: 10px; font-family: 'Times New Roman', Times, serif; vertical-align: top; height: 120px; line-height: 1.15;padding-right: 80px;">
                                            <center>
                                                <font size="4" style="font-weight: bold;">PEMERINTAHAN KABUPATEN JEMBER</font><br>
                                                <font size="4" style="font-weight: bold;">KECAMATAN {{ strtoupper($data['nm_kec']) }} </font><br>
                                                <font size="5" style="font-weight: bold;"><b>DESA {{ strtoupper($data['nm_desa']) }} </b></font><br>
                                                <font size="3" style="font-weight: bold;"><i>{{ $data['alamatdesa'] }}</i></font><br>
                                            </center>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="padding: 0 10px; width: 100%;">
                                            <hr color="black" style="border: 0; height: 2px; background-color: black; margin: 0;">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="text-align: center; font-family: 'Times New Roman', Times, serif; ">
                                            <br>
                                            <h4 style="text-decoration: underline; line-height: 1.15;"><b>{{ strtoupper($data['judul_berkas']) }}</b></h4>
                                            <span style=" line-height: 1.15;">Nomor : {{ $data['id_berkas'] }} / {{ $data['no_urut'] }} / {{ $data['kode_belakang'] }}</span>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="2" style="font-family: 'Times New Roman', Times, serif; padding: 20px; font-weight: normal; text-align: justify; ">
                                        {!! $data['template'] !!}
                                    
                                        
                                        </th>
                                    </tr>
                                    <tr >
                                        <th></th>
                                        <th style="font-family: 'Times New Roman', Times, serif; float:right; padding-right: 40px;">
                                        <div style="margin-left: auto;">
                                            Jember, {{ tgl_indo($data['tgl_acc']) }}
                                            @if($data['jabatan'] == 'Kepala')
                                                {{ $data['jabatan'].' Desa' }}
                                            @else
                                                {!! '<br>'.$data['jabatan'] !!}
                                            @endif
                                            <br><br><br>{{ $data['nm_pejabat'] }}
                                        </div>
                                        </th>
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
</section>

@endsection
