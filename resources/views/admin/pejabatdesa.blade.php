@extends('layouts.app')
@php
    $title = 'Pejabat Desa';

@endphp
@section('title', 'Pejabat Desa')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pejabat Desa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Pejabat Desa</li>
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
                  <button class="btn btn-sm btn-success" id="btn-add-new"  type="button" data-toggle="modal" data-target="#modalTambahPejabat">
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
                          <th>NIP</th>
                          <th>Nama Pejabat</th>
                          <th>Jabatan</th>
                          <th>Pangkat</th>
                          <th style="width: 10%">Action</th>
                      </thead>
                      <tbody>
                      @foreach($pejabats as $pejabat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pejabat->nip }}</td>
                                    <td>{{ $pejabat->nm_pejabat }}</td>
                                    <td>{{ $pejabat->jabatan }}</td>
                                    <td>{{ $pejabat->pangkat }}</td>
                                    <td>
                                        
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editPejabatModal{{ $pejabat->nip }}" title="Edit Pejabat">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <form action="{{ route('pejabat.destroy', $pejabat->nip) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Pejabat">
                                                <i class="fa fa-trash"></i>
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
<div class="modal fade" id="modalTambahPejabat" tabindex="-1" role="dialog" aria-labelledby="modalTambahPejabatLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPejabatLabel">FORM TAMBAH PEJABAT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('pejabat.store') }}">
            @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="number" name="nip" class="form-control" placeholder="NIP.." autofocus>
                    </div>
                    <div class="form-group">
                        <label>Nama Pejabat</label>
                        <input type="nama" name="nama" class="form-control" placeholder="Nama..">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan" class="form-control" id="jabatan">
                            <option disabled="" selected="">Pilih Jabatan</option>
                            <option value="Kepala Desa" {{ in_array('Kepala Desa', $existing_positions) ? 'disabled' : '' }}>Kepala Desa</option>
                            <option value="Sekretaris Desa" {{ in_array('Sekretaris Desa', $existing_positions) ? 'disabled' : '' }}>Sekretaris Desa</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group" id="jblain-container" style="display: none;">
    <label>Isikan Jabatan Lainnya</label>
    <input name="jblain" class="form-control" placeholder="Jabatan..">
</div>
                    <div class="form-group">
                        <label>Pangkat</label>
                        <input name="pangkat" class="form-control" placeholder="Pangkat..">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($pejabats as $pejabat)
<div class="modal fade" id="editPejabatModal{{ $pejabat->nip }}" tabindex="-1" role="dialog" aria-labelledby="editPejabatModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPejabatModalLabel">Edit Pejabat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editPejabatForm" action="{{ route('pejabat.update', ['nip' => $pejabat->nip]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNmPejabat">Nama Pejabat</label>
                        <input type="text" class="form-control" id="editNmPejabat" name="nm_pejabat" value="{{ $pejabat->nm_pejabat }}">
                    </div>
                    <div class="form-group">
                        <label for="editJabatan">Jabatan</label>
                        <select class="form-control" id="editJabatan" name="jabatan">
                            <option value="Kepala Desa" {{ $pejabat->jabatan == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                            <option value="Sekretaris Desa" {{ $pejabat->jabatan == 'Sekretaris Desa' ? 'selected' : '' }}>Sekretaris Desa</option>
                            <option value="Lainnya" {{ $pejabat->jabatan != 'Kepala Desa' && $pejabat->jabatan != 'Sekretaris Desa' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group" id="editJblain" style="{{ $pejabat->jabatan != 'Lainnya' ? 'display: none;' : '' }}">
                        <label for="editJblainInput">Jabatan Lainnya</label>
                        <input type="text" class="form-control" id="editJblainInput" name="jblain" value="{{ $pejabat->jabatan != 'Kepala Desa' && $pejabat->jabatan != 'Sekretaris Desa' ? $pejabat->jabatan : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="editPangkat">Pangkat</label>
                        <input type="text" class="form-control" id="editPangkat" name="pangkat" value="{{ $pejabat->pangkat }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
