@extends('layouts.app')
@php
    $title = 'Template Surat';
@endphp
@section('title', 'Template Surat')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Template Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Template Surat</li>
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
            
                  <a href="{{ route('admin.tambahsurat') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i>
                      Tambah {{$title}}</a>
              </div>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-striped table-hover" id="table-list">
                      <thead>
                          <th>No.</th>
                          <th>Judul Berkas</th>
                          <th>Kode Berkas</th>
                          <th>Kode Belakang</th>
                          <th style="width: 15%">Action</th>
                      </thead>
                      <tbody>
                        @foreach($master_berkas as $index => $berkas)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $berkas->judul_berkas }}</td>
                            <td>{{ $berkas->kode_berkas }}</td>
                            <td>{{ $berkas->kode_belakang }}</td>
                            <td>

                                <div class="form-button-action">
                                    <a href="{{ route('admin.editsurat', $berkas->id_berkas) }}" class="btn btn-sm btn-primary" type="button"><i class="fas fa-edit"></i>
                                        Edit</a>
                                    <form action="{{ route('berkas.delete', $berkas->id_berkas) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <a type="submit" class="btn btn-sm btn-danger" data-original-title="Hapus Berkas">
                                                <i class="fa fa-trash">Hapus</i>
                                            </a>
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
 
@endsection