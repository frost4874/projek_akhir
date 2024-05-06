<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/asset/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    @include('layouts.topbar')
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/asset/images/jember.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      @php
        $role = auth()->user()->role;
      @endphp
      @if($role === 'Admin Master')
      <span class="brand-text font-weight-bold">Master Admin</span>
      @elseif($role === 'Admin Desa')
      <span class="brand-text font-weight-bold">Admin Desa</span>
      @elseif($role === 'Pemohon')
      <span class="brand-text font-weight-bold">Pemohon</span>
      @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      @include('layouts.sidebar')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/asset/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/asset/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/asset/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/asset/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/asset/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/asset/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/asset/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/asset/plugins/moment/moment.min.js"></script>
<script src="/asset/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/asset/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/asset/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/asset/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/asset/dist/js/pages/dashboard.js"></script>
<script src="adminlte/plugins/demo/demo.js" disabled></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Periksa apakah salah satu submenu aktif
        var activeSubmenu = document.querySelector("#pengaturanDropdown .nav-link.active");

        // Jika ada submenu yang aktif, tambahkan kelas 'show' ke dropdown
        if (activeSubmenu) {
            activeSubmenu.closest(".nav-treeview").classList.add("show");
        }
    });
</script>

<script>
        $(document).ready(function(){
            $('#nik').on('input', function(){
                var nikLength = $(this).val().length;
                if(nikLength < 16){
                    $('#nikWarning').text('NIK harus terdiri dari 16 digit').addClass('text-danger');
                }else{
                    $('#nikWarning').text('').removeClass('text-danger');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#togglePassword').on('click', function(){
                var passwordInput = $('#password');
                var passwordFieldType = passwordInput.attr('type');
                if(passwordFieldType === 'password'){
                    passwordInput.attr('type', 'text');
                    $(this).html('<i class="fas fa-eye-slash"></i>');
                }else{
                    passwordInput.attr('type', 'password');
                    $(this).html('<i class="fas fa-eye"></i>');
                }
            });
        });
    </script>

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
    </script>
<script>
$(document).ready(function () {
    // Menambahkan event click pada setiap link dengan class 'nav-link'
    $('ul.nav-sidebar a.nav-link').click(function (e) {
        // e.preventDefault(); // Mencegah perilaku default tautan
        
        // Menghapus kelas 'active' dari semua item menu
        $('ul.nav-sidebar a.nav-link').removeClass('active');

        // Menambahkan kelas 'active' ke item menu yang sedang di-klik
        $(this).addClass('active');

        // Memeriksa apakah sub-menu masih terbuka (menu-open)
        var isSubMenuOpen = $(this).parent().hasClass('menu-open');

        // Jika sub-menu terbuka, maka tambahkan kembali kelas 'active' ke tombol menu
        if (isSubMenuOpen) {
            $(this).closest('.has-treeview').children('.nav-link').addClass('active');
        }

        // Memeriksa apakah URL yang diklik sama dengan URL halaman saat ini
        var currentURL = window.location.href;
        var clickedURL = $(this).attr('href');

        if (currentURL === clickedURL) {
            $(this).addClass('active');
        } else {
            // Menggunakan AJAX untuk memuat konten halaman baru saat pengguna mengklik tautan menu
            var url = $(this).attr('href');

            // Memuat konten halaman baru dengan AJAX
            $.ajax({
                url: url,
                success: function (data) {
                    // Mengganti konten halaman dalam elemen tertentu
                    $('#content').html(data);
                    // Ubah juga URL browser sesuai dengan tautan yang diklik
                    window.history.pushState("", "", url);
                }
            });
        }
    });
});



</script>

<script>
function showFullImage(img) {
    var fullImageUrl = img.src;
    window.open(fullImageUrl, '_blank');
}
</script>


</body>
</html>
