@extends('layouts.app')
@section('title', 'Laporan')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Laporan
                            <div class="float-right">
                                <a href="/laporan/cetakpdf" class="btn btn-sm btn-danger" target="_blank">
                                    <i class="fas fa-save"></i> SIMPAN PDF
                                </a>
                                <a href="/laporan/print" class="btn btn-sm btn-warning" target="_BLANK">
                                    <i class="fas fa-print"></i> CETAK
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('laporan.filter') }}" method="GET" class="d-inline-block">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label class="sr-only" for="tanggalDari">Dari</label>
                                        <input type="date" class="form-control form-control-sm mb-2" id="tanggalDari" name="tanggal_dari" placeholder="Dari">
                                    </div>
                                    <div class="col-auto">
                                        <label class="sr-only" for="tanggalSampai">Sampai</label>
                                        <input type="date" class="form-control form-control-sm mb-2" id="tanggalSampai" name="tanggal_sampai" placeholder="Sampai">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary mb-2">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-list">
                                    <thead>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal ACC</th>
                                        <th scope="col">Nik</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Permohonan</th>
                                        <th style="width: 10%">Action</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            // Hitung nomor urutan untuk halaman saat ini
                                            $startNumber = ($requests->currentPage() - 1) * $requests->perPage() + 1;
                                        @endphp
                                        @foreach($requests as $index => $request)
                                        <tr>
                                            <td>{{ $startNumber + $index }}</td>
                                            <td>{{ $request->acc }}</td>
                                            <td>{{ $request->nik}}</td>
                                            <td>{{ $request->nama}}</td>
                                            <td>{{ $request->judul_berkas }}</td>
                                            <td>
                                                @if($request->status == 1)
                                                <a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal{{ $request->id_request }}" title="Edit Pejabat">
                                                    <i class="fas fa-print"></i> Print
                                                </a>
                                                @else
                                                <a href="#" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                                @endif
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
        <!-- Tampilkan tautan ke halaman berikutnya jika ada -->
        @if ($requests->hasPages())
            <div class="pagination justify-content-center">
                {{-- Previous Page Link --}}
                @if ($requests->onFirstPage())
                    <span class="page-link disabled">&laquo;</span>
                @else
                    <a class="page-link" href="{{ $requests->previousPageUrl() }}" rel="prev">&laquo;</a>
                @endif

                {{-- Next Page Link --}}
                @if ($requests->hasMorePages())
                    <a class="page-link" href="{{ $requests->nextPageUrl() }}" rel="next">&raquo;</a>
                @else
                    <span class="page-link disabled">&raquo;</span>
                @endif
            </div>
        @endif
    </section>
@endsection
