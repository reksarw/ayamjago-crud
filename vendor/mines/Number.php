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
 
if(!function_exists('random_number'))
{
	/*
	 * Random Number 
	 *
	 * @param 	integer
	 * @param 	integer
	 * @return 	integer
	 */
	 
	function random_number($range_min = 1 , $range_max = 500)
	{
		$range_min = (int) $range_min;
		$range_max = (int) $range_max;
		
		return (int) rand($range_min,$range_max);
	}
}

if(!function_exists('sum_number'))
{
	/*
	 * Sum Number
	 *
	 * @param 	void 	param is : 15,5,10	
	 * @return 	integer return value is : 30
	 */
	 
	function sum_number()
	{
		$func = func_get_args();
		
		$sum = 0;
		
		foreach($func as $increment => $number)
		{
			$sum += $number;
		}
		
		return (is_int($sum)) ? (int) $sum : (float) $sum;
	}
}

if(!function_exists('isPositive'))
{
	/*
	 * Number validation , Is positif number ?
	 *
	 * @param 	integer
	 * @return 	boolean
	 */

	function isPositive($numeric)
	{
		return (bool) ($numeric > 0);
	}
}

if(!function_exists('isNegative'))
{	
	/*
	 * Number validation , Is negatif number ?
	 *
	 * @param 	integer
	 * @return 	boolean
	 */

	function isNegative($numeric)
	{
		return (bool) ($numeric < 0);
	}
}

if(!function_exists('isZero'))
{	
	/*
	 * Number validation , Is 0 number ?
	 *
	 * @param 	integer
	 * @return 	boolean
	 */

	function isZero($numeric)
	{
		return (bool) ($numeric == 0);
	}
}