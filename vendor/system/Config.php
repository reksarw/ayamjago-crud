<?php
if(!defined("RUN")) exit; // Keep silent

/**
 * AyamJago Config Class
 *
 * @package	System
 * @file	Config.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */

class AJ_Config {
	
	private
		$protocol;
	
	public
		$_log_is,
		$_log_format;
	
	public function __construct()
	{
		if(!file_exists(APP."config/config.php"))
		{
			exit("File config tidak ditemukan!");
		}
		
		include APP."config/config.php";
		
		$this->config = $config;
		
		$this->_log_is = TRUE;
		$this->_log_format = '['.date("D d-M-Y h.i.s").']';
		
		if(!empty($this->config['base_url']))
			$this->set_config('base_url',$this->config['base_url']);
		else
			if(!isset($_SERVER['REMOTE_ADDR']))
				$this->set_config('base_url','http://localhost');
			else 
			{
				$isBase = $this->protocolHttps();
				$isBase.= $_SERVER['HTTP_HOST'];
				$isBase.= str_replace(INDEX_AJ,"",$_SERVER['SCRIPT_NAME']);
				
				$this->set_config('base_url',$isBase);
			}
		
		$this->lang =& take_class("Language");
		$this->lang->setting($this->config['language']);
		
		$this->timezone();
	}
	
	private function set_config($name,$value)
	{
		$this->$name = $value;
		return $this->$name;
	}
	
	private function protocolHttps()
	{
		if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
			$this->protocol = 'https://';
		} else {
			$this->protocol = 'http://';
		}
		
		return $this->protocol;
	}
	
	public function index_site()
	{
		if(isset($_SERVER['REQUEST_URI']))
		{	
			$index_site = $this->base_url().INDEX_AJ;
			
			return (string) $index_site;
		}
	}
	
	/*
	CONFIG Settings
	*/
	
	public function base_url()
	{
		return (isset($this->base_url)) ? $this->base_url : 'http://localhost/';
	}
	
	public function timezone()
	{
		if( !empty($this->config['timezone']))
			$this->set_config("timezone",$this->config['timezone']);
		else
			$this->set_config("timezone","Asia/Jakarta"); // Default Timezone is.... "Asia/Jakarta"
		
		date_default_timezone_set($this->timezone);
	}
	
	public function MySecretKey()
	{
		$key = $this->config['MySecretKey'];
		
		return $key;
	}
}

/*
 * Location :./vendor/system/Config.php
 */