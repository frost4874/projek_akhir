<!DOCTYPE html>
<html>
<head>
	<title>Laporan Desa</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
 
	<div class="container">
 
    <center>
		<h5>Laporan Pelayanan Surat Desa</h4>
		<h6>www.surat_desa.com</h5>
	</center>
 
				<table class="table table-bordered">
					<thead>
						<tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal ACC</th>
                        <th scope="col">Nik</th>
						<th scope="col">Nama</th>
						<th scope="col">Permohonan</th>
						</tr>
					</thead>
					<tbody>
                    @foreach($requests as $index => $request)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $request->tanggal_request }}</td>
                                            <td>{{ $request->nik }}</td>
                                            <td>{{ $request->id_berkas }}</td>
                                            <td>
                                                @if($request->status == 0)
                                                Pending
                                                @elseif($request->status == 1)
                                                Telah di ACC
                                                @elseif($request->status == 2)
                                                Sudah di print
                                                @elseif($request->status == 3)
                                                Selesai
                                                @else
                                                Status tidak valid
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
    <script>
		window.print();
	</script>
</body>
</html>