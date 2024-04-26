@extends('layouts.app')
@php
    $title = 'Berkas Permohonan';
@endphp
@section('title', 'Berkas Permohonan')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cetak Surat</h1>
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
          <!-- <div class="card-header">

              <div class="float-right">
                  
              </div>
          </div> -->
          <div class="card-body">
          <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2"></th>
                                </tr>
                                <tr>
                                <th>&emsp;&emsp;&emsp;&emsp;<img src="img/kabmalang.png" width="90" height="107" alt=""></th>
                                <th><center>
                                    
                                                        <font size="4">PEMERINTAHAN KABUPATEN MALANG</font><br>
                                                        <font size="4">KECAMATAN <?php echo strtoupper($data2['nm_kec']); ?> </font><br>
                                                        <font size="5"><b>DESA <?php echo strtoupper($data2['nm_desa']); ?> </b></font><br>
                                                        <font size="3"><i><?php echo $alamat2 ?></i></font><br><br>
                                                    </center></th>
                                </tr>
                                <tr>
                                    <th colspan="2"><hr style="margin:0px" color="black"></th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                    <center> <br><br>
                                                        <h3><b>SURAT KETERANGAN / PENGANTAR</b></h3>
                                                        
                                                        <span>Nomor : <?php echo $id_berkas; ?> / <?php echo $no_urut; ?> / <?php echo $kode_belakang; ?> </span>
                                                    </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <?php
                                        $konten = '';
                                        for($i=0;$i<count($array_delimiter);$i++){
                                            if($i==0){
                                                $konten = str_replace($array_delimiter[$i],$array_value[$i],$template);
                                            }else{
                                                $konten = str_replace($array_delimiter[$i],$array_value[$i],$konten);
                                            }
                                        }
                                        for($j=0;$j<count($array_delimiter2);$j++){
                                            $konten = str_replace($array_delimiter2[$j],$array_value2[$j],$konten);
                                        
                                        }
                                        echo $konten;
                                        ?>
                                        <?php
                                        // $konten2 = '';
                                        //  for($j=0;$j<count($array_delimiter2);$j++){
                                        //      if($j==0){
                                        //          $konten2 = str_replace($array_delimiter2[$j],$array_value2[$j],$template);
                                        //      }else{
                                        //          $konten2 = str_replace($array_delimiter2[$j],$array_value2[$j],$konten2);
                                        //      }
                                        //  }
                                        //  echo $konten2;
                                        ?>
                                    </th>
                                </tr>
                                <tr font="Times New Roman">
                                    <th></th>
                                    <th>Malang, <?php echo tgl_indo($tgl_acc) ?><br>
                                        <?php 
                                        if($jabatan=='Kepala'){
                                            echo $jabatan.' Desa';
                                        } else {
                                            echo 'an. Kepala Desa<br>'.$jabatan;
                                        }
                                        ?> <br><br><br><br><?php echo $nm_pejabat ?></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
    
@endsection