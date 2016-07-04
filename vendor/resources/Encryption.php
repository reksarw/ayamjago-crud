<?php

/**
 * AyamJago Encrpytion Class
 *
 * @package	Resources
 * @file	Encryption.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */

class AJ_Encryption {
	
	private $hash;
	
	private $key;
	
	public function __construct()
	{
		$this->config =& take_class("Config");
		
		$this->key = empty($this->config->MySecretKey()) ? "AyamJagoFramework" : $this->config->MySecretKey();
	}
	
	public function do_hash($string,$rand_min = 30 , $rand_max = 35)
	{
		if( empty($string))
			return $string;
		
		$this->hash = strrev($string);
		$this->hash = str_rot13(base64_encode($this->key));
		$this->hash = str_shuffle($this->key);
		$this->hash = md5(md5($this->hash));
		$this->hash = sha1(base64_decode($this->hash));
		$this->hash = md5($this->hash);
		$this->hash = substr($this->hash,rand(1,5),rand($rand_min,$rand_max));
		
		return $this->hash;
	}

	public function en($string)
	{
		$this->hash = "";

		for($i = 0 ; $i < strlen($string);)
		{
			for($j = 0;($j < strlen($this->key) && $i < strlen($string)); $j++ , $i++)
			{
				$this->hash .= $string{$i} ^ $this->key{$j};
			}
		}
		
		$this->hash = base64_encode($this->hash);
		
		return $this->hash;
	}

	public function de($string)
	{	
		$string = base64_decode($string);
		
		$this->hash = "";
		
		for($i = 0;$i < strlen($string);)
        {
            for($j=0;($j < strlen($this->key) && $i < strlen($string));$j++,$i++)
            {
            	$this->hash .= $string{$i} ^ $this->key{$j};
            }
        }
            
        return $this->hash;
	}
}