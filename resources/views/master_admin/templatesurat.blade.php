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
                  <button class="btn btn-sm btn-success" id="btn-add-new " type="button" data-toggle="modal" data-target="#modalTambahTemplate">
                      <i class="fas fa-plus"></i>
                      Tambah {{$title}}
                  </button>
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
                                    
                                    <button class="btn btn-sm btn-primary" type="button"  data-toggle="modal" data-target="#ubahTemplateModal{{ $berkas->id_berkas }}">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </button>
                                    <form action="{{ route('berkas.delete', $berkas->id_berkas) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-original-title="Hapus Berkas">
                                                <i class="fa fa-trash">Hapus</i>
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
  <!-- modal  -->
  <div class="modal fade" id="modalTambahTemplate" tabindex="-1" role="dialog" aria-labelledby="modalTambahTemplateLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahTemplateLabel">FORM TAMBAH TEMPLATE SURAT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('berkas.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul_berkas" class="form-control" placeholder="Jenis Surat..">
                    </div>
                    <div class="form-group">
                        <label>Kode Berkas</label>
                        <input type="text" name="kode_berkas" class="form-control" placeholder="Kode Berkas.." autofocus>
                    </div>
                    <div class="form-group">
                        <label>Kode Belakang</label>
                        <input type="text" name="kode_belakang" class="form-control" placeholder="Kode Belakang..">
                    </div>
                    <div class="form-group">
                        <label>Template Surat</label>
                        <div class="form-group">
                            <textarea name="template" id="templateQ" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <script src="/asset/ckeditor/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace('templateQ');
                        </script>
                        <label>*Jika menambahkan data supaya menggunakan $</label>
                    </div>
                    <div class="form-group">
                        <label>Form Tambahan</label>
                        <input type="text" name="form_tambahan" class="form-control" placeholder="Form Tambahan.."></input>
                        <label>*Jika menambahkan Form tambahan supaya menggunakan Spasi</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@foreach($master_berkas as $berkas)
<div class="modal fade" id="ubahTemplateModal{{ $berkas->id_berkas }}" tabindex="-1" role="dialog" aria-labelledby="ubahTemplateModalLabel{{ $berkas->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahTemplateModalLabel{{ $berkas->id_berkas }}">FORM EDIT TEMPLATE SURAT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('templatesurat.update', ['id_berkas' => $berkas->id_berkas]) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul_berkas" class="form-control" placeholder="Jenis Surat.." value="{{ $berkas->judul_berkas }}">
                    </div>
                    <div class="form-group">
                        <label>Kode Berkas</label>
                        <input type="text" name="kode_berkas" class="form-control" placeholder="Kode Berkas.." value="{{ $berkas->kode_berkas }}">
                    </div>
                    <div class="form-group">
                        <label>Kode Belakang</label>
                        <input type="text" name="kode_belakang" class="form-control" placeholder="Kode Belakang.." value="{{ $berkas->kode_belakang }}">
                    </div>
                    <div class="form-group">
                        <label>Template Surat</label>
                        <div class="form-group">
                            <textarea name="template" id="template{{ $berkas->id_berkas }}" class="form-control" cols="30" rows="10">{{ $berkas->template }}</textarea>
                        </div>
                        <label>*Jika menambahkan data supaya menggunakan $</label>
                    </div>
                    <div class="form-group">
                        <label>Form Tambahan</label>
                        <input type="text" name="form_tambahan" class="form-control" placeholder="Form Tambahan.." value="{{ $berkas->form_tambahan }}"></input>
                        <label>*Jika menambahkan Form tambahan supaya menggunakan Spasi</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@foreach($master_berkas as $berkas)
    <script>
        CKEDITOR.replace('template{{ $berkas->id_berkas }}');
    </script>
@endforeach
    
@endsection