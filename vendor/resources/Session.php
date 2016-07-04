<?php

/**
 * AyamJago Session Class
 *
 * @package	Resources
 * @file	Session.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */

class AJ_Session {
	
	private $session;
	
	public function __construct()
	{
		if(session_id() == FALSE)
		{
			session_start();
		}
	}
	
	public function set($sessionName , $sessionValue)
	{
		if( isset($_SESSION[$sessionName]))
			RETURN NULL;
		
		if( empty($sessionName) || empty($sessionValue))
			RETURN FALSE;
		
		$_SESSION[$sessionName] = $sessionValue;
		
		return true;
	}
	
	/*
	 * Create session group with ARRAY
	 *
	 * @param	array 	array("session1" => "value1" , "session2" => "value2")
	 * @return 	string	session is set
	 *
	 */
	 
	public function set_group($sessionName = array())
	{
		if(!is_array($sessionName) or empty($sessionName))
			exit("Session set harus berupa array");
		
		foreach($sessionName as $key => $value)
		{
			$this->session[] = $key.",".$value;
		}
		
		$isSession = empty($this->session) ? '' : $this->session;
		
		foreach($isSession as $key => $value)
		{
			$x = explode(",",$value);
			
			if(!($_SESSION[$x[0]] = $x[1]))
				$_SESSION[$x[0]] = $x[1];
		}
		
		return true;
	}
	
	public function data($sessionName)
	{
		if(empty($sessionName) or !isset($_SESSION[$sessionName]))
			return false;
			
		return $_SESSION[$sessionName];
	}
	
	public function delete($sessionName)
	{
		if(empty($sessionName) or !isset($_SESSION[$sessionName]))
			return false;
		
		unset($_SESSION[$sessionName]);
	}
	
	public function destroy()
	{
		if(session_id() != FALSE)
		{
			if(function_exists('session_destroy'))
				session_destroy();
			else
				exit('Session error!');
		}
	}
}