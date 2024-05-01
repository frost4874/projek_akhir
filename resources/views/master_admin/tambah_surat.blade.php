@extends('layouts.app')
@php
    $title = 'Tambah Template Surat';
@endphp
@section('title', 'Tambah Template Surat')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Template Surat</h1>
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
              <h5>FORM TAMBAH TEMPLATE SURAT</h5>
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('berkas.store') }}">
                @csrf
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
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="history.back()">Batal</button>
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
