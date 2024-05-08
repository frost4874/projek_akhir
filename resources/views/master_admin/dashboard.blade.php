@extends('layouts.app')
@section('title', 'Dashboard')
@php
$card_array = [
  'bg-green', 'bg-red', 'bg-navy'
];
$total_colors = count($card_array);
@endphp
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard Master Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
    <div class="row">
    @foreach($master_berkas as $berkas)
<div class="col-md-12 col-lg-6 col-xl-4">
    <a href="{{ route('master.request', ['id_berkas' => $berkas->id_berkas, 'judul_berkas' => $berkas->judul_berkas]) }}">
        <div class="info-box">
            @if($total_colors > 0)
            <span class="info-box-icon {{ $card_array[$loop->index % $total_colors] }}"><i class="far fa-envelope"></i></span>
            @else
            <!-- Default class or style jika tidak ada warna -->
            <span class="info-box-icon"><i class="far fa-envelope"></i></span>
            @endif
            <div class="info-box-content">
                <span class="info-box-text" style="color: black;">{{ $berkas->judul_berkas }}</span>
                @php
                $jumlah_req = App\Models\DataRequest::where('id_berkas', $berkas->id_berkas)
                    ->where(function ($query) {
                        $query->whereIn('status', [4]);
                    })
                    ->count();
                @endphp

                <span class="info-box-number" style="color: black;">{{ $jumlah_req }}</span>
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