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
                    <div class="form-group row" id="formTambahanContainer">
                                <label class="col-sm-2 col-form-label">Form Tambahan</label>
                                <div class="col-sm-10">
                                    <!-- Teks yang dapat diklik untuk menambahkan form -->
                                    <div class="text-right mb-2">
                                        <a href="#" id="tambahForm" class="btn btn-link">Tambah Form</a>
                                        <a href="#" id="hapusForm" class="btn btn-link text-danger">Hapus Form</a>
                                    </div>
                                </div>
                        @php
                            $formTambahanValues = explode(',', $berkas->form_tambahan);
                        @endphp
                        @for ($i = 1; $i <= count($formTambahanValues); $i++)
                        <select name="form_tambahan[]" class="form-control">
                          <option value="">Pilih Form Tambahan...</option>
                          <option value="Alamat_Domisili" {{ $formTambahanValues[$i-1] == 'Alamat_Domisili' ? 'selected' : '' }}>Alamat Domisili</option>
                          <option value="Domisili_Sejak" {{ $formTambahanValues[$i-1] == 'Domisili_Sejak' ? 'selected' : '' }}>Domisili Sejak</option>
                          <option value="Domisili_Sekarang" {{ $formTambahanValues[$i-1] == 'Domisili_Sekarang' ? 'selected' : '' }}>Domisili Sekarang</option>
                          <option value="Tujuan_Permohonan" {{ $formTambahanValues[$i-1] == 'Tujuan_Permohonan' ? 'selected' : '' }}>Tujuan Permohonan</option>
                          <option value="Keterangan_Tambahan" {{ $formTambahanValues[$i-1] == 'Keterangan_Tambahan' ? 'selected' : '' }}>Keterangan Tambahan</option>
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
                          <option value="No_Pengantar" {{ $formTambahanValues[$i-1] == 'No_Pengantar' ? 'selected' : '' }}>No Pengantar</option>
                          <option value="Tanggal_Permohonan" {{ $formTambahanValues[$i-1] == 'Tanggal_Permohonan' ? 'selected' : '' }}>Tanggal Permohonan</option>
                          <option value="Luas_Tanah" {{ $formTambahanValues[$i-1] == 'Luas_Tanah' ? 'selected' : '' }}>Luas Tanah</option>
                          <option value="Lokasi_Tanah" {{ $formTambahanValues[$i-1] == 'Lokasi_Tanah' ? 'selected' : '' }}>Lokasi Tanah</option>
                          <option value="Jenis_Surat_Tanah" {{ $formTambahanValues[$i-1] == 'Jenis_Surat_Tanah' ? 'selected' : '' }}>Jenis Surat Tanah</option>
                          <option value="Nomor_Surat_Tanah" {{ $formTambahanValues[$i-1] == 'Nomor_Surat_Tanah' ? 'selected' : '' }}>Nomor Surat Tanah</option>
                          <option value="Agama_Anak" {{ $formTambahanValues[$i-1] == 'Agama_Anak' ? 'selected' : '' }}>Agama Anak</option>
                          <option value="Alamat_Anak" {{ $formTambahanValues[$i-1] == 'Alamat_Anak' ? 'selected' : '' }}>Alamat Anak</option>
                          <option value="Tanggal_Lahir_Anak" {{ $formTambahanValues[$i-1] == 'Tanggal_Lahir_Anak' ? 'selected' : '' }}>Tanggal Lahir Anak</option>
                          <option value="Bin/Binti" {{ $formTambahanValues[$i-1] == 'Bin/Binti' ? 'selected' : '' }}>Bin/Binti</option>
                          <option value="Tanggal_Kematian" {{ $formTambahanValues[$i-1] == 'Tanggal_Kematian' ? 'selected' : '' }}>Tanggal Kematian</option>
                          <option value="Jam_Kematian" {{ $formTambahanValues[$i-1] == 'Jam_Kematian' ? 'selected' : '' }}>Jam Kematian</option>
                          <option value="Nama_Lembaga" {{ $formTambahanValues[$i-1] == 'Nama_Lembaga' ? 'selected' : '' }}>Nama Lembaga</option>
                          <option value="Alamat_Lembaga" {{ $formTambahanValues[$i-1] == 'Alamat_Lembaga' ? 'selected' : '' }}>Alamat Lembaga</option>
                          <option value="Nama_Pengasuh" {{ $formTambahanValues[$i-1] == 'Nama_Pengasuh' ? 'selected' : '' }}>Nama Pengasuh</option>
                          <option value="Tujuan_Usaha" {{ $formTambahanValues[$i-1] == 'Tujuan_Usaha' ? 'selected' : '' }}>Tujuan Usaha</option>
                          <option value="Tempat_Meninggal" {{ $formTambahanValues[$i-1] == 'Tempat_Meninggal' ? 'selected' : '' }}>Tempat Meninggal</option>
                          <option value="Sebab_Kematian" {{ $formTambahanValues[$i-1] == 'Sebab_Kematian' ? 'selected' : '' }}>Sebab Kematian</option>
                          <option value="Jumlah_Penghasilan" {{ $formTambahanValues[$i-1] == 'Jumlah_Penghasilan' ? 'selected' : '' }}>Jumlah Penghasilan</option>
                          <option value="Nama_Pelapor" {{ $formTambahanValues[$i-1] == 'Nama_Pelapor' ? 'selected' : '' }}>Nama Pelapor</option>
                          <option value="Nik_Pelapor" {{ $formTambahanValues[$i-1] == 'Nik_Pelapor' ? 'selected' : '' }}>NIK Pelapor</option>
                          <option value="Alamat_Pelapor" {{ $formTambahanValues[$i-1] == 'Alamat_Pelapor' ? 'selected' : '' }}>Alamat Pelapor</option>
                        </select>
                        @endfor
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
<script>
document.getElementById('tambahForm').addEventListener('click', function() {
    var container = document.getElementById('formTambahanContainer');
    var newSelect = document.createElement('select');
    newSelect.setAttribute('name', 'form_tambahan[]');
    newSelect.setAttribute('class', 'form-control mb-2');
    newSelect.style.width = '100%';
    newSelect.innerHTML = `
    <option value="">Pilih Form Tambahan...</option>
    <option value="Alamat_Domisili">Alamat Domisili</option>
    <option value="Domisili_Sejak">Domisili Sejak</option>
    <option value="Domisili_Sekarang">Domisili Sekarang</option>
    <option value="Tujuan_Permohonan">Tujuan Permohonan</option>
    <option value="Keterangan_Tambahan">Keterangan Tambahan</option>
    <option value="Nama_Anak">Nama Anak</option>
    <option value="Jekel_Anak">Jenis Kelamin Anak</option>
    <option value="Tempat_Lahir_Anak">Tempat Lahir Anak</option>
    <option value="Sekolah">Sekolah</option>
    <option value="Jurusan">Jurusan</option>
    <option value="Semester">Semester</option>
    <option value="Nama_Organisasi">Nama Organisasi</option>
    <option value="Alamat_Organisasi">Alamat Organisasi</option>
    <option value="Nama_Ketua_Organisasi">Nama Ketua Organisasi</option>
    <option value="Nik_Ayah">NIK Ayah</option>
    <option value="Nik_Ibu">NIK Ibu</option>
    <option value="Nama_Usaha">Nama Usaha</option>
    <option value="Tahun_Usaha">Tahun Usaha</option>
    <option value="Alamat_Usaha">Alamat Usaha</option>
    <option value="No_Pengantar">No Pengantar</option>
    <option value="Tanggal_Permohonan">Tanggal Permohonan</option>
    <option value="Luas_Tanah">Luas Tanah</option>
    <option value="Lokasi_Tanah">Lokasi Tanah</option>
    <option value="Jenis_Surat_Tanah">Jenis Surat Tanah</option>
    <option value="Nomor_Surat_Tanah">Nomor Surat Tanah</option>
    <option value="Agama_Anak">Agama Anak</option>
    <option value="Alamat_Anak">Alamat Anak</option>
    <option value="Tanggal_Lahir_Anak">Tanggal Lahir Anak</option>
    <option value="Bin/Binti">Bin/Binti</option>
    <option value="Tanggal_Kematian">Tanggal Kematian</option>
    <option value="Jam_Kematian">Jam Kematian</option>
    <option value="Nama_Lembaga">Nama Lembaga</option>
    <option value="Alamat_Lembaga">Alamat Lembaga</option>
    <option value="Nama_Pengasuh">Nama Pengasuh</option>
    <option value="Tujuan_Usaha">Tujuan Usaha</option>
    <option value="Tempat_Meninggal">Tempat Meninggal</option>
    <option value="Sebab_Kematian">Sebab Kematian</option>
    <option value="Jumlah_Penghasilan">Jumlah Penghasilan</option>
    <option value="Nama_Pelapor">Nama Pelapor</option>
    <option value="Nik_Pelapor">NIK Pelapor</option>
    <option value="Alamat_Pelapor">Alamat Pelapor</option>
    `;
    container.appendChild(newSelect);
});


  document.getElementById('hapusForm').addEventListener('click', function() {
    var container = document.getElementById('formTambahanContainer');
    var selects = container.querySelectorAll('select[name="form_tambahan[]"]');
    if (selects.length > 1) {
        container.removeChild(selects[selects.length - 1]);
    } else {
        alert('Tidak dapat menghapus dropdown terakhir.');
    }
});
document.getElementById('submitBtn').addEventListener('click', function(event) {
    // Mencegah formulir untuk dikirim secara default
    event.preventDefault();

    // Mendapatkan nilai dari input Judul, Kode Berkas, Kode Belakang, dan Template Surat
    var judul = document.querySelector('input[name="judul_berkas"]');
    var kodeBerkas = document.querySelector('input[name="kode_berkas"]');
    var kodeBelakang = document.querySelector('input[name="kode_belakang"]');
    var template = document.querySelector('textarea[name="template"]');

    // Variabel untuk menentukan apakah semua input yang harus diisi telah terisi
    var isValid = true;

    // Memeriksa apakah input Judul kosong
    if (judul.value.trim() === '') {
        isValid = false;
        // Tambahkan kelas is-invalid untuk menyoroti input yang kosong
        judul.classList.add('is-invalid');
    } else {
        // Hapus kelas is-invalid jika input sudah diisi
        judul.classList.remove('is-invalid');
    }

    // Memeriksa apakah input Kode Berkas kosong
    if (kodeBerkas.value.trim() === '') {
        isValid = false;
        // Tambahkan kelas is-invalid untuk menyoroti input yang kosong
        kodeBerkas.classList.add('is-invalid');
    } else {
        // Hapus kelas is-invalid jika input sudah diisi
        kodeBerkas.classList.remove('is-invalid');
    }

    // Memeriksa apakah input Kode Belakang kosong
    if (kodeBelakang.value.trim() === '') {
        isValid = false;
        // Tambahkan kelas is-invalid untuk menyoroti input yang kosong
        kodeBelakang.classList.add('is-invalid');
    } else {
        // Hapus kelas is-invalid jika input sudah diisi
        kodeBelakang.classList.remove('is-invalid');
    }

    // Memeriksa apakah input Template Surat kosong
    if (template.value.trim() === '') {
        isValid = false;
        // Tambahkan kelas is-invalid untuk menyoroti input yang kosong
        template.classList.add('is-invalid');
    } else {
        // Hapus kelas is-invalid jika input sudah diisi
        template.classList.remove('is-invalid');
    }

    // Jika semua input yang harus diisi telah terisi, kirim formulir
    if (isValid) {
        this.form.submit();
    } else {
        // Jika ada input yang tidak diisi, tampilkan pesan kesalahan
        alert('Harap lengkapi semua kolom yang diperlukan sebelum mengirimkan formulir.');
    }
});
</script>

    
@endsection
