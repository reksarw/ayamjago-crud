<?php

/**
 * AyamJago Validation Class
 *
 * @package	Resources
 * @file	Validation.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */

class AJ_Validation {
	
	/*
	 * String validation
	 *
	 * @param 	string
	 * @return 	boolean
	 */

	public function isString($string)
	{
		if( empty($string) or !is_string($string))
			return null;
		
		$string = (string) $string;
		
		return (bool) filter_var($string, FILTER_SANITIZE_STRING);
	}
	
	/*
	 * Number validation
	 *
	 * @param 	integer
	 * @return 	boolean
	 */

	public function isNumber($number)
	{
		if(empty($number) or !is_integer($number))
			return null;
		
		$number = (int) $number;
		
		return (bool) filter_var($number, FILTER_VALIDATE_INT);
	}
	
	/*
 	 * Email format Validation
 	 *
 	 * @param 	string 	email@example.com
 	 * @return 	boolean
	 */
	 
	public function isEmail($email)
	{
		if( empty($email))
			return null;

		$email = trim($email);

		$regex = "/[a-zA-Z0-9+_]@[a-zA-Z0-9+_]+\.[a-zA-Z]/";

		return (bool) preg_match($regex,$email);
	}
	
	/*
     * URL Format Validation
     *
     * @param 	string 	http://example.com
     * @return 	boolean	
	 */

	public function isUrl($url)
	{
		if( empty($url))
			return null;

		$url = trim($url);

		$regex = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

		return (bool) preg_match($regex,$url);
	}
	
	/*
	 * Regular Expression Validation
	 *
	 * @param	string
	 * @param	string 	regex
	 * @return 	boolean
	 */
	
	public function isRegex($string , $regex)
	{
		return (bool) preg_match($regex , $string);
	}
}