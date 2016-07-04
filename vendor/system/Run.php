<?php
if(!defined("RUN")) exit; // Keep silent

/**
 * AyamJago Run Class ( URL ROUTING and MVC Control )
 *
 * @package	System
 * @file	Run.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */
 
class AJ_Run {
	
	private $extension = ".php";	
	
	private $ws_class_dir = APP."workspace/classes/";
	
	private $ws_func_dir = APP."workspace/functions/";
	
	public function __construct()
	{
		$this->uri =& take_class("URI");
		$this->config =& take_class("Config");
		$this->errno =& take_class("Handler");
		
		foreach(scandir($this->ws_func_dir) as $ws_func)
		{
			if(!str_replace(array(".","..") , "",$ws_func))
				continue;
			
			include $this->ws_func_dir.$ws_func;
		}
		
		foreach(scandir($this->ws_class_dir) as $ws_class)
		{
			if(!str_replace(array(".","..") , "",$ws_class))
				continue;
			
			include $this->ws_class_dir.$ws_class;
		}
	}
	
	public function AyamJago($e = TRUE)
	{
		if($e == TRUE || $e == true)
			error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
		elseif($e == FALSE || $e == false)
			error_reporting(0);
			
		if(!file_exists(APP."config/routes.php"))
		{
			$this->errno->show_404($this->config->lang->routes_header,$this->config->lang->routes_content);
			exit;
		}
		
		include APP."config/routes.php";
		
		$controller = $this->uri->segment(1);
		$method = $this->uri->segment(2);
		
		if (empty($controller)) {
			$controller = $route['default_controller'];
		}

		if (empty($method)) {
			$method = "index";
		}
		
		if(!empty($_SERVER['PATH_INFO']))
		{
			if(empty($route[$_SERVER['PATH_INFO']]))
			{
				$countRoute = strlen($_SERVER['PATH_INFO']);
				if(substr($_SERVER['PATH_INFO'],$countRoute - 1,$countRoute) == '/')
				{
					$_SERVER['PATH_INFO'] = substr($_SERVER['PATH_INFO'],0,$countRoute-1);
					$countRoute = $countRoute - 1;
				}
			}
			
			$routeParam = substr($_SERVER['PATH_INFO'], 1, $countRoute);
			if (!empty($route[$routeParam]))
			{
				$uri = $route[$routeParam];
				$pecah = explode('/', $uri); 
				$count = count($pecah); 
					for ($i=0; $i <= $count ; $i++)
						array_key_exists($i, $pecah);
				$controller = $pecah[0];
				$method = $pecah[1];
			}
		}
				
		if(!file_exists(APP."controllers/".$controller.$this->extension))
		{
			$this->errno->show_404($this->config->lang->header_404,$this->config->lang->content_404);
			exit;
		}

		require APP."controllers/".$controller.$this->extension;
		
		if(!class_exists($controller))
		{
			$this->errno->show_404($this->config->lang->header_404,$this->config->lang->content_404);
			exit;
		}
		
		if(!method_exists($controller,$method))
		{
			$this->errno->show_404($this->config->lang->header_404,$this->config->lang->content_404);
			exit;
		}
		
		$controller = new $controller();
		$controller->$method();
	}
}

/*
 * Location :./vendor/system/Run.php
 */