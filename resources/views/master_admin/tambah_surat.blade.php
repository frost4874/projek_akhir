@extends('layouts.app')

@section('title', 'Tambah Template Surat')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Template Surat</h1>
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
                        <h5>FORMULIR PENAMBAHAN TEMPLATE SURAT</h5>
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
                                <textarea name="template" id="templateQ" class="form-control" cols="30" rows="10"></textarea>
                                <label>*Pilih menambahkan data supaya menggunakan $ pada CKEditor</label>
                                  <select id="variableDropdown" class="form-control mb-2">
                                  <option value="">Pilih data yang ingin ditambahkan pada CKEditor</option>
                                  <option value="$alamat_domisili">Alamat Domisili</option>
                                  <option value="$domisili_sejak">Domisili Sejak</option>
                                  <option value="$tujuan_permohonan">Tujuan Permohonan</option>
                                  <option value="$nama_anak">Nama Anak</option>
                                  <option value="$jekel_anak">Jenis Kelamin Anak</option>
                                  <option value="$tempat_lahir_anak">Tempat Lahir Anak</option>
                                  <option value="$sekolah">Sekolah</option>
                                  <option value="$jurusan">Jurusan</option>
                                  <option value="$semester">Semester</option>
                                  <option value="$nama_organisasi">Nama Organisasi</option>
                                  <option value="$alamat_organisasi">Alamat Organisasi</option>
                                  <option value="$nama_ketua_organisasi">Nama Ketua Organisasi</option>
                                  <option value="$nik_ayah">NIK Ayah</option>
                                  <option value="$nik_ibu">NIK Ibu</option>
                                  <option value="$nama_usaha">Nama Usaha</option>
                                  <option value="$tahun_usaha">Tahun Usaha</option>
                                  <option value="$alamat_usaha">Alamat Usaha</option>
                                      <!-- Tambahkan opsi untuk variabel lainnya sesuai kebutuhan -->
                                  </select>
                                  <button id="insertVariableBtn" type="button" class="btn btn-primary">Tambah</button>
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
                                <!-- Dropdown pertama di luar col-sm-10 agar mengambil lebar penuh -->
                                <select name="form_tambahan[]" class="form-control mb-2 col-sm-12" style="width: 100%">
                                    <option value="">Pilih Form Tambahan...</option>
                                    <option value="Alamat_Domisili">Alamat Domisili</option>
                                    <option value="Domisili_Sejak">Domisili Sejak</option>
                                    <option value="Tujuan_Permohonan">Tujuan Permohonan</option>
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
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('templateQ');

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
    <option value="Tujuan_Permohonan">Tujuan Permohonan</option>
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
    `;
    container.appendChild(newSelect);
});

document.addEventListener('submit', function() {
    var selects = document.querySelectorAll('select[name="form_tambahan[]"]');
    var values = [];
    selects.forEach(function(select) {
        if (select.value) {
            values.push(select.value);
        }
    });
    document.querySelector('input[name="form_tambahan"]').value = values.join(',');
});

document.getElementById('insertVariableBtn').addEventListener('click', function() {
    var variable = document.getElementById('variableDropdown').value;
    insertText(variable);
});

// Fungsi untuk menyisipkan teks di posisi kursor saat ini
function insertText(text) {
    var editor = CKEDITOR.instances['templateQ'];
    if (editor) {
        if (editor.mode === 'wysiwyg') {
            editor.insertHtml(text);
        } else {
            alert('Anda harus berada dalam mode WYSIWYG!');
        }
    }
}

document.getElementById('hapusForm').addEventListener('click', function() {
    var container = document.getElementById('formTambahanContainer');
    var selects = container.querySelectorAll('select[name="form_tambahan[]"]');
    if (selects.length > 1) {
        container.removeChild(selects[selects.length - 1]);
    } else {
        alert('Tidak dapat menghapus dropdown terakhir.');
    }
});

</script>
    
@endsection
