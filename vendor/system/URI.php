<?php
if(!defined("RUN")) exit; // Keep silent

/**
 * AyamJago URI Routing Class
 *
 * @package	System
 * @file	URI.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */

class AJ_URI {
	
	static $segments = array();
	
	private $uri;
	
	public function __construct()
	{
		if( !empty($_SERVER['PATH_INFO']))
		{
			$this->uri = $_SERVER['PATH_INFO'];
            self::$segments =  explode('/', $this->uri);
		}
	}
	
	public function segment($index)
	{
		if(!array_key_exists($index,self::$segments))
			return false;
		
		return self::$segments[$index];
	}
}

/*
 * Location :./vendor/system/URI.php
 */