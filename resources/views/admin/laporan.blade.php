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
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
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
              <a href="/laporan/cetakpdf" class="btn btn-sm btn-danger" target="_blank"><i class="fas fa-save"></i>SIMPAN PDF</a>
				      <a href="/laporan/print" class="btn btn-sm btn-warning" target="_BLANK"><i class="fas fa-print"></i>CETAK</a>
                <!-- <button class="btn btn-sm btn-danger" id="btn-save-pdf">
                      <i class="fas fa-save"></i>
                      Simpan ke PDF
                  </button>
                  <button class="btn btn-sm btn-warning" id="btn-print">
                      <i class="fas fa-print"></i>
                      Cetak
                  </button> -->
              </div>
          </div>
          <div class="card-body">
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
                      @foreach($requests as $index => $request)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $request->tanggal_request }}</td>
                                            <td>{{ $request->nik}}</td>
                                            <td>{{ $request->nama}}</td>
                                            <td>{{ $request->judul_berkas }}</td>
                                            <td>
                                                @if($request->status == 1)
                                                <a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal{{ $request->id_request }}" title="Edit Pejabat">
                                                    <i class="fas fa-print"> Print</i>
                                                </a>
                                                @else
                                                <a href="#" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-pencil-alt">Edit</i>
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
  </section>
    
@endsection