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
                      @php
                       // Hitung nomor urutan untuk halaman saat ini
                       $startNumber = ($biodatas->currentPage() - 1) * $biodatas->perPage() + 1;
                    @endphp
                    @foreach($biodatas as $index => $biodata)
                    <tr>
                        <td>{{ $startNumber + $index }}</td>
                        <td>{{ $biodata->email }}</td>
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
                <input type="text" class="form-control" id="telepon" name="telepon" oninput="validatePhoneNumber()" required>
                <small id="teleponHelp" class="form-text text-danger" style="display:none;">Format telepon tidak valid, harus dimulai dengan 62 dan minimal 11 angka.</small>
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
								<input type="text" class="form-control" id="kodepos" name="kodepos" pattern="[0-9]{5}">
                                <small id="kodeposHelp" class="form-text text-danger" style="display:none;">Kode pos harus terdiri dari 5 digit angka</small>
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
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir2" name="tgl_lahir" value="{{ $biodata->tgl_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon2" id="telepon2" class="form-control" value="{{ $biodata->telepon }}" oninput="validatePhoneNumber2()" placeholder="Telepon Anda.." pattern="08\d{9,11}" title="No Handphone harus 08, minimal 11 dan maksimal 13">
                                <small id="teleponHelp2" class="form-text text-danger" style="display:none;">Format telepon tidak valid</small>
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
                                            <input type="text" class="form-control" id="kodepos2" name="kodepos" value="{{ $biodata->kodepos ?? '' }}" pattern="[0-9]{5}">
                                            <small id="kodeposHelp2" class="form-text text-danger" style="display:none;">Kode pos harus terdiri dari 5 digit angka</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" value="{{ isset($biodata) ? '' : $biodata->password }}" class="form-control" placeholder="Isi jika ganti password" >
                                        </div>
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
document.getElementById('telepon').addEventListener('input', function() {
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

    document.getElementById('telepon2').addEventListener('input', function() {
        var teleponInput = this.value.trim();
        var teleponNumbers = teleponInput.replace(/\D/g, '');
        this.value = teleponNumbers;
        var teleponHelp = document.getElementById('teleponHelp2');
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
            
            const isValid = phoneNumber.startsWith('08') && phoneNumber.length >= 11;

            if (!isValid) {
                phoneHelp.style.display = 'block';
                phoneInput.setCustomValidity('Invalid phone number');
            } else {
                phoneHelp.style.display = 'none';
                phoneInput.setCustomValidity('');
            }
        }
        function validatePhoneNumber2() {
            const phoneInput = document.getElementById('telepon2');
            const phoneHelp = document.getElementById('teleponHelp2');
            const phoneNumber = phoneInput.value;
            
            const isValid = phoneNumber.startsWith('08') && phoneNumber.length >= 11;

            if (!isValid) {
                phoneHelp.style.display = 'block';
                phoneInput.setCustomValidity('Invalid phone number');
            } else {
                phoneHelp.style.display = 'none';
                phoneInput.setCustomValidity('');
            }
        }
    document.getElementById('kodepos').addEventListener('input', function() {
        var kodeposInput = this.value.trim();
        var kodeposNumbers = kodeposInput.replace(/\D/g, '');
        this.value = kodeposNumbers;
        var kodeposHelp = document.getElementById('kodeposHelp');
        var regex = /^[0-9]{5}$/;

        if (kodeposInput.length > 0 && !regex.test(kodeposInput)) {
            kodeposHelp.style.display = 'block';
        } else {
            kodeposHelp.style.display = 'none';
        }
    });
    document.getElementById('kodepos2').addEventListener('input', function() {
        var kodeposInput = this.value.trim();
        var kodeposNumbers = kodeposInput.replace(/\D/g, '');
        this.value = kodeposNumbers;
        var kodeposHelp = document.getElementById('kodeposHelp2');
        var regex = /^[0-9]{5}$/;

        if (kodeposInput.length > 0 && !regex.test(kodeposInput)) {
            kodeposHelp.style.display = 'block';
        } else {
            kodeposHelp.style.display = 'none';
        }
    });

</script>
    
@endsection