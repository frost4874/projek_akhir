@extends('layouts.app')

@section('title', 'Detail Request')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Request</h1>
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
                        <form action="{{ route('request.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_request" value="{{ $data->id_request }}">
                            <input type="hidden" name="id_berkas" value="{{ $data->id_berkas }}">
                            <input type="hidden" name="judul_berkas" value="{{ $judul_berkas }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keperluan">Catatan</label>
                                            <input type="text" name="keperluan" class="form-control" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <button type="submit" name="ubah" class="btn btn-info">
                                            <i class="fas fa-edit"></i> Kirim
                                        </button>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card" style="background-color: #cce5ff;">
                                            <div class="card-header">
                                                <h3 class="card-title">Detail Request</h3>
                                            </div>
                                            <div class="card-body">
                                                <!-- Isi Detail Request -->
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <input type="text" name="keterangan" value="{{ $data->keterangan ?? '' }}" class="form-control" placeholder="Keterangan">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Request</label>
                                                    <input type="text" name="tanggal_request" value="{{ $data->tanggal_request ?? '' }}" class="form-control" placeholder="Tanggal Request" readonly>
                                                </div>
                                        
                                                <div class="form-group">
                                                @foreach(explode(', ', $data->form_tambahan) as $field)
                                                    @php
                                                        [$key, $value] = explode(':', $field);
                                                    @endphp
                                                    <div class="form-group">
                                                        <label>{{ str_replace("_", " ", $key) }}</label>
                                                        <input type="text" name="{{ $key }}" value="{{ $value }}" class="form-control" placeholder="{{ str_replace("_", " ", $key) }}" autofocus>
                                                    </div>
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="number" name="nik" value="{{ $data->nik }}" class="form-control" placeholder="NIK Anda.." autofocus readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" name="nama" value="{{ $biodata->nama ?? '' }}" class="form-control" placeholder="Nama Lengkap Anda.." readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <input type="text" name="jekel" value="{{ $biodata->jekel ?? '' }}" class="form-control" placeholder="Jenis Kelamin Anda.." readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" value="{{ $biodata->tempat_lahir ?? '' }}" class="form-control" placeholder="Tempat Lahir Anda.." readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" value="{{ $biodata->tgl_lahir ?? '' }}" class="form-control" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <input type="text" name="tgl_lahir" value="{{ $biodata->agama ?? '' }}" class="form-control" readonly="">
                                        </div>
                                        <div class="form-group text-center">
                                            <label for="foto_Kk" style="display: block; margin-bottom: 5px;">Foto KK</label>
                                            <div>
                                                <img src="{{ asset('storage/foto_kk/' . $biodata->nik . '_kk' . '.' . pathinfo($biodata->foto_kk, PATHINFO_EXTENSION)) }}" alt="Foto Kk" id="fotoKk" width="150">
                                            </div>
                                            <div style="margin-top: 5px;">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFotoKK">
                                                    Lihat Foto KK
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="kecamatan" value="{{ $biodata->email ?? '' }}" class="form-control" placeholder="Email Anda.." readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" name="kecamatan" value="{{ $biodata->kecamatan ?? '' }}" class="form-control" placeholder="Kecamatan Anda.." readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label>Desa</label>
                                            <input type="text" name="desa" value="{{ $biodata->desa ?? '' }}" class="form-control" placeholder="Desa Anda.." readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label>RT</label>
                                            <input type="text" name="rt" value="{{ $biodata->rt ?? '' }}" class="form-control" placeholder="RT Anda.." readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input type="text" name="rw" value="{{ $biodata->rw ?? '' }}" class="form-control" placeholder="RW Anda.." readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" name="rw" value="{{ $biodata->alamat ?? '' }}" class="form-control" placeholder="Alamat Anda.." readonly="">
                                        </div>
                                        <div class="form-group text-center">
                                            <label for="foto_ktp" style="display: block; margin-bottom: 5px;">Foto KTP</label>
                                            <div>
                                                <img src="{{ asset('storage/foto_ktp/' . $biodata->nik . '_ktp' . '.' . pathinfo($biodata->foto_ktp, PATHINFO_EXTENSION)) }}" alt="Foto KTP" id="fotoKTP" width="150">
                                            </div>
                                            <div style="margin-top: 5px;">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFotoKTP">
                                                    Lihat Foto KTP
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                        <!-- Button Acc -->
                        <form action="{{ route('request.acc', ['id_request' => $data->id_request]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Acc
                            </button>
                            <a type="button" class="btn btn-danger" onclick="history.back()">
                            Batal
                        </a>
                        </form>
                        
                        </div>
                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal untuk Foto KK -->
<div class="modal fade" id="modalFotoKK" tabindex="-1" role="dialog" aria-labelledby="modalFotoKKLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFotoKKLabel">Foto KK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('storage/foto_kk/' . $biodata->nik . '_kk' . '.' . pathinfo($biodata->foto_kk, PATHINFO_EXTENSION)) }}" class="img-fluid" alt="Foto KK">
      </div>
    </div>
  </div>
</div>

<!-- Modal untuk Foto KTP -->
<div class="modal fade" id="modalFotoKTP" tabindex="-1" role="dialog" aria-labelledby="modalFotoKTPLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFotoKTPLabel">Foto KTP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('storage/foto_ktp/' . $biodata->nik . '_ktp' . '.' . pathinfo($biodata->foto_ktp, PATHINFO_EXTENSION)) }}" class="img-fluid" alt="Foto KTP">
      </div>
    </div>
  </div>
</div>

</section>


@endsection
