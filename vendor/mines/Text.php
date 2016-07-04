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
 
if(!function_exists('random_word'))
{
	/**
	 * Random Word
	 *
	 * @param 	integer
	 * @param	boolean
	 * @return	string
	 */
	 
	function random_word($length = 8 , $with_special_chars_and_number = FALSE)
	{
		$length = (int) $length;
		
		$word_is = "abcdefghijklmnopqrstuvwxyz";
		$word_is.= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		if($with_special_chars_and_number)
		{
			$word_is .= "1234567890";
			$word_is .= "!@#$%^&*()_-+=\\/.,<>?\[]{}'";
		}
		
		return (substr(shuffle_word($word_is) , 0 , $length));
	}
}

if(!function_exists('reverse_word'))
{
	/**
	 * Reverse word
	 *
	 * For Example:
	 * $word_is = "AyamJago Framework" 
	 * Output Like : krowemarF ogaJmayA
	 *
	 * @param	string
	 * @return	void
	 */
	 
	function reverse_word($word)
	{
		if( empty ($word) || is_null($word) )
			return $word;
		
		$word = trim($word);
		
		return (string) strrev($word);
	}
}

if(!function_exists('shuffle_word'))
{
	/**
	 * Shuffle Word
	 *
	 * @param 	string
	 * @return 	void
	 */
	 
	function shuffle_word($word)
	{
		if( empty ($word) || is_null($word) )
			return $word;
		
		$word = trim($word);
		
		return (string) str_shuffle($word);
	}
}

if(!function_exists('pre_word'))
{
	/**
	 * Pre word
	 *
	 * If in HTML you can may use tag <pre>
	 *
	 * @param 	string
	 * @return	void
	 */
	 
	function pre_word($word = '')
	{
		if( empty ($word) || is_null($word) )
			return $word;
		
		$words = trim($word);
		$words = strip_tags($word);
		$words = htmlentities($word);
		
		return ( nl2br($words));
	}
}

if(!function_exists('strength_word'))
{
	/**
	 * Strength Word
	 * 
	 * @param 	string
	 * @return 	string
	 */
	 
	function strength_word($word)
	{
		if( empty ($word) || is_null($word) )
			return $word;
		
		$word = trim($word);
		
		$score_is[0] = "Too Weak";
		$score_is[1] = "Weak";
		$score_is[2] = "Nice";
		$score_is[3] = "Very Nice";
		$score_is[4] = "Strong";
		$score_is[5] = "Very Strong";
		
		$score = 0;
		
		if(strlen($word) > 6)
			$score++;
		
		if(preg_match("/[a-z]/",$word) && preg_match("/[A-Z]/",$word))
			$score++;
		
		if(preg_match("/\d+/",$word))
			$score++;
		
		if(preg_match("/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/",$word))
			$score++;
		
		if(strlen($word) > 12)
			$score++;
		
		return (string) $score_is[$score];
 	}
}

if(!function_exists('text_limiter'))
{
	/**
	 * Text Limiter
	 *
	 * @param 	string
	 * @param 	integer		default length is 70
	 * @return 	string
	 */
	 
	function text_limiter($string , $length = 70)
	{
		if( empty($string) || !is_int($length))
			return $string;
		
		$length = (int) $length;
		$string = trim($string);
		
		return (string) substr($string , 0 , $length);
	}
}

if(!function_exists('replace_words'))
{
	/**
	 * Replace Words Function
	 *
	 * @param	string
	 * @param 	array
	 * @param	mixed
	 * @return 	string
	 */
	 
	function replace_words($string , $banned = array() , $replacement = '')
	{
		if( !is_array($banned))
		{
			return $string;
		}
		
		$censored = str_replace($banned,$replacement,$string);
		
		return trim($censored);
	}
}