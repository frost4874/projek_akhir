@extends('layouts.app')

@section('title', 'Dashboard')
@php
$card_array = [
     'bg-green', 'bg-red', 'bg-navy'
];
$total_colors = count($card_array);
@endphp

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard Admin Desa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        @foreach($master_berkas as $berkas)
        <div class="col-md-12 col-lg-6 col-xl-4">
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
                        <p class="info-box-text" style="color: black;">{{ $berkas->judul_berkas }}</p>
                        
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
