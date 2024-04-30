@extends('layouts.app')
@php
    $title = 'Masyarakat';

@endphp
@section('title', 'Data Masyarakat')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Masyarakat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Data Masyarakat</li>
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
                  <button class="btn btn-sm btn-success" id="btn-add-new"  type="button" data-toggle="modal" data-target="#modalTambahMasyarakat">
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
                          <th>NIK</th>
                          <th>Nama</th>
                          <th>Jenis Kelamin</th>
                          <th>Kecamatan</th>
                          <th>Desa</th>
                          <th>Action</th>
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
        <!-- Tambahkan tombol untuk opsi, misalnya: edit, hapus, dll -->
        <!-- Tombol Edit -->
      <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#ubahBiodataModal{{ $biodata->nik }}">
          <i class="fas fa-edit"></i> Edit
      </button>

      <!-- Tombol Hapus -->
      <form action="{{ route('masyarakat.delete', $biodata->nik) }}" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Pejabat">
              <i class="fa fa-trash"></i> Hapus
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
<div class="modal fade" id="modalTambahMasyarakat" tabindex="-1" role="dialog" aria-labelledby="modalTambahMasyarakatLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahMasyarakatLabel">Tambah Data Masyarakat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulir pendaftaran admin desa -->
                <form id="registrationForm" action="{{ route('register.masyarakat') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" required autofocus maxlength="16">
                                <small id="nikWarning" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota" value="Jember" readonly>
                            </div>
                            @php
                            $user = Auth::user();
                            $kecamatan = $user->kecamatan; // Assuming the kecamatan field is stored in the user model
                            $desa = $user->desa;
                            @endphp
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ $kecamatan }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="desa">Desa</label>
                                <input type="text" class="form-control" id="desa" name="desa" value="{{ $desa }}" readonly>
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
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary float-right">Simpan</button>
</div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- Modal -->
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
        <form id="ubahBiodataForm" method="POST" action="{{ route('masyarakat.update', ['nik' => $biodata->nik]) }}">
          @csrf
          @method('PUT')
          
          <div class="row">
            <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <label>NIK</label>
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
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $biodata->tempat_lahir }}">
          </div>
          <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $biodata->tgl_lahir }}">
          </div>
          <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $biodata->telepon }}">
        </div>
          <div class="form-group">
            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ $biodata->pekerjaan }}">
          </div>
          <div class="form-group">
            <label for="agama">Agama</label>
            <select class="form-control" id="agama" name="agama">
              <option value="Islam" {{ $biodata->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
              <option value="Kristen" {{ $biodata->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
              <option value="Katolik" {{ $biodata->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
              <option value="Hindu" {{ $biodata->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
              <option value="Budha" {{ $biodata->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
            </select>
          </div>
          </div>
          <div class="col-md-6 col-lg-6">
          <div class="form-group">
            <label for="warganegara">Warganegara</label>
            <select class="form-control" id="warganegara" name="warganegara">
              <option value="WNI" {{ $biodata->warganegara == 'WNI' ? 'selected' : '' }}>WNI</option>
              <option value="WNA" {{ $biodata->warganegara == 'WNA' ? 'selected' : '' }}>WNA</option>
            </select>
          </div>
          <div class="form-group">
            <label for="status_nikah">Status Pernikahan</label>
            <select class="form-control" id="status_nikah" name="status_nikah">
              <option value="Belum Kawin" {{ $biodata->status_nikah == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
              <option value="Kawin" {{ $biodata->status_nikah == 'Kawin' ? 'selected' : '' }}>Kawin</option>
              <option value="Cerai Mati" {{ $biodata->status_nikah == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
            </select>
          </div>
          <div class="form-group">
            <label>Status Warga</label>
            <select name="status_warga" class="form-control">
                <option value="Sekolah" {{ $biodata->status_warga == "Sekolah" ? 'selected' : '' }}>Sekolah</option>
                <option value="Kerja" {{ $biodata->status_warga == "Kerja" ? 'selected' : '' }}>Kerja</option>
                <option value="Bekerja" {{ $biodata->status_warga == "Bekerja" ? 'selected' : '' }}>Bekerja</option>
            </select>
        </div>
        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" name="kecamatan" value="{{ $biodata->kecamatan ?? '' }}" class="form-control" placeholder="Kecamatan Anda.." readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Desa</label>
                                            <input type="text" name="desa" value="{{ $biodata->desa ?? '' }}" class="form-control" placeholder="Desa Anda.."readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>RT</label>
                                            <input type="text" name="rt" value="{{ $biodata->rt ?? '' }}" class="form-control" placeholder="RT Anda.." >
                                        </div>
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input type="text" name="rw" value="{{ $biodata->rw ?? '' }}" class="form-control" placeholder="RW Anda.." >
                                        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $biodata->alamat }}</textarea>
        </div>
        
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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