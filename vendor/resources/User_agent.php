<?php

/**
 * AyamJago User Agent Class
 *
 * @package	Resources
 * @file	User_agent.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */
 
class AJ_User_agent {

	private $ua;

	private $browser;

	private $platform;
	
	public function __construct()
	{
		if(isset($_SERVER['HTTP_USER_AGENT']))
		{
			$this->ua = $_SERVER['HTTP_USER_AGENT'];
			return $this->ua;
		}
	}

	/*
     * Get Browser
     *
     * See more : http://php.net/manual/en/function.get-browser.php#119332
     *
     * @return 	string 	as Browser User
	 */
	public function browser($param = NULL)
	{	
		$this->browsers = array(
			'Opera' => 'Opera',
			'Edge' => 'Edge',
			'Netscape' => 'Netscape',
			'Chrome' => 'Google Chrome',
			'Safari' => 'Apple Safari',
			'Firefox' => 'Mozilla Firefox',
			'MSIE' => 'Internet Explorer',
			'Trident' => 'Internet Explorer'
		);
		
		if( !empty($param))
		{
			if(array_key_exists($param,$this->browsers))
				return $this->browsers;
			else
				return NULL;
		}

		foreach($this->browsers as $key => $value)
		{
			if(strpos($this->ua,$key))
				return $this->browser = $value;
		}

		return $this->browser = "Unknown Browser";	
	}

	/*
 	 * Get Platform from user
 	 *
 	 * See more : http://stackoverflow.com/questions/18070154/get-operating-system-info-with-php
 	 *
 	 * @return 	string 	as Platform User
	 */
	public function platform()
	{
		$this->platforms = array(
			'/windows nt 10/i'     	=>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
			'/ubuntu/i'             =>  'Ubuntu',
            '/linux/i'              =>  'Linux',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile',
            '/android/i'			=> 	'Android'
		);
		
		foreach($this->platforms as $key => $value)
		{
			if(preg_match($key,$this->ua))
				return $this->platform = $value;
		}

		return $this->platform = "Unknown Platform";
	}
	
	/*
 	 * Get complete user agent
 	 *
 	 * @return 	mixed
	 */

	public function print_ua()
	{
		return (!empty($this->ua)) ? $this->ua : 'Unknown user agent';
	}
}