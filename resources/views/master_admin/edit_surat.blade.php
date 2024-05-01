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
                        @php
                            $formTambahanValues = explode(',', $berkas->form_tambahan);
                        @endphp
                        @for ($i = 1; $i <= count($formTambahanValues); $i++)
                        <select name="form_tambahan[]" class="form-control">
                          <option value="">Pilih Form Tambahan...</option>
                          <option value="Alamat_Domisili" {{ $formTambahanValues[$i-1] == 'Alamat_Domisili' ? 'selected' : '' }}>Alamat Domisili</option>
                          <option value="Domisili_Sejak" {{ $formTambahanValues[$i-1] == 'Domisili_Sejak' ? 'selected' : '' }}>Domisili Sejak</option>
                          <option value="Tujuan_Permohonan" {{ $formTambahanValues[$i-1] == 'Tujuan_Permohonan' ? 'selected' : '' }}>Tujuan Permohonan</option>
                          <option value="Nama_Anak" {{ $formTambahanValues[$i-1] == 'Nama_Anak' ? 'selected' : '' }}>Nama Anak</option>
                          <option value="Jekel_Anak" {{ $formTambahanValues[$i-1] == 'Jekel_Anak' ? 'selected' : '' }}>Jenis Kelamin Anak</option>
                          <option value="Tempat_Lahir_Anak" {{ $formTambahanValues[$i-1] == 'Tempat_Lahir_Anak' ? 'selected' : '' }}>Tempat Lahir Anak</option>
                          <option value="Sekolah" {{ $formTambahanValues[$i-1] == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                          <option value="Jurusan" {{ $formTambahanValues[$i-1] == 'Jurusan' ? 'selected' : '' }}>Jurusan</option>
                          <option value="Semester" {{ $formTambahanValues[$i-1] == 'Semester' ? 'selected' : '' }}>Semester</option>
                          <option value="Nama_Organisasi" {{ $formTambahanValues[$i-1] == 'Nama_Organisasi' ? 'selected' : '' }}>Nama Organisasi</option>
                          <option value="Alamat_Organisasi" {{ $formTambahanValues[$i-1] == 'Alamat_Organisasi' ? 'selected' : '' }}>Alamat Organisasi</option>
                          <option value="Nama_Ketua_Organisasi" {{ $formTambahanValues[$i-1] == 'Nama_Ketua_Organisasi' ? 'selected' : '' }}>Nama Ketua Organisasi</option>
                          <option value="Nik_Ayah" {{ $formTambahanValues[$i-1] == 'Nik_Ayah' ? 'selected' : '' }}>NIK Ayah</option>
                          <option value="Nik_Ibu" {{ $formTambahanValues[$i-1] == 'Nik_Ibu' ? 'selected' : '' }}>NIK Ibu</option>
                          <option value="Nama_Usaha" {{ $formTambahanValues[$i-1] == 'Nama_Usaha' ? 'selected' : '' }}>Nama Usaha</option>
                          <option value="Tahun_Usaha" {{ $formTambahanValues[$i-1] == 'Tahun_Usaha' ? 'selected' : '' }}>Tahun Usaha</option>
                          <option value="Alamat_Usaha" {{ $formTambahanValues[$i-1] == 'Alamat_Usaha' ? 'selected' : '' }}>Alamat Usaha</option>
                        </select>
                            <br>
                        @endfor
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
