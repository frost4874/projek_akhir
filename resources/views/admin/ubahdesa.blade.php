@extends('layouts.app')

@section('title', 'Edit Biodata')

@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Biodata</h1>
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
                            <form role="form" method="POST" action="{{ route('biodata.update', $data->nik) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control" value="{{ $data->email }}" placeholder="Email Desa..">
                                    </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="jekel" class="form-control">
                                                <option disabled selected>Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki" {{ $data->jekel == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="Perempuan" {{ $data->jekel == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" value="{{ $data->tempat_lahir }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $data->tgl_lahir }}">
                                        </div>
                                        
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" name="website" class="form-control" value="{{ $data->website }}" placeholder="Website Desa..">
                                    </div>
                                        
                                        <!-- Tambahkan field lain sesuai dengan struktur tabel di database -->
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password" value="{{ isset($data) ? '' : $data->password }}" class="form-control" placeholder="Isi jika ganti password" >
                                        </div>
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="text" name="telepon" id="telepon2" class="form-control" value="{{ $data->telepon }}" oninput="validatePhoneNumber()" placeholder="Telepon Anda.." pattern="08\d{9,11}" title="No Handphone harus 08, minimal 11 dan maksimal 13">
                                        <small id="teleponHelp" class="form-text text-danger" style="display:none;">Format telepon tidak valid</small>
                                    </div>
                                    
                                    <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" class="form-control" value="{{ $data->kecamatan }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Desa</label>
                                            <input type="text" class="form-control" value="{{ $data->desa }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" name="kodepos" id="kodepos" class="form-control" value="{{ $data->kodepos }}" placeholder="Kode Pos..">
                                            <small id="kodeposHelp" class="form-text text-danger" style="display:none;">Kode pos tidak valid</small>
                                        </div>
                                    
                                    
                                    
                                        <div class="form-group">
                                        <label for="comment">Alamat</label>
                                        <textarea class="form-control" name="alamat" rows="3">{{ $data->alamat }}</textarea>
                                    </div>
                                    
                                        <!-- Tambahkan field lain sesuai dengan struktur tabel di database -->
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a type="button" class="btn btn-danger" onclick="history.back()">Batal</a>
                            </form>
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
                        $('#desa').append('<option value="'+desa.id+'">'+desa.nama+'</option>');
                    });
                });
            });
        });
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
    function isValidEmailFormat(email) {
    // Regular expression to check if email2 has @gmail.com domain
    var regex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/i;
    return regex.test(email);
}

// Simpan email awal sebelum pengguna mengubahnya
var originalEmail = document.getElementById("email").value;

document.getElementById("email").addEventListener("blur", function() {
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
    document.getElementById('password').addEventListener('blur', function() {
        var password = this.value.trim();
        var passwordHelp = document.getElementById('passwordHelp');
        var passwordRegex = /(?=.*\d)(?=.*[A-Z]).{8,}/;

        if (password !== '') {
            if (!passwordRegex.test(password)) {
                passwordHelp.innerHTML = 'Password harus mengandung setidaknya satu angka, satu huruf besar, dan setidaknya 8 karakter';
                passwordHelp.style.display = 'block';
                // Optionally, you could add a visual indicator like changing the border color
                document.getElementById("password").style.borderColor = 'red';
            } else {
                passwordHelp.style.display = 'none';
                // Reset to default style if the user changes to a valid password
                document.getElementById("password").style.borderColor = '';
            }
        }
    });
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
    </script>
        
@endsection
