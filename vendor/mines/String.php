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
 
if(!function_exists('string_to_chars'))
{
	/**
	 * Convert String to Chars
	 * 
	 * @param 	string
	 * @return 	string
	 */
	 
	function string_to_chars($string)
	{
		$string = str_replace("&nbsp;","\t",$string);
		$string = str_replace("<br />","\n",$string);
		$string = str_replace("&amp;","&",$string);
		$string = str_replace('"',"&quot;",$string);
		$string = str_replace("<","&lt;",$string);
		$string = str_replace(">","&gt;",$string);
		
		return $string;
	}
}

if(!function_exists('chars_to_string'))
{
	/**
	 * Convert Chars to String
	 * 
	 * @param 	string
	 * @return 	string
	 */

	function chars_to_string($chars)
	{
		$chars = str_replace("\t","&nbsp;",$chars);
		$chars = str_replace("\n","<br />",$chars);
		$chars = str_replace("&","&amp;",$chars);
		$chars = str_replace('"',"&quot;",$chars);
		$chars = str_replace("&lt","<",$chars);
		$chars = str_replace("&gt",">",$chars);

		return $chars;
	}
}