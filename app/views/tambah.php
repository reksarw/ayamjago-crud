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
		<h1>Tambah Data</h1>
		<?php
			if( @$_SESSION['error_form'])
			{
				echo $_SESSION['error_form'];
				unset($_SESSION['error_form']);
			}
		?>
		<form method="post" action="<?= base_url()."home/do_add";?>">
			<div class="form-group">
				<label class="label-control">Nama Lengkap</label>
				<input type="text" class="form-control" autocomplete="off" placeholder="Nama Lengkap" name="nama_lengkap"/>
			</div>
			
			<div class="form-group">
				<label class="label-control">Nama Panggilan</label>
				<input type="text" class="form-control" autocomplete="off" placeholder="Nama Panggilan" name="nama_panggilan"/>
			</div>
			
			<div class="form-group">
				<label class="label-control">Jenis Kelamin</label>
				<div class="radio">
				  <label>
					<input type="radio" name="jenis_kelamin" value="L" checked>
					Laki-Laki
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="jenis_kelamin" value="P">
					Perempuan
				  </label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="label-control">Tempat Lahir</label>
				<input type="text" class="form-control" autocomplete="off" placeholder="Tempat Lahir" name="tempat_lahir"/>
			</div>
			
			<div class="form-group">
				<label class="label-control">Tanggal Lahir</label>
				<input type="text" class="form-control" autocomplete="off" placeholder="YYYY-mm-dd" name="tanggal_lahir"/>
			</div>
			
			<div class="form-group">
				<label class="label-control">Alamat</label>
				<input type="text" class="form-control" autocomplete="off" placeholder="Alamat Lengkap" name="alamat"/>
			</div>
			
			<div class="form-group">
				<label class="label-control">Cita Cita</label>
				<input type="text" class="form-control" autocomplete="off" placeholder="Cita Cita" name="cita_cita"/>
			</div>
			
			<div class="form-group">
				<label class="label-control">Hobi</label>
				<input type="text" class="form-control" autocomplete="off" placeholder="Hobi" name="hobi"/>
			</div>
			
			<div class="form-group">
				<button class="btn btn-info" type="submit"><span class="fa fa-plus"></span>&nbsp;tambah</button>
				<a href="<?= base_url()?>"><button class="btn btn-info" type="button"><span class="fa fa-chevron-left"></span>&nbsp;kembali</button></a>
			</div>
		</form>
	</div>
</body>
</html>