<?php defined('RUN') or exit; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<title><?php echo $title; ?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" />
	<style>a , ahover , aactive { text-decorationnone; colorblack; } </style>
	
</head>

<body>
	
	<div class="container">
		<h3>Lihat biodata  <?= $data['nama_lengkap']; ?></h3>
		<table class="table table-striped">
			<tr>
				<td width="15%">Nama Lengkap</td>
				<td><?= $data['nama_lengkap']; ?></td>
			</tr>
			
			<tr>
				<td>Nama Panggilan</td>
				<td><?= $data['nama_panggilan']; ?></td>
			</tr>
			
			<tr>
				<td>Jenis Kelamin</td>
				<td><?= ( strtolower($data['jenis_kelamin']) == 'l') ? 'Laki-laki' : 'Perempuan' ; ?></td>
			</tr>
			
			<tr>
				<td>Tempat Lahir</td>
				<td><?= $data['tempat_lahir']; ?></td>
			</tr>
			
			<tr>
				<td>Tanggal Lahir</td>
				<td><?= $data['tanggal_lahir']; ?></td>
			</tr>
			
			<tr>
				<td>Alamat</td>
				<td><?= $data['alamat']; ?></td>
			</tr>
			
			<tr>
				<td>Cita-cita</td>
				<td><?= $data['cita_cita']; ?></td>
			</tr>
			
			<tr>
				<td>Hobi</td>
				<td><?= $data['hobi']; ?></td>
			</tr>
		</table>
		
		<a href="<?= base_url()?>"><button class="btn btn-info" type="button"><span class="fa fa-chevron-left"></span>&nbsp;kembali</button></a>
	</div>
</body>
</html>