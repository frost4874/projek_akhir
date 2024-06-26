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
                      @php
                       // Hitung nomor urutan untuk halaman saat ini
                       $startNumber = ($biodatas->currentPage() - 1) * $biodatas->perPage() + 1;
                       @endphp
@foreach($biodatas as $index => $biodata)
        <tr>
            <td>{{ $startNumber + $index }}</td>
            <td>{{ $biodata->nik }}</td>
            <td>{{ $biodata->nama }}</td>
            <td>{{ $biodata->jekel }}</td>
            <td>{{ $biodata->kecamatan }}</td>
            <td>{{ $biodata->desa }}</td>
            <td>
                <!-- Tambahkan tombol untuk opsi, misalnya: edit, hapus, dll -->
                <!-- Tombol Verifikasi -->
                @if($biodata->status == 'Tidak Aktif')
                <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#verifBiodataModal{{ $biodata->nik }}">
                    <i class="fas fa-check"></i> Verifikasi
                </button>
                @elseif($biodata->status == 'Aktif')
                <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#ubahBiodataModal{{ $biodata->nik }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
            <form action="{{ route('masyarakat.delete', $biodata->nik) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Pejabat">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </form>
                @endif
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

   <!-- Tampilkan tombol navigasi paginate -->
@if ($biodatas->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            {{-- Tombol Previous --}}
            @if ($biodatas->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $biodatas->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif

            {{-- Tautan Nomor Halaman --}}
            @foreach ($biodatas->links()->elements[0] as $page => $url)
                <li class="page-item {{ $biodatas->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Tombol Next --}}
            @if ($biodatas->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $biodatas->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
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
                <form id="registrationForm" action="{{ route('register.masyarakat') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" required autofocus maxlength="16" >
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
                                <div class="form-group">
    <label for="foto_ktp">Foto KTP</label>
    <input type="file" class="form-control-file" id="foto_ktp" name="foto_ktp" accept="image/*" required>
</div>
<div class="form-group">
    <label for="foto_kk">Foto KK</label>
    <input type="file" class="form-control-file" id="foto_kk" name="foto_kk" accept="image/*" required>
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
                <input type="text" name="nik" value="{{ $biodata->nik }}" class="form-control" placeholder="NIK Anda.." autofocus readonly>
            </div>

          <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $biodata->nama }}">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email2" name="email" value="{{ $biodata->email }}">
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
            <input type="date" class="form-control" id="tgl_lahir2" name="tgl_lahir" value="{{ $biodata->tgl_lahir }}">
          </div>
          <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" name="telepon" id="telepon2" class="form-control" value="{{ $biodata->telepon }}" oninput="validatePhoneNumber()" placeholder="Telepon Anda.." pattern="08\d{9,11}" title="No Handphone harus 08, minimal 11 dan maksimal 13">
             <small id="teleponHelp" class="form-text text-danger" style="display:none;">Format telepon tidak valid</small>
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
                                            <input type="text" name="rt" id="rt" value="{{ $biodata->rt ?? '' }}" class="form-control" placeholder="RT Anda.." >
                                        </div>
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input type="text" name="rw" id="rw" value="{{ $biodata->rw ?? '' }}" class="form-control" placeholder="RW Anda.." >
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

<!-- Modal -->
@foreach($biodatas as $biodata)
<div class="modal fade" id="verifBiodataModal{{ $biodata->nik }}" tabindex="-1" role="dialog" aria-labelledby="verifBiodataModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="verifBiodataModalLabel">Verifikasi Biodata</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulir untuk mengubah biodata -->
          <div class="row">
            <div class="col-md-6 col-lg-6">
              <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" value="{{ $biodata->nik }}" class="form-control" placeholder="NIK Anda.." readonly>
              </div>

              <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $biodata->nama }}" readonly>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $biodata->email }}" readonly>
              </div>
              <div class="form-group">
                <label for="jekel">Jenis Kelamin</label>
                <input type="text" class="form-control" id="jekel" name="jekel" value="{{ $biodata->jekel }}" readonly>
              </div>
              <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $biodata->tgl_lahir }}" readonly>
              </div>
              <div class="form-group">
                <label for="foto_kk">Foto KK</label>
                <img src="{{ asset('storage/foto_ktp/' . $biodata->nik . '_ktp' . '.' . pathinfo($biodata->foto_ktp, PATHINFO_EXTENSION)) }}" alt="Foto KTP" id="fotoKTP" width="150">
              </div>
            </div>
            
            <div class="col-md-6 col-lg-6">
            <div class="form-group">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota" value="Jember" readonly>
                            </div>
              <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" name="kecamatan" value="{{ $biodata->kecamatan ?? '' }}" class="form-control" placeholder="Kecamatan Anda.." readonly>
              </div>
              <div class="form-group">
                <label>Desa</label>
                <input type="text" name="desa" value="{{ $biodata->desa ?? '' }}" class="form-control" placeholder="Desa Anda.." readonly>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" readonly>{{ $biodata->alamat }}</textarea>
              </div>
              <div class="form-group">
                <label for="foto_ktp">Foto KTP</label>
                <img src="{{ asset('storage/foto_kk/' . $biodata->nik . '_kk' . '.' . pathinfo($biodata->foto_kk, PATHINFO_EXTENSION)) }}" alt="Foto Kk" id="fotoKk" width="150">
              </div>
            </div>
          </div>
          <div class="modal-footer">
          <form action="{{ route('verif.regist', ['nik' => $biodata->nik]) }}" method="POST">
          @csrf
          @method('PUT')
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Verifikasi</button>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endforeach
<script>
    // Validasi tanggal lahir
    document.getElementById("tgl_lahir").addEventListener("change", function() {
        var selectedDate = new Date(this.value);
        var currentDate = new Date();
        var minDate = new Date("2007-05-01"); // Tanggal minimal yang diizinkan

        if (selectedDate > currentDate) {
            alert("Tanggal lahir tidak boleh melebihi tanggal hari ini.");
            this.value = ''; // Mengosongkan tanggal lahir
        } else if (selectedDate > minDate) {
            alert("Umur harus minimal 17 tahun.");
            this.value = ''; // Mengosongkan tanggal lahir
        }
    });
    document.getElementById("tgl_lahir2").addEventListener("change", function() {
        var selectedDate = new Date(this.value);
        var currentDate = new Date();
        var minDate = new Date("2007-05-01"); // Tanggal minimal yang diizinkan

        if (selectedDate > currentDate) {
            alert("Tanggal lahir tidak boleh melebihi tanggal hari ini.");
            this.value = ''; // Mengosongkan tanggal lahir
        } else if (selectedDate > minDate) {
            alert("Umur harus minimal 17 tahun.");
            this.value = ''; // Mengosongkan tanggal lahir
        }
    });
   // Validate NIK uniqueness
document.getElementById("nik").addEventListener("blur", function() {
    var nik = this.value;
    if (nik.trim() !== '') {
        fetch(`/check-nik?nik=${nik}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                alert("NIK sudah terdaftar. Silakan gunakan NIK yang lain.");
                // Optionally, you could add a visual indicator like changing the border color
                document.getElementById("nik").style.borderColor = 'red';
            } else {
                // Reset to default style if the user changes to a valid NIK
                document.getElementById("nik").style.borderColor = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});

// Validate Email uniqueness
document.getElementById("email").addEventListener("blur", function() {
    var email = this.value.trim();
    if (email !== '') {
        // Validate email format
        if (!isValidEmailFormat(email)) {
            alert("Format email salah. Email harus memiliki domain @gmail.com.");
            this.style.borderColor = 'red';
            return;
        }

        // Check if email is already registered
        fetch(`/check-email?email=${email}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                alert("Email sudah terdaftar. Silakan gunakan email yang lain.");
                this.style.borderColor = 'red';
            } else {
                // Reset to default style if the user changes to a valid email
                this.style.borderColor = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});

function isValidEmailFormat(email) {
    // Regular expression to check if email2 has @gmail.com domain
    var regex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/i;
    return regex.test(email);
}

// Simpan email awal sebelum pengguna mengubahnya
var originalEmail = document.getElementById("email2").value;

document.getElementById("email2").addEventListener("blur", function() {
    var newEmail = this.value.trim();
    
    // Periksa apakah email diubah
    if (newEmail !== originalEmail) {
        // Validate email format
        if (!isValidEmailFormat(newEmail)) {
            alert("Format email salah. Email harus memiliki domain @gmail.com.");
            this.style.borderColor = 'red';
            return;
        }

        // Check if email is already registered
        fetch(`/check-email?email=${newEmail}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                alert("Email sudah terdaftar. Silakan gunakan email yang lain.");
                this.style.borderColor = 'red';
            } else {
                // Reset to default style if the user changes to a valid email
                this.style.borderColor = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});


document.getElementById('telepon2').addEventListener('input', function() {
        var teleponInput = this.value.trim();
        var teleponNumbers = teleponInput.replace(/\D/g, '');
        this.value = teleponNumbers;
        var teleponHelp = document.getElementById('teleponHelp');
        var regex = /^08\d{9,11}$/;

        if (teleponInput.length > 0 && !regex.test(teleponInput)) {
            teleponHelp.style.display = 'block';
        } else {
            teleponHelp.style.display = 'none';
        }
    });
    function validatePhoneNumber() {
            const phoneInput = document.getElementById('telepon');
            const phoneHelp = document.getElementById('teleponHelp');
            const phoneNumber = phoneInput.value;
            
            const isValid = phoneNumber.startsWith('62') && phoneNumber.length >= 11;

            if (!isValid) {
                phoneHelp.style.display = 'block';
                phoneInput.setCustomValidity('Invalid phone number');
            } else {
                phoneHelp.style.display = 'none';
                phoneInput.setCustomValidity('');
            }
        }
        document.getElementById("rt").addEventListener("input", function() {
    // Mengambil nilai input RT
    var rtValue = this.value;

    // Menghapus karakter non-angka dari nilai input
    var rtNumbers = rtValue.replace(/\D/g, '');

    // Memperbarui nilai input dengan hanya angka
    this.value = rtNumbers;
});

// Event listener untuk input RW
document.getElementById("rw").addEventListener("input", function() {
    // Mengambil nilai input RW
    var rwValue = this.value;

    // Menghapus karakter non-angka dari nilai input
    var rwNumbers = rwValue.replace(/\D/g, '');

    // Memperbarui nilai input dengan hanya angka
    this.value = rwNumbers;
});

</script>


    
@endsection