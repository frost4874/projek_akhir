@extends('layouts.app')

@section('title', 'Edit Biodata')

@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Biodata</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

        <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('biodata.update', $data->nik) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIPD</label>
                                            <input type="text" class="form-control" value="{{ $data->nik }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="jekel" class="form-control">
                                                <option disabled selected>Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki" {{ $data->jekel == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="Perempuan" {{ $data->jekel == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" value="{{ $data->tempat_lahir }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir" value="{{ $data->tgl_lahir }}">
                                        </div>
                                        <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" value="{{ $data->email }}" placeholder="Email Desa..">
                                    </div>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" name="website" class="form-control" value="{{ $data->website }}" placeholder="Website Desa..">
                                    </div>
                                        
                                        <!-- Tambahkan field lain sesuai dengan struktur tabel di database -->
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" value="{{ isset($data) ? '' : $data->password }}" class="form-control" placeholder="Isi jika ganti password" >
                                        </div>
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="number" name="telepon" class="form-control" value="{{ $data->telepon }}" placeholder="Telepon Anda..">
                                    </div>
                                    
                                    <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" class="form-control" value="{{ $data->kecamatan }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Desa</label>
                                            <input type="text" class="form-control" value="{{ $data->desa }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" name="kodepos" class="form-control" value="{{ $data->kodepos }}" placeholder="Kode Pos..">
                                        </div>
                                    
                                    
                                    
                                        <div class="form-group">
                                        <label for="comment">Alamat</label>
                                        <textarea class="form-control" name="alamat" rows="3">{{ $data->alamat }}</textarea>
                                    </div>
                                    
                                        <!-- Tambahkan field lain sesuai dengan struktur tabel di database -->
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a type="button" class="btn btn-danger" onclick="history.back()">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <script>
        $(document).ready(function(){
            $.get("/kecamatan", function(data){
                $.each(data, function(index, kecamatan){
                    $('#kecamatan').append('<option value="'+kecamatan.id+'">'+kecamatan.nama+'</option>');
                });
            });
            $('#kecamatan').change(function(){
                var id_kec = $(this).val();
                $('#desa').empty();
                $('#desa').append('<option value="">Pilih Desa</option>');
                $.get("/desa/"+id_kec, function(data){
                    $.each(data, function(index, desa){
                        $('#desa').append('<option value="'+desa.id+'">'+desa.nama+'</option>');
                    });
                });
            });
        });
    </script>
        </section>
@endsection
