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
	<style>a , a:hover , a:active { text-decoration:none; color:black; } </style>
	
</head>

<body>
	
	<div class="container">
		<h1>CRUD Biodata</h1>
		<a href="<?= base_url()."home/tambah" ?>"><span class="fa fa-plus"></span> Tambah Biodata</a>
		<?php
		if($rows > 0)
		{
		?>
		<table class="table table-hover">
		<tr>
			<th>No</th>
			<th>Nama Lengkap</th>
			<th>Nama Panggilan</th>
			<th>Jenis Kelamin</th>
			<th>Tempat Lahir</th>
			<th>Tanggal Lahir</th>
			<th>Alamat</th>
			<th>Cita-Cita</th>
			<th>Hobi</th>
			<th colspan="3" style='text-align:center'>Aksi</th>
		</tr>
		
		<?php
		$no = 1;
		foreach($get_biodata as $data){
		?>
		<tr>
			<td><?= $no++; ?></td>
			<td><?= $data->nama_lengkap ?></td>
			<td><?= $data->nama_panggilan ?></td>
			<td><?= ( strtolower($data->jenis_kelamin) == 'l') ? 'Laki-Laki' : 'Perempuan' ?></td>
			<td><?= $data->tempat_lahir ?></td>
			<td><?= $data->tanggal_lahir ?></td>
			<td><?= $data->alamat ?></td>
			<td><?= $data->cita_cita ?></td>
			<td><?= $data->hobi ?></td>
			<td><a href="<?= base_url()."home/lihat/".$data->biodata_id ?>">LIHAT</a></td>
			<td><a href="<?= base_url()."home/ubah/".$data->biodata_id ?>">EDIT</a></td>
			<td><a href="<?= base_url()."home/hapus/".$data->biodata_id ?>">HAPUS</a></td>
		</tr>
		<?php 
		} 
		?>
		</table>
		<?php
		}else
		{
		echo '<br/><H3>Biodata masih kosong</H3>';
		}
		?>
	</div>
</body>
</html>