@extends('layouts.app')
@section('title', 'Laporan')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Laporan</li>
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
              Laporan

              <div class="float-right">
                <button class="btn btn-sm btn-danger" id="btn-save-pdf">
                      <i class="fas fa-save"></i>
                      Simpan ke PDF
                  </button>
                  <!-- Tombol untuk mencetak -->
                  <button class="btn btn-sm btn-warning" id="btn-print">
                      <i class="fas fa-print"></i>
                      Cetak
                  </button>
              </div>
          </div>
          <div class="card-body">
                        <form action="{{ route('laporan.masterprint') }}" method="POST" class="d-inline-block">
                            @csrf <!-- Tambahkan CSRF token untuk keamanan -->
                            <div class="form-row align-items-center">
                            <div class="col-auto">
                                        <label for="kecamatan">Kecamatan</label>
                                        <select class="form-control" id="kecamatan" name="kecamatan">
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <label for="desa">Desa</label>
                                        <select class="form-control" id="desa" name="desa">
                                            <option value="">Pilih Desa</option>
                                        </select>
                                    </div>
                                <div class="col-auto">
                                    <label for="tanggalDari">Dari</label>
                                    <input type="date" class="form-control form-control-sm mb-2" id="tanggalDari" name="tanggal_dari" placeholder="Dari">
                                </div>
                                
                                <div class="col-auto">
                                    <label for="tanggalSampai">Sampai</label>
                                    <input type="date" class="form-control form-control-sm mb-2" id="tanggalSampai" name="tanggal_sampai" placeholder="Sampai">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-primary mb-2">Print PDF</button>
                                </div>
                            </div>
                        </form>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-striped table-hover" id="table-list">
                      <thead>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal ACC</th>
                        <th scope="col">Nik</th>
												<th scope="col">Nama</th>
												<th scope="col">Permohonan</th>
												<th style="col">Desa</th>
                      </thead>
                      <tbody>
                      @php
                                        // Hitung nomor urutan untuk halaman saat ini
                                        $startNumber = ($requests->currentPage() - 1) * $requests->perPage() + 1;
                                    @endphp
                                    @foreach($requests as $index => $request)
                                    <tr>
                                        <td>{{ $startNumber + $index }}</td>
                                        <td>{{ $request->acc }}</td>
                                        <td>{{ $request->nik}}</td>
                                        <td>{{ $request->nama}}</td>
                                        <td>{{ $request->judul_berkas }}</td>
                                        <td>{{ $request->id_desa }}</td>
                                        
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
                        $('#desa').append('<option value="'+desa.nama+'">'+desa.nama+'</option>');
                    });
                });
            });
        });
    </script>
    
@endsection