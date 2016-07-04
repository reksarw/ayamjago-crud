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
 
if(!function_exists('view_link'))
{
	/**
	 * View Link HTML function
	 *
	 * @param	string
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	mixed
	 */
	 
	function view_link($string , $link , $target = '',$attr = '')
	{
		$target = empty($target) ? '' : "target = '".$target."'";
		$attr = empty($attr) ? '' : $attr;
		
		return "<a href=".$link." {$target} {$attr} />".$string."</a>";
	}
}

if(!function_exists('heading'))
{
	/**
	 * Alternative Heading HTML tags
	 *
	 * @param	string
	 * @param	integer
	 * @param	string
	 * @return 	mixed
	 */
	 
	function heading($string,$heading = 1,$attr = '')
	{
		$string = empty($string) ? '' : $string;
		$attr = empty($attr) ? '' : $attr;
		
		switch($heading)
		{
			case 1:
				$heading_open = "<h1 $attr>";
				$heading_close = "</h1>";
			break;
			
			case 2:
				$heading_open = "<h2 $attr>";
				$heading_close = "</h2>";
			break;
			
			case 3:
				$heading_open = "<h3 $attr>";
				$heading_close = "</h3>";
			break;
			
			case 4:
				$heading_open = "<h4 $attr>";
				$heading_close = "</h4>";
			break;
				
			case 5:
				$heading_open = "<h5 $attr>";
				$heading_close = "</h5>";
			break;
				
			case 6:
				$heading_open = "<h6 $attr>";
				$heading_close = "</h6>";
			break;
			
			default:
				$heading_open = "<h1 $attr>";
				$heading_close = "</h1>";
			break;
		}
		
		return (string) $heading_open.$string.$heading_close;
	}
}