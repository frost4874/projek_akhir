@extends('layouts.app')
@section('title', 'Biodata Admin Master')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Biodata Master Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Biodata Master Admin</li>
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
              Biodata Master Admin
              <div class="float-right">
              @foreach($biodatas as $index => $biodata)
              <a href="{{ route('ubah.master', [$biodata->nik]) }}" class="btn btn-sm btn-warning btn-round ml-auto">
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
                                <th>EMAIL</th>
                                
                                <td>{{ $biodata->email }}</td>
                            </tr>
                            <tr>
                                <th>TEMPAT, TANGGAL LAHIR</th>
                               
                                <td>{{ $biodata->tgl_lahir }}</td>
                            </tr>
                            <tr>
                                <th>NO HP</th>
                                                               
                                <td>{{ $biodata->telepon }}</td>
                            </tr>
                            <tr>
                                <th>JENIS KELAMIN</th>
                                
                                <td>{{ $biodata->jekel }}</td>
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