@extends('layouts.app')
@php
    $title = 'Admin Desa';
@endphp
@section('title', 'Data Admin Desa')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Admin Desa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Data Admin Desa</li>
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
              Daftar {{$title}}

              <div class="float-right">
                  <button class="btn btn-sm btn-success" id="btn-add-new"  type="button" data-toggle="modal" data-target="#modalTambahAdminDesa">
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
                          <th>NIPD</th>
                          <th>Nama</th>
                          <th>Jenis Kelamin</th>
                          <th>Kecamatan</th>
                          <th>Desa</th>
                          <th>Opsi</th>
                      </thead>
                      <tbody>
@foreach($biodatas as $index => $biodata)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>{{ $biodata->nik }}</td>
    <td>{{ $biodata->nama }}</td>
    <td>{{ $biodata->jekel }}</td>
    <td>{{ $biodata->kecamatan }}</td>
    <td>{{ $biodata->desa }}</td>
    <td>
        <!-- Tombol edit -->
        <button class="btn btn-sm btn-primary" type="button"  data-toggle="modal" data-target="#ubahBiodataModal{{ $biodata->nik }}">
            <i class="fas fa-edit"></i>
            Edit
        </button>
        <!-- Tombol hapus -->
        <form action="{{ route('master.delete.desa', $biodata->nik) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Admin Desa" onclick="return confirm('Apakah Kamu Yakin?');">
        <span class="fa fa-trash"></span> Hapus
    </button>
</form>

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
<!-- Modal -->
<div class="modal fade" id="modalTambahAdminDesa" tabindex="-1" role="dialog" aria-labelledby="modalTambahAdminDesaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahAdminDesaLabel">Tambah Admin Desa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulir pendaftaran admin desa -->
                <form id="registrationForm" action="{{ route('register.desa') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIPD</label>
                                <input type="text" class="form-control" id="nik" name="nik" required autofocus maxlength="16">
                                <small id="nikWarning" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Desa</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="jekel">Jenis Kelamin</label>
                                <select class="form-control" id="jekel" name="jekel" required>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                            </div>
                            <div class="form-group">
								<label for="telepon">No Hp</label>
								<input type="number" class="form-control" id="telepon" name="telepon" required>
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota" value="Jember" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="desa">Desa</label>
                                <select class="form-control" id="desa" name="desa" required>
                                    <option value="">Pilih Desa</option>
                                </select>
                            </div>
                            <div class="form-group">
								<label for="kodepos">Kode Pos</label>
								<input type="number" class="form-control" id="kodepos" name="kodepos" required>
        					</div>
							<div class="alamat">
								<label for="tgl_lahir">Alamat</label>
								<textarea class="form-control" cols="30" id="alamat" name="alamat" required></textarea>
							</div>                          
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required pattern="(?=.*\d)(?=.*[A-Z]).{8,}" title="Password harus mengandung setidaknya satu angka, satu huruf besar, dan setidaknya 8 karakter">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary float-right">Simpan</button>
</div>

                </form>
            </div>
            
        </div>
    </div>
</div>
@foreach($biodatas as $biodata)
<div class="modal fade" id="ubahBiodataModal{{ $biodata->nik }}" tabindex="-1" role="dialog" aria-labelledby="ubahBiodataModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ubahBiodataModalLabel">Ubah Biodata</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulir untuk mengubah biodata -->
        <form method="POST" action="{{ route('master.update.desa', ['nik' => $biodata->nik]) }}">
          @csrf
          @method('PUT')
          
          <div class="row">
            <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <label>NIPD</label>
                <input type="number" name="nik" value="{{ $biodata->nik }}" class="form-control" placeholder="NIK Anda.." autofocus readonly>
            </div>

          <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $biodata->nama }}">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $biodata->email }}">
        </div>
          <div class="form-group">
            <label for="jekel">Jenis Kelamin</label>
            <select class="form-control" id="jekel" name="jekel">
              <option value="Laki-Laki" {{ $biodata->jekel == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
              <option value="Perempuan" {{ $biodata->jekel == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
          <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $biodata->tgl_lahir }}">
                            </div>
          <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $biodata->telepon }}">
        </div>
          
          </div>
          <div class="col-md-6 col-lg-6">
          
        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" name="kecamatan" value="{{ $biodata->kecamatan ?? '' }}" class="form-control" placeholder="Kecamatan Anda.." readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Desa</label>
                                            <input type="text" name="desa" value="{{ $biodata->desa ?? '' }}" class="form-control" placeholder="Desa Anda.."readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" name="kodepos" value="{{ $biodata->kodepos ?? '' }}" class="form-control" placeholder="Kode Pos Anda.." >
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" value="{{ isset($biodata) ? '' : $biodata->password }}" class="form-control" placeholder="Isi jika ganti password" >
                                        </div>
                                        <div class="form-group">
                                        <div class="form-group">
                                            <label>Website</label>
                                            <input type="text" name="website" value="{{ $biodata->website ?? '' }}" class="form-control" placeholder="Website Desa.." >
                                        </div>
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $biodata->alamat }}</textarea>
        </div>

        
        
        
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </div>
        </div>
    </form>
    </div>
</div>
</div>
</div>
@endforeach
    
@endsection