<?php
if(!defined("RUN")) exit; // Keep silent

/**
 * AyamJago Controller Class
 *
 * @package	System
 * @file	Controller.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */

class AJ_Controller {
	
	public function __construct()
	{
		$this->uri =& take_class("URI");
		$this->config =& take_class("Config");
		$this->error =& take_class("Handler");
		
		if(!file_exists(APP."config/autoload.php"))
		{
			$this->error->show_404($this->config->lang->autoload_header,$this->config->lang->autoload_content);
			exit;
		}
		
		include APP."config/autoload.php";
		
		if(!is_array($autoload) or (!isset($autoload)))
		{
			$this->error->show_404($this->config->lang->autoload_header,$this->config->lang->autoload_array);
			exit;
		}
		
		foreach(array('mines','resources') as $is_autoload)
		{
			if(isset($autoload[$is_autoload]) or count($autoload[$is_autoload]) > 0)
			{
				$isLoad = strtolower($is_autoload);
				$this->$isLoad($autoload[$is_autoload]);
			}
		}
	}
	
	public function view($fileName,$data = array())
	{
		$this->data = !empty($data) ? extract($data) : '';
		
		if(!file_exists(APP."views/".$fileName.".php"))
		{
			$this->error->show_404($this->config->lang->view_header,$this->config->lang->view_content);
			exit;
		}
		
		include APP."views/".$fileName.".php";
		return $this->data;
	}
	
	public function model($modelName)
	{
		if(class_exists($modelName))
		{
			return $modelName;
		}
		
		if(!file_exists(APP."models/".$modelName.".php"))
		{
			$this->error->show_404($this->config->lang->model_header,$this->config->lang->model_content);
			exit;
		}
		
		include APP."models/".$modelName.".php";
		
		$isModel = strtolower($modelName);
		
		$this->$isModel = new $modelName();
	}
	
	public function resources($resource = array())
	{
		if(empty($resource) || !is_array($resource))
		{
			return $resource;
		}
		
		if(count($resource) > 0)
		{
			$dir = RUN."resources/";
			$prefiks = "AJ_";
			
			foreach($resource as $nums => $value)
			{
				$value = ucwords($value);

				if(!file_exists($dir.$value.".php"))
				{
					$this->error->show_404($this->config->lang->resource_header,$this->config->lang->resource_content);
					exit;
				}
				
				if(!class_exists($value))
					include_once $dir.$value.".php";
					$isObj = strtolower($value);
					$isName = $prefiks.ucwords($value);
					$this->$isObj = new $isName();
			}
		}
	}
	
	public function mines($mineFiles = array())
	{
		if(empty($mineFiles) || !is_array($mineFiles))
		{
			return $mineFiles;
		}
		
		if(count($mineFiles) > 0)
		{
			$dir = RUN."mines/";
			
			foreach($mineFiles as $nums => $mine)
			{
				$isMine = ucwords($mine);
				
				if(!file_exists($dir.$isMine.".php"))
				{
					$this->error->show_404($this->config->lang->mine_header,$this->config->lang->mine_content);
					exit;
				}
				
				include($dir.$isMine.".php");
			}
		}
	}
	
	final public function database()
	{
		$this->db =& take_class("Database");
		
		if(isset($this->db))
		{
			return $this;
		}
		
		if(!class_exists('AJ_Database'))
		{
			return $this;
		}
	}
}

/*
 * Location :./vendor/system/Controller.php
 */