<?php
if(!defined("RUN")) exit; // Keep silent
/**
 * AyamJago Framework stand for
 *
 * a Simple MVC for Web Developer
 * Basic from CodeIgniter Framework
 * Open Source Application development framework for PHP
 * 
 * Build with Heart <3
 * Made in Malang , Jawa Timur , Indonesia.
 *  
 * @package AyamJago
 * @file	AyamJago.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 *
 * Copyright (c) 2016, AyamJago Framework. Bocah SMKN 4 Malang
 *
 */
 
if(!function_exists('base_url'))
{
	/**
	 * Base URL for this AyamJago Framework Location
	 * 
	 * @param 	string
	 * @return 	string 	as location ayamjago framework
	 */
	function base_url($uri = '')
	{
		if(!isset($CFG))
			$CFG =& take_class("Config");
		
		$base = $CFG->base_url();
		
		if(empty($uri))
			return (string) $base;
		return (string) $base.$uri;
	}
}

if(!function_exists('redirect'))
{
	/**
	 * Redirect function
	 *
	 * @param 	string
	 * @param 	integer	as Http Respone status code
	 * @return 	void
	 */
	
	function redirect($location = '')
	{
		if(!isset($CFG))
			$CFG =& take_class("Config");
		
		if(substr($location,0,4) == "http" || substr($location,0,5) == "https")
		{
			header("Location:".$location , TRUE , 200);
			exit;
		}
		
		if($location != '')
		{
			header("Location: ".$CFG->base_url.$location , TRUE , 302);
			exit;
		}
		
		header("Location: ".$CFG->base_url , TRUE , 302);
		exit;
	}
}

if(!function_exists('index_site'))
{
	/**
	 * Index Site Function
	 *
	 * @return 	void as Index File AyamJago like : http://example.com/index.php
	 */
	 
	function index_site()
	{
		if(!isset($CFG))
			$CFG =& take_class("Config");
		
		if($CFG->index_site())
			return $CFG->index_site();
		exit("index_site method tidak ditemukan pada Config Class");
	}
}