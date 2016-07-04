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
 
if( !function_exists('now'))
{
	/**
	 * Now Function
	 *
	 * Get date for today with format ..
	 * Default format is.... Y-m-d H:i:s
	 *
	 * @param	mixed	choice your format 
	 * @return 	string 
	 */

	function now($format = 'Y-m-d H:i:s')
	{
		return date($format);
	}
}

if( !function_exists('today'))
{
	/**
	 * Today Function
	 *
	 * Get date and time (optional) for today...
	 *
	 * @param	boolean 
	 * @return 	string 	as today , if param is true it will add time
	 */
	 
	function today($accept_time = FALSE)
	{
		$CFG =& take_class("Config");
		
		
		switch(date("D"))
		{
			case "Mon": $day = $CFG->lang->date['monday']; break ;
			case "Tue": $day = $CFG->lang->date['thursday']; break ;
			case "Wed": $day = $CFG->lang->date['wednesday']; break ;
			case "Thur":$day = $CFG->lang->date['thursday']; break ;
			case "Fri": $day = $CFG->lang->date['friday']; break ;
			case "Sat": $day = $CFG->lang->date['saturday']; break ;
			case "Sun": $day = $CFG->lang->date['sunday']; break ;
		}
		
		switch(date("m"))
		{
			case 01: $month = $CFG->lang->date['january']; break;
			case 02: $month = $CFG->lang->date['february']; break;
			case 03: $month = $CFG->lang->date['march']; break;
			case 04: $month = $CFG->lang->date['april']; break;
			case 05: $month = $CFG->lang->date['may']; break;
			case 06: $month = $CFG->lang->date['june']; break;
			case 07: $month = $CFG->lang->date['july']; break;
			case 08: $month = $CFG->lang->date['august']; break;
			case 09: $month = $CFG->lang->date['september']; break;
			case 10: $month = $CFG->lang->date['october']; break;
			case 11: $month = $CFG->lang->date['november']; break;
			case 12: $month = $CFG->lang->date['desember']; break;
		}
		
		$time = ($accept_time) ? "H:i:s" : "";
		return (string) ($day.", ".date("d")."-".$month."-".date('Y')." ".date($time));
	}
}

if( !function_exists('get_timezone'))
{
	/**
	 * Get Timezone Function
	 *
	 * Get timezone from config/config.php
	 *
	 * @return 	string 	as Timezone
	 */
	 
	function get_timezone()
	{
		$CFG =& take_class("Config");
		
		return (string) $CFG->timezone;
	}
}

if( ! function_exists('timeago'))
{
	/**
	 * Timeago date
	 *
	 * Source : http://jagocoding.com/tutorial/23/Membuat_Keterangan_Lamanya_Waktu_yang_Berlalu_pada_PHP
	 *
	 * @param	string	date
	 * @return 	string 	date
	 */
	 
	function timeago($times)
	{
		$times = strtotime($times);
		
		$CFG =& take_class("Config");
		
		$chunks = array(
			array(60 * 60 * 24 * 365 , $CFG->lang->date['year']),
			array(60 * 60 * 24 * 30, $CFG->lang->date['month']),
			array(60 * 60 * 24 * 7, $CFG->lang->date['week']),
			array(60 * 60 * 24, $CFG->lang->date['day']),
			array(60 * 60, $CFG->lang->date['hour']),
			array(60, $CFG->lang->date['minute']),
		);
		
		$today = time();
		
		$since = $today - $times;
		
		if($since > 604800)
		{
			$print = date("M jS", $times);
			if ($since > 31536000)
			{
			  $print .= ", " . date("Y", $times);
			}
			
			return $print;
		}
		
		for ($i = 0, $j = count($chunks); $i < $j; $i++)
		{
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];

			if (($count = floor($since / $seconds)) != 0)
			break;
		}
		
		$print = ($count == 1) ? '1 ' . $name : "$count {$name}";
		return $print;
	}
}