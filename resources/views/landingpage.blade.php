<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pelayanan Surat Desa Online Kabupaten Jember</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/asset/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/asset/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

  <!-- Custom CSS for navbar -->
  <style>
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }
    .content-wrapper {
      margin-top: 56px; /* Sesuaikan dengan tinggi navbar Anda */
    }
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="/asset/images/jember.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-bold text-primary animate__animated animate__fadeInUp">PEMERINTAH KABUPATEN JEMBER</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <!-- <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Contact</a>
          </li>
        </ul> -->

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
            <a href="#" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a href="#services" class="nav-link">About</a>
        </li>
        <li class="nav-item">
            <a href="#contacts" class="nav-link">Contact</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section id="" style="background-image: url('/asset/images/cta2-bg.jpg'); background-size: cover; background-position: center; padding: 150px 0;">
    <div class="container">
        <div class="text-center">
            <h2 class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="0ms" style="font-weight: bold; font-size: 48px;"><span style="color: var(--primary);">PELAYANAN ADMINISTRASI</span> <span style="color: white;">DESA <br> KABUPATEN JEMBER</span></h2>
            <p class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="100ms" style="color: white; font-size: 20px;">KLIK LOGIN UNTUK MASUK SEBAGAI ADMIN DESA</p>
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="200ms">
                        <!-- Button trigger modal -->
                        <a href="/login" type="submit" class="btn btn-primary">Login</a>
                        <a href="/register" type="submit" class="btn btn-primary">Daftar</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</section>


    <section id="services" class="content" style="padding: 80px 0;margin-left: 20px; margin-right: 20px;">
    <div class="container-fluid">
        <h2 class="text-center mb-4 animate__animated animate__fadeInUp" style="font-weight: bold; font-size: 36px;">ABOUT ADMIN DESA</h2>

        <div class="row">
            <!-- Prosedur Admin Desa -->
            <div class="col-md-6">
                <div class="card card-primary h-100">
                    <div class="card-header text-center" style="font-size: 1.25rem; font-weight: bold; background-color: #007bff; color: #fff;">
                        Prosedur Admin Desa
                    </div>
                    <div class="card-body" style="background-color: #f8f9fa;">
                        <ol>
                            <li><strong>Login:</strong> Admin desa melakukan login, melalui halaman login. Jika belum mempunyai akun bisa daftar kepada admin pemkab.</li>
                            <li><strong>Konfirmasi Permohonan:</strong> Admin desa melakukan konfirmasi pada permohonan surat yang diajukan oleh masyarakat melalui halaman dashboard yang didalamnya terdapat informasi surat yang diajukan masyarakat. Kemudian klik tombol konfirmasi, admin desa dapat mengecek data permohonan surat yang diajukan, jika data benar admin desa dapat menyetujui permohonan, namun jika salah admin desa dapat mengirim catatan pada masyarakat.</li>
                            <li><strong>Cetak surat:</strong> Surat yang telah disetujui oleh admin desa dapat dicetak, melalui tombol cetak surat pada halaman permohonan. Kemudian admin desa dapat memilih data pejabat untuk tanda tangan pada surat dan memilih tanggal surat untuk dicetak.</li>
                            <li><strong>Permohonan selesai:</strong> Surat yang telah selesai dicetak, masuk pada halaman laporan.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->

            <!-- Fitur -->
            <div class="col-md-6">
                <div class="card card-primary h-100">
                    <div class="card-header text-center" style="font-size: 1.25rem; font-weight: bold; background-color: #007bff; color: #fff;">
                        Fitur
                    </div>
                    <div class="card-body" style="background-color: #f8f9fa;">
                        <ol>
                            <li><strong>Login:</strong> Admin desa melakukan login, melalui halaman login. Jika belum mempunyai akun bisa daftar kepada admin pemkab.</li>
                            <li><strong>Dashboard:</strong> Halaman dashboard berisi surat yang dapat diajukan dan informasi pengajuan surat yang diajukan oleh masyarakat.</li>
                            <li><strong>Data Masyarakat:</strong> Admin desa dapat mengelola data masyarakat yang sesuai dengan desanya baik menambah, mengedit ataupun menghapus.</li>
                            <li><strong>Laporan:</strong> Admin desa dapat melihat laporan data surat yang diajukan masyarakat dan bisa mencetak laporan tersebut.</li>
                            <li><strong>Pengaturan:</strong>
                                <ul>
                                    <li><strong>Data pejabat:</strong> Admin desa dapat mengelola data pejabat di desanya.</li>
                                    <li><strong>Biodata admin desa:</strong> Admin desa dapat mengelola biodata admin desa.</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>



    <!--/#services-->
    <section id="contacts" class="content" style="padding: 80px 0;margin-left: 20px; margin-right: 20px;">
    <div class="container">
        <h2 class="text-center mb-4 animate__animated animate__fadeInUp" style="font-weight: bold; font-size: 36px;">CONTACTS</h2>
        <div class="row">
            <!-- Person 1 -->
            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                <div class="card bg-gradient-gray-dark d-flex flex-fill">
                    <div class="card-header text-white border-bottom-0">
                        Developer
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead text-white"><b>Wira</b></h2>
                                <p class="text-white text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                <ul class="ml-4 mb-0 fa-ul text-white">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: +800 - 12 12 23 52</li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <img src="/asset/dist/img/avatar5.png" alt="user-avatar" class="img-circle img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                <div class="card bg-gradient-gray-dark d-flex flex-fill">
                    <div class="card-header text-white border-bottom-0">
                        Developer
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead text-white"><b>Ilham</b></h2>
                                <p class="text-white text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                <ul class="ml-4 mb-0 fa-ul text-white">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: +800 - 12 12 23 52</li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <img src="/asset/dist/img/avatar5.png" alt="user-avatar" class="img-circle img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                <div class="card bg-gradient-gray-dark d-flex flex-fill">
                    <div class="card-header text-white border-bottom-0">
                        Developer
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead text-white"><b>Risma</b></h2>
                                <p class="text-white text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                <ul class="ml-4 mb-0 fa-ul text-white">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: +800 - 12 12 23 52</li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <img src="/asset/dist/img/avatar2.png" alt="user-avatar" class="img-circle img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                <div class="card bg-gradient-gray-dark d-flex flex-fill">
                    <div class="card-header text-white border-bottom-0">
                        Developer
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead text-white"><b>Nofa</b></h2>
                                <p class="text-white text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                <ul class="ml-4 mb-0 fa-ul text-white">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: +800 - 12 12 23 52</li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <img src="/asset/dist/img/avatar2.png" alt="user-avatar" class="img-circle img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/asset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/asset/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/asset/dist/js/demo.js"></script>
</body>
</html>