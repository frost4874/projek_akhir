@extends('layouts.app')
@php
    $title = 'Edit Template Surat';
@endphp
@section('title', 'Edit Template Surat')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Template Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
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
              <h5>FORM EDIT TEMPLATE SURAT</h5>
            </div>
            <div class="card-body">
            
            <form method="POST" action="{{ route('templatesurat.update', ['id_berkas' => $berkas->id_berkas]) }}">
                
                @csrf
                @method('PUT')
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
                        <script>
                            CKEDITOR.replace('template{{ $berkas->id_berkas }}');
                        </script>
                        <label>*Jika menambahkan data supaya menggunakan $</label>
                    </div>
                    <div class="form-group">
                        <label>Form Tambahan</label>
                        <input type="text" name="form_tambahan" class="form-control" placeholder="Form Tambahan.." value="{{ $berkas->form_tambahan }}"></input>
                        <label>*Jika menambahkan Form tambahan supaya menggunakan Spasi</label>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" onclick="history.back()">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                </div>

              
            </form>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    
@endsection
