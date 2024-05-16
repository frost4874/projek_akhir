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
                            <form role="form" method="POST" action="{{ route('update.master', $data->nik) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        
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
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $data->tgl_lahir }}">
                                        </div>
                                        
                                        <!-- Tambahkan field lain sesuai dengan struktur tabel di database -->
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="number" name="telepon" id="telepon" class="form-control" value="{{ $data->telepon }}" oninput="validatePhoneNumber()" placeholder="Telepon Anda.." pattern="08\d{9,11}" title="No Handphone harus 08, minimal 11 dan maksimal 13">
                                        <small id="teleponHelp" class="form-text text-danger" style="display:none;">Format telepon tidak valid</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ $data->email }}" placeholder="Email Anda..">
                                    </div>
                                    <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password" value="{{ isset($data) ? '' : $data->password }}" class="form-control" placeholder="Isi jika ganti password">
                                            <small id="passwordHelp" class="form-text text-danger" style="display:none;">Password harus mengandung setidaknya satu angka, satu huruf besar, dan setidaknya 8 karakter</small>
                                        </div>
                                        <!-- Tambahkan field lain sesuai dengan struktur tabel di database -->
                                    </div>
                                </div>
                                <button type="submit" id="submitBtn" class="btn btn-primary">Simpan</button>
                                <a class="btn btn-danger" onclick="history.back()" type="button">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </section>

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
            
            const isValid = phoneNumber.startsWith('08') && phoneNumber.length >= 11;

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
</script>

@endsection
