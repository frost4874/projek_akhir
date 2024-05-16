@extends('layouts.app')
@section('title', 'Biodata Admin Desa')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Biodata Admin Desa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Biodata Admin Desa</li>
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
              <div class="float-right">
              @foreach($biodatas as $index => $biodata)
              <a href="{{ route('ubah.desa', [$biodata->nik]) }}" class="btn btn-sm btn-warning btn-round ml-auto">
                  <i class="fa fa-edit"></i>
                  Ubah Biodata
              </a>

              </div>
          </div>
          <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered">
                        <thead>
                        
                            <tr>
                                <th>NAMA</th>
                                
                                <td>{{ $biodata->nama }}</td>
                            </tr>
                            <tr>
                                <th>TEMPAT, TANGGAL LAHIR</th>
                               
                                <td>{{ $biodata->tempat_lahir }}, {{ date('d F Y', strtotime($biodata->tgl_lahir)) }}</td>

                            </tr>
                            <tr>
                                <th>EMAIL</th>
                                
                                <td>{{ $biodata->email }}</td>
                            </tr>
                            <tr>
                                <th>NO HP</th>
                                                               
                                <td>{{ $biodata->telepon }}</td>
                            </tr>
                            <tr>
                                <th>JENIS KELAMIN</th>
                                
                                <td>{{ $biodata->jekel }}</td>
                            </tr>
                            
                            <tr>
                                <th>KECAMATAN</th>
                                
                                <td>{{ $biodata->kecamatan }}</td>
                            </tr>
                            <tr>
                                <th>DESA</th>
                                
                                <td>{{ $biodata->desa }}</td>
                            </tr>
                            <tr>
                                <th>KODE POS</th>
                                
                                <td>{{ $biodata->kodepos }}</td>
                            </tr>
                            <tr>
                                <th>ALAMAT</th>
                                <td>{{ $biodata->alamat }}</td>
                            </tr>
                            <tr>
                                <th>WEBSITE</th>
                                <td>{{ $biodata->website }}</td>
                            </tr>
                            @endforeach
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