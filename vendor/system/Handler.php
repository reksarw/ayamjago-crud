<?php
if(!defined("RUN")) exit; // Keep silent

/**
 * AyamJago Handler Class
 *
 * @package	System
 * @file	Handler.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */
 
class AJ_Handler {
	
	private $errHeader;
	
	private $errContent;
	
	public function __construct()
	{
		$this->_config_class =& take_class("Config");
		$this->_useragent_class =& take_class("User_agent",RUN."resources/");
	}
	
	public function show_404($msgHeader = '', $msgContent = '')
	{
		$this->_log_message = 'Halaman tidak ditemukan'.PHP_EOL;
		$this->_log_message.= "IP : ".$_SERVER['REMOTE_ADDR'].PHP_EOL;
		$this->_log_message.= "Browser : ".$this->_useragent_class->browser().PHP_EOL;
		$this->_log_message.= "Platform : ".$this->_useragent_class->platform().PHP_EOL;
		$this->_log_message.= "User Agent : ".$this->_useragent_class->print_ua().PHP_EOL;
		$this->errHeader = empty($msgHeader) ? $this->_config_class->lang->error_lang['header_404'] : $msgHeader;
		$this->errContent = empty($msgContent) ? $this->_config_class->lang->error_lang['content_404'] : $msgContent;
		
		if( !file_exists(APP."views/errors/error_404.php"))
		{
			echo 'File 404 handler not found please check again.';
			exit;
		}
		
		if ( ! is_dir(APP."logs/"))
		{
			mkdir(APP."logs/");
			chmod(APP."logs/",0777);
		}
		
		if ( !is_writable(APP.'logs'))
		{
			$change_perm = chmod(APP."logs",0777);
			
			if(!$change_perm)
			{
				echo "Please check permission folder logs";
				exit;
			}
		}
		
		include APP."views/errors/error_404.php";
		
		if ( $this->_config_class->_log_is)
		{
			$_log_file_created = fopen(APP."logs/".$this->_config_class->_log_format.".txt" , "w");
			
			if( ! $_log_file_created)
			{
				exit('Unable to open file!');
			}
			
			fwrite( $_log_file_created , $this->_log_message);
			fclose( $_log_file_created);
		}
		
		exit;
	}
	
	public function show_error($heading = '', $content = '', $logs , $templates = 'error_db')
	{
		$this->_log_message = $heading.PHP_EOL;
		$this->_log_message.= $logs;
		$this->errorHeader = ( strlen($heading) > 0 ) ? $heading : $this->_config_class->lang->error_lang['header_error'];
		$this->errorContent = ( strlen($content) > 0 ) ? $content : $this->_config_class->lang->error_lang['content_error'];
		
		if ( ! file_exists(APP."views/errors/".$templates.".php"))
		{
			echo $templates.".php not found!";
			exit;
		}
		
		if ( ! is_dir(APP."logs/"))
		{
			mkdir(APP."logs/");
			chmod(APP."logs/",0777);
		}
		
		if ( !is_writable(APP.'logs'))
		{
			$change_perm = chmod(APP."logs",0777);
			
			if(!$change_perm)
			{
				echo "Please check permission folder logs";
				exit;
			}
		}
		
		include APP."views/errors/{$templates}.php";
		
		if ( $this->_config_class->_log_is)
		{
			$_log_file_created = fopen(APP."logs/".$this->_config_class->_log_format.".txt" , "w");
			
			if( ! $_log_file_created)
			{
				exit('Unable to open file!');
			}
			
			fwrite( $_log_file_created , $this->_log_message);
			fclose( $_log_file_created);
		}
		
		exit;
	}
}

/*
 * Location :./vendor/system/Handler.php
 */