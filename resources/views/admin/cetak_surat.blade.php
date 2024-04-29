@php
    if (!function_exists('tgl_indo')) {
        // Jika belum, definisikan fungsi tgl_indo()
        function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // Pastikan array $pecahkan memiliki indeks yang diharapkan sebelum mencoba mengaksesnya
    if (isset($pecahkan[2]) && isset($bulan[(int)$pecahkan[1]])) {
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    } else {
        // Handle jika indeks tidak ditemukan
        return "Format tanggal tidak valid";
    }
}

    }
@endphp

<!DOCTYPE html>
<html>
<head>
	<title>Cetak Surat</title>
</head>
<body>
<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
 
	<div class="container">
 
				<table class="table table-bordered">
                <tr>
                                        <th colspan="2"></th>
                                        <br>
                                    </tr>
                                    <tr>
                                        <th style="padding-right: 10px; vertical-align: top; height: 120px;">
                                            &emsp;&emsp;&emsp;&emsp;<img src="/asset/images/jember.png" width="100" height="100" alt="">
                                        </th>
                                        <th style="padding-left: 10px; font-family: 'Times New Roman', Times, serif; vertical-align: top; height: 120px; line-height: 1.15;padding-right: 80px;">
                                            <center>
                                                <font size="4" style="font-weight: bold;">PEMERINTAHAN KABUPATEN JEMBER</font><br>
                                                <font size="4" style="font-weight: bold;">KECAMATAN {{ strtoupper($data['nm_kec']) }} </font><br>
                                                <font size="5" style="font-weight: bold;"><b>DESA {{ strtoupper($data['nm_desa']) }} </b></font><br>
                                                <font size="3" style="font-weight: bold;"><i>{{ $data['alamatdesa'] }}</i></font><br>
                                            </center>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding: 0 10px; width: 100%;">
                                            <hr color="black" style="border: 0; height: 2px; background-color: black; margin: 0;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="text-align: center; font-family: 'Times New Roman', Times, serif; ">
                                            <br>
                                            <h4 style="text-decoration: underline; line-height: 1.15;"><b>{{ strtoupper($data['judul_berkas']) }}</b></h4>
                                            <span style=" line-height: 1.15;">Nomor : {{ $data['id_berkas'] }} / {{ $data['no_urut'] }} / {{ $data['kode_belakang'] }}</span>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="2" style="font-family: 'Times New Roman', Times, serif; padding: 20px;">
                                        {!! $data['template'] !!}
                                    
                                        
                                        </th>
                                    </tr>
                                    <tr >
                                        <th></th>
                                        <th style="font-family: 'Times New Roman', Times, serif; float:right; padding-right: 40px;">
                                        <div style="margin-left: auto;">
                                            Jember, {{ tgl_indo($data['tgl_acc']) }}
                                            @if($data['jabatan'] == 'Kepala')
                                                {{ $data['jabatan'].' Desa' }}
                                            @else
                                                {!! '<br>'.$data['jabatan'] !!}
                                            @endif
                                            <br><br><br>{{ $data['nm_pejabat'] }}
                                        </div>
                                        </th>
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
    <script>
		window.print();
	</script>
</body>
</html>