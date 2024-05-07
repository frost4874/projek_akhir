@extends('layouts.app')
@php
    $title = 'Berkas Permohonan';
@endphp
@section('title', 'Berkas Permohonan')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Berkas Permohonan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Berkas Permohonan</li>
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
          <!-- <div class="card-header">

              <div class="float-right">
                  
              </div>
          </div> -->
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-striped table-hover" id="table-list">
                      <thead>
                        <th>No.</th>
                        <th>Tanggal Acc</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Status</th>
                        <th style="width: 20%">Action</th>
                      </thead>
                      <tbody>
                                    @foreach($requests as $index => $request)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $request->acc }}</td>
                                                <td>{{ $request->nik }}</td>
                                                <td>{{ $request->nama }}</td>
                                                <td>
                                                        Telah di Cetak
                                                </td>
                                                <td>
                                                <div class="d-inline-block">
                                                <a href="#" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal{{ $request->id_request }}" title="Cetak Surat">
                                                            <i class="fas fa-print">Print</i>
                                                        </a>
                                                </div>
                                                <div class="d-inline-block ml-2">
                                                    <form action="{{ route('telah.diambil', ['id_request' => $request->id_request]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="fas fa-check"></i> Selesai
                                                        </button>
                                                    </form>
                                                </div>
    
                                                        
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
  @foreach($requests as $request)
<div class="modal fade" id="myModal{{ $request->id_request }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('print.cetakq', ['id_request' => $request->id_request]) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Pejabat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pejabat">Pejabat</label>
                        <select name="nip" id="nip" class="form-control">
                            <option value="">-PILIH PEJABAT-</option>
                            @foreach($pejabats as $pejabat)
                            <option value="{{ $pejabat->nip }}">{{ $pejabat->nm_pejabat }}</option>
                            @endforeach
                        </select>
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