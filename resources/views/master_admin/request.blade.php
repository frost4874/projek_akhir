@extends('layouts.app')
@php
    $title = 'Permohonan Surat';
@endphp
@section('title', 'Permohonan Surat')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DAFTAR REQUEST {{ strtoupper($judul_berkas) }}</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-list">
                                    <thead>
                                        <th>No.</th>
                                        <th>Tanggal Request</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Status</th>
                                        <th style="width: 15%">Action</th>
                                    </thead>
                                    <tbody>
                                    @php
                                    // Hitung nomor urutan untuk halaman saat ini
                                    $startNumber = ($requests->currentPage() - 1) * $requests->perPage() + 1;
                                    @endphp
                                        @foreach($requests as $index => $request)
                                        <tr>
                                            <td>{{ $startNumber + $index }}</td>
                                            <td>{{ $request->tanggal_request }}</td>
                                            <td>{{ $request->nik }}</td>
                                            <td>{{ $request->nama }}</td>
                                            <td>
                                                @if($request->status == 0)
                                                Pending
                                                @elseif($request->status == 1)
                                                Telah di ACC
                                                @elseif($request->status == 2)
                                                Sudah di print
                                                @elseif($request->status == 3)
                                                Selesai
                                                @else
                                                Status tidak valid
                                                @endif
                                            </td>
                                            <td>
                                            <a href="{{ route('master.review', ['id_request' => $request->id_request]) }}" type="button" class="btn btn-sm btn-success">
                                                <i class="fas fa-pencil-alt"> Review</i>
                                            </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <!-- Tampilkan tombol navigasi paginate -->
   @if ($requests->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            {{-- Tombol Previous --}}
            @if ($requests->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $requests->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif

            {{-- Tautan Nomor Halaman --}}
            @foreach ($requests->links()->elements[0] as $page => $url)
                <li class="page-item {{ $requests->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Tombol Next --}}
            @if ($requests->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $requests->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif


@endsection
