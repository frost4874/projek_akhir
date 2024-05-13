@extends('layouts.app')

@section('title', 'Dashboard')
@php
$card_array = [
    'bg-info', 'bg-green', 'bg-red', 'bg-navy'
];
$total_colors = count($card_array);
@endphp

@section('content')
<div class="content-header bg-gray-dark">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12"><br>
                <h1 class="m-0 text-white">Halo Admin Desa {{ucwords($id_desa)}}!</h1>
                <p class="text-white">Selamat datang di Pelayanan Surat Keterangan Desa. Semoga harimu menyenangkan!</p>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><br>

<section class="content">
<style>
    .info-box {
        width: 260px; /* Atur lebar kotak */
        height: 145px; /* Atur tinggi kotak */
    }
</style>
    <div class="row">
        <br>
        @foreach($master_berkas as $berkas)
        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{ route('admin.request', ['id_berkas' => $berkas->id_berkas, 'judul_berkas' => $berkas->judul_berkas]) }}">
                <div class="info-box">
                    <div class="position-absolute top-0 end-0 p-2">
                        @php
                        $jumlah_req = App\Models\DataRequest::where('id_berkas', $berkas->id_berkas)
                            ->whereIn('status', [0])
                            ->whereHas('biodata', function ($query) {
                                $query->where('id_kec', auth()->user()->kecamatan)
                                      ->where('id_desa', auth()->user()->desa);
                            })
                            ->count();
                        @endphp
                        @if($jumlah_req > 0)
                        <span class="badge badge-primary">{{ $jumlah_req }}</span>
                        @endif
                    </div>
                    @if($total_colors > 0)
                    <span class="info-box-icon {{ $card_array[$loop->index % $total_colors] }}">
                        <i class="far fa-envelope"></i>
                    </span>
                    @else
                    <!-- Default class or style jika tidak ada warna -->
                    <span class="info-box-icon"><i class="far fa-envelope"></i></span>
                    @endif
                    <div class="info-box-content">
                        <!-- Modifikasi judul berkas -->
                        <p class="info-box-text" style="color: black;">
                            @php
                            // Memecah judul berkas jika terlalu panjang
                            $judul_berkas = wordwrap($berkas->judul_berkas, 20, "<br>");
                            echo $judul_berkas;
                            @endphp
                        </p>
                        
                        @php
                        $jumlah_reqs = App\Models\DataRequest::where('id_berkas', $berkas->id_berkas)
                            ->whereIn('status', [0,1])
                            ->whereHas('biodata', function ($query) {
                                $query->where('id_kec', auth()->user()->kecamatan)
                                      ->where('id_desa', auth()->user()->desa);
                            })
                            ->count();
                        @endphp
                        <span class="info-box-number" style="color: black;">{{ $jumlah_reqs }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
            <!-- /.info-box -->
        </div>
        @endforeach

        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection
