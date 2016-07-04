<?php

/**
 * AyamJago Upload Class
 *
 * @package	Resources
 * @file	Upload.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */
 
class AJ_Upload {
	
	private $extensions;
	
	private $destination;
	
	private $max_size;
	
	private $encrypt_name;
	
	private $prefix;
	
	private $errorMessage;
	
	private $showError;
	
	public function __construct()
	{
		$this->encrypt =& take_class("Encryption",RUN."Resources/");
		$this->config =& take_class("Config");
	}
	
	public function set_upload($config = array())
	{
		if( empty($this->_config))
			$this->_config = $config;
		
		if(count($this->_config) > 0)
		{
			$this->extensions =  isset($this->_config['extensions']) ? $this->_config['extensions'] : '';
			$this->destination = isset($this->_config['destination']) ? $this->_config['destination'] : '';
			$this->max_size = isset($this->_config['max_size']) ? $this->_config['max_size'] : '';
			$this->encrypt_name = isset($this->_config['encrypt_name']) ? $this->_config['encrypt_name'] : '';
			$this->prefix = isset($this->_config['prefix']) ? $this->_config['prefix'] : '';
			$this->max_filename = isset($this->_config['max_filename']) ? $this->_config['max_filename'] : '';
		}
	}
	
	public function do_upload($fileName = '')
	{
		if(!isset($_FILES[$fileName]))
		{
			return NULL;
		}
		
		$this->_is_uploaded_file = $_FILES[$fileName];
		
		$x = explode("|",$this->extensions);
		
		$fileName = $this->_is_uploaded_file['name'];
		$fileSize = $this->_is_uploaded_file['size'];
		$fileType = $this->_is_uploaded_file['type'];
		$fileInfo = pathinfo($this->destination. basename($fileName,PATHINFO_EXTENSION));
		$fileError = $this->_is_uploaded_file['error'];
		$fileTmp = $this->_is_uploaded_file['tmp_name'];
		
		try{
			if( isset($fileInfo['extension']))
			{
				if(!in_array($fileInfo['extension'],$x))
				{
					$this->errorMessage .= $this->config->lang->upload[1].":break:";
				}
			}
			
			if($fileSize > $this->max_size)
			{
				$this->errorMessage .= $this->config->lang->upload[2].":break:";
			}
			
			if( !is_dir($this->destination))
			{
				$this->errorMessage .= $this->config->lang->upload[3].":break:";
			}
			
			if ( $this->_is_filename_length($fileName) >= $this->max_filename)
			{
				$this->errorMessage .= $this->config->lang->upload[11].":break:";
			}
			
			if($fileError > 0)
			{
				switch($this->_is_uploaded_file['error'])
				{
					case UPLOAD_ERR_INI_SIZE:
						$this->errorMessage .= $this->config->lang->upload[4].":break:";
						break;
					case UPLOAD_ERR_FORM_SIZE:
						$this->errorMessage .= $this->config->lang->upload[5].":break:";
						break;
					case UPLOAD_ERR_PARTIAL:
						$this->errorMessage .= $this->config->lang->upload[6].":break:";
						break;
					case UPLOAD_ERR_NO_FILE:
						$this->errorMessage .= $this->config->lang->upload[7].":break:";
						break;
					case UPLOAD_ERR_NO_TMP_DIR:
						$this->errorMessage .= $this->config->lang->upload[8].":break:";
						break;
					case UPLOAD_ERR_CANT_WRITE:
						$this->errorMessage .= $this->config->lang->upload[9].":break:";
						break;
					case UPLOAD_ERR_EXTENSION:
						$this->errorMessage .= $this->config->lang->upload[10].":break:";
						break;
					default:
						$this->errorMessage .= $this->config->lang->upload[7].":break:";
						break;
				}
			}
			
			if(count($this->errorMessage) > 0)
			{
				return false;
			}
			
			$_is_file_upload = $fileName;
			
			if( $this->encrypt_name)
			{
				$_is_file_upload = $this->encrypt->do_hash($_is_file_upload).'.'.$fileInfo['extension'];
			}
			
			$filename_upload = $this->prefix.$_is_file_upload;
			
			return (bool) move_uploaded_file($fileTmp,ROOT_DIR.$this->destination.$filename_upload);
			
		}catch(Exception $e){
			echo $e->getMessage();
			exit;
		}
	}
	
	public function showError()
	{
		$this->showError = explode(":break:",$this->errorMessage);
		
		return $this->showError;
	}
	
	private function _is_filename_length($filename = '')
	{
		if( empty($filename))
		{
			return false;
		}
		
		return (int) strlen(trim($filename));
	}
}