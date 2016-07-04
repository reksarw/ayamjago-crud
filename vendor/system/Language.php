<?php
if(!defined("RUN")) exit; // Keep silent

/**
 * AyamJago Language Class
 *
 * @package	System
 * @file	Language.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */
 
class AJ_Language {
	
	public function setting($lang = 'id')
	{
		$lang_dir = APP."workspace/language/".$lang;
		
		$scandir = scandir($lang_dir);
		
		foreach($scandir as $file)
		{
			if(file_exists($file))
			{
				continue;
			}
			
			include $lang_dir.'/'.$file;
		}
		
		$this->error_lang = $error_lang;
		$this->file_lang = $file_lang;
		$this->upload = $upload_lang;
		$this->date = $date_lang;
		
		$lang_data = array($this->error_lang,$this->file_lang,$this->upload,$this->date);

		if(count($lang_data) > 0)
		{
			foreach($lang_data as $number => $files)
			{
				foreach($files as $var => $value)
				{
					$this->set_lang($var,$value);
				}
			}
		}
	}
	
	private function set_lang($key , $value)
	{
		if(!isset($this->$key))
		{
			$this->$key = $value;
			return $this->$key = $value;
		}
	}
}

/*
 * Location :./vendor/system/Language.php
 */