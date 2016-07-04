<?php
defined('RUN') or exit;

class Home extends AJ_Controller {
	
	function __construct(){
		parent::__construct();
		$this->model('crud');
		$this->mines(array('url'));
		$this->resources(array('validation','session'));
	}
	
	function index(){
		$data['title'] = "CRUD Biodata";
		$data['get_biodata'] = $this->crud->getAllBiodata();
		$data['rows'] = $this->crud->getRows('biodata');
		$this->view('home',$data);
	}
	
	function tambah(){
		$data['title'] = "Tambah Data";
		
		$this->view("tambah",$data);
	}
	
	function lihat(){
		$biodata_id = $this->uri->segment(3);
		
		if ( empty($biodata_id) || $this->crud->getBiodata($biodata_id) == FALSE)
		{
			redirect();
		}
		
		$query = $this->crud->getBiodata($biodata_id);
		
		$lihat['title'] = "Lihat - ".$query['nama_lengkap'];
		$lihat['data'] = $query;
		$this->view('lihat',$lihat);
	}
	
	function ubah(){
		$biodata_id = $this->uri->segment(3);
		
		if ( empty($biodata_id) || $this->crud->getBiodata($biodata_id) == FALSE)
		{
			redirect();
		}
		
		$query = $this->crud->getBiodata($biodata_id);
		
		$data['title'] = "Ubah - ".$query['nama_lengkap'];
		$data['ubah'] = $query;
		$this->view('ubah',$data);
	}
	
	function hapus(){
		$biodata_id = $this->uri->segment(3);
		
		if ( empty($biodata_id) || $this->crud->getBiodata($biodata_id) == FALSE)
		{
			redirect();
		}
		
		$query = $this->crud->deleteBiodata($biodata_id);
		
		if ( $query )
		{
			redirect();
		}
	}
	
	function do_add(){
		if(!$_POST)
		{
			redirect();
		}
		
		$error = '';
		
		$nama_lengkap = ( isNull($_POST['nama_lengkap'])) ? $error .= "Nama Lengkap harus diisi\n" : $_POST['nama_lengkap'];
		$nama_panggilan = ( isNull($_POST['nama_panggilan'])) ? $error .= "Nama Panggilan harus diisi\n" : $_POST['nama_panggilan'];
		$jenis_kelamin = ( $_POST['jenis_kelamin'] == "L") ? "L" : "P";
		$tempat_lahir = ( isNull($_POST['tempat_lahir'])) ? $error .= "Tempat lahir harus diisi\n" : $_POST['tempat_lahir'];
		$tanggal_lahir = ( isTanggalLahir($_POST['tanggal_lahir'])) ? $_POST['tanggal_lahir'] : $error .= "Format tanggal lahir salah\n";
		$alamat = ( isNull($_POST['alamat'])) ? $error .= "Alamat harus diisi\n" : $_POST['alamat'];
		$cita = ( isNull($_POST['cita_cita'])) ? $error .= "Cita-cita harus diisi\n" : $_POST['cita_cita'];		
		$hobi = ( isNull($_POST['hobi'])) ? $error .= "Hobi harus diisi\n" : $_POST['hobi'];
	
		if ( ! empty($error))
		{
			$error = str_replace("\n","<BR>",$error);
			$this->session->set('error_form',$error);
			redirect('home/tambah');
			exit;
		}
		
		$query = $this->crud->insertBiodata($nama_lengkap,$nama_panggilan,$jenis_kelamin,$tempat_lahir,$tanggal_lahir,$alamat,$cita,$hobi);
		
		if ( $query)
		{
			redirect();
			exit;
		}
		
		echo "Gagal";
	}
	
	function do_update(){
		if( ! $_POST)
		{
			redirect();
		}
		
		$error = '';
		$data = $this->crud->getBiodata($_POST['bid']);
		
		$nama_lengkap = ( isNull($_POST['nama_lengkap'])) ? $data['nama_lengkap'] : $_POST['nama_lengkap'];
		$nama_panggilan = ( isNull($_POST['nama_panggilan'])) ?  $data['nama_panggilan'] : $_POST['nama_panggilan'];
		$jenis_kelamin = ( $_POST['jenis_kelamin'] == "L") ? "L" : "P";
		$tempat_lahir = ( isNull($_POST['tempat_lahir'])) ?  $data['tempat_lahir'] : $_POST['tempat_lahir'];
		if ( isNull($_POST['tanggal_lahir']))
		{
			$tanggal_lahir = $data['tanggal_lahir'];
		}
		else
		{
			$tanggal_lahir = ( isTanggalLahir($_POST['tanggal_lahir'])) ? $_POST['tanggal_lahir'] : $error .= "Format tanggal lahir salah\n";
		}
		$alamat = ( isNull($_POST['alamat'])) ? $data['alamat'] : $_POST['alamat'];
		$cita = ( isNull($_POST['cita_cita'])) ? $data['cita_cita'] : $_POST['cita_cita'];		
		$hobi = ( isNull($_POST['hobi'])) ?  $data['hobi'] : $_POST['hobi'];
		
		if ( ! empty($error))
		{
			$error = str_replace("\n","<BR>",$error);
			$this->session->set('error_form',$error);
			redirect('home/tambah');
			exit;
		}
		
		$edit = $this->crud->updateBiodata($_POST['bid'],$nama_lengkap,$nama_panggilan,$jenis_kelamin,$tempat_lahir,$tanggal_lahir,$alamat,$cita,$hobi);
		
		if($edit)
		{
			redirect();
		}
		
		echo "Gagal";
	}
}