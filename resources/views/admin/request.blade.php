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
                        <div class="card-header">
                            <div class="float-right">
                                <!-- Ubah tombol "Tambah Request" -->
                                <button class="btn btn-sm btn-success" id="btn-add-new" type="button"
                                    data-toggle="modal" data-target="#modalTambahRequest">
                                    <i class="fas fa-plus"></i>
                                    Tambah Request
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-list">
                                    <thead>
                                        <th>No.</th>
                                        <th>Tanggal Request</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
                                        <th style="width: 15%">Action</th>
                                    </thead>
                                    <tbody>
                                    @php
                                        // Hitung nomor urutan untuk halaman saat ini
                                        $startNumber = ($requests->currentPage() - 1) * $requests->perPage() + 1;
                                    @endphp
                                    @foreach($requests as $index => $request)
                                        @if($request->status != 4)
                                            <tr>
                                                <td>{{ $startNumber + $index }}</td>
                                                <td>{{ $request->tanggal_request }}</td>
                                                <td>{{ $request->nik }}</td>
                                                <td>{{ $request->nama }}</td>
                                                <td>{{ $request->keperluan }}</td>
                                                <td>
                                                    @if($request->status == 0)
                                                        Pending
                                                    @elseif($request->status == 1)
                                                        Telah di ACC
                                                    @else
                                                        Status tidak valid
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($request->status == 0)
                                                        <a href="{{ route('detail.request', ['id_berkas' => $id_berkas, 'judul_berkas' => $judul_berkas, 'nik' => $request->nik, 'id_request' => $request->id_request]) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-pencil-alt">Edit</i>
                                                        </a>
                                                    @elseif($request->status == 1)
                                                        <a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal{{ $request->id_request }}" title="Cetak Surat">
                                                            <i class="fas fa-print">Print</i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
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

    <!-- Modal "Tambah Data Masyarakat" -->
    <div class="modal fade" id="modalTambahRequest" tabindex="-1" role="dialog" aria-labelledby="modalTambahRequestLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahRequestLabel">Tambah Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahRequest" action="{{ route('tambah.request') }}" method="POST">
                    @csrf
                    <div class="form-group">
    <label for="nik">NIK</label>
    <select class="form-control" id="nik" name="nik" required>
        <option value="">Pilih NIK</option>
        @foreach($biodatas as $biodata)
            <option value="{{ $biodata->nik }}">{{ $biodata->nik }}</option>
        @endforeach
    </select>
</div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    </div>
                    <input type="hidden" name="id_berkas" value="{{ $id_berkas }}">
                    @foreach($form_tambahan as $field)
                                    <div class="form-group">
                                        <label>{{ str_replace("_", " ", $field) }}</label>
                                        <input type="text" name="{{ $field}}" class="form-control" placeholder="{{ str_replace("_", " ", $field) }}" autofocus>
                                    </div>
                                @endforeach
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah Request</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
@foreach($requests as $request)
<div class="modal fade" id="myModal{{ $request->id_request }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('print.cetak', ['id_request' => $request->id_request]) }}" method="POST">
                @csrf
                <div class="modal-header">
                <input type="hidden" name="id_berkas" value="{{ $id_berkas }}">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Pejabat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no_urut">No Urut</label>
                        <input type="text" value="{{ $no_agenda }}" name="no_urut" id="no_urut" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="pejabat">Pejabat</label>
                        <select name="nip" id="nip" class="form-control">
                            <option value="">-PILIH PEJABAT-</option>
                            @foreach($pejabats as $pejabat)
                            <option value="{{ $pejabat->nip }}">{{ $pejabat->nm_pejabat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="tgl_acc">Tanggal Cetak</label>
                    <input type="date" name="acc" id="acc" class="form-control" value="{{ now()->format('Y-m-d') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cetak Surat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


@endsection
