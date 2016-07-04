<?php
if(!defined("RUN")) exit; // Keep silent

/**
 * AyamJago Settings Function
 *
 * Stand for?
 *
 * Global Settings AyamJago Core
 *
 * @package	System
 * @file	Settings.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 *
 */

if(!function_exists('AJ_PHP_REQUIRE'))
{
	/* 
	 * AyamJago PHP Version Require
	 *
	 * @return 	boolean
	 *
	 */

	function AJ_PHP_REQUIRE()
	{
		$AJ_REQUIRE = "5.6.0";
		
		if(version_compare(PHP_VERSION, $AJ_REQUIRE, '>='))
			return 1;
		return 0;
	}
}

if(!function_exists("take_class"))
{
	/* Take Class Function
	 *
	 * @param	string	as ClassName
	 * @param	string	as Directory Destination
	 * @param	string 	as Prefiks Class 
	 * @return	string 	as Class Name
	 *
	 */
	 
	function &take_class($className , $dir = RUN."system/" , $prefiks = "AJ_")
	{
		static $isClass = array();
		
		if(class_exists($className))
			return $className;
		
		$setClass = filterStr($className);
		$setName = $prefiks.$className;
		
		foreach(array(RUN) as $classPath)
		{
			if(!file_exists($dir.$className.".php"))
				return false;
			
			include_once ( $dir.$className.".php" );
			continue;
		}
		
		$isClass[$setClass] = new $setName();
		
		return $isClass[$setClass];
	}
}

if(!function_exists('take_workspace'))
{
	/* Workspace Function
	 *
	 * @param	string	as Class Name
	 * @param	string 	as Directory Destination
	 * @param	string 	as Prefiks Class 
	 * @return	string 	as Class Name
	 *
	 */
	 
	function &take_workspace($className,$workspace_dir = "" , $prefiks = "")
	{
		static $isWorkspace = array();
		
		$workspace_dir = str_replace("\\","",$workspace_dir);
		$workspace_dir = str_replace("\\\\","",$workspace_dir);
		$workspace_dir = str_replace("//","",$workspace_dir);
		$workspace_dir = str_replace("/","",$workspace_dir);
		
		if(empty($workspace_dir))
			$ws_dir = APP."workspace/";
		else
			$ws_dir = APP."workspace/".$workspace_dir."/";
		
		
		$setObject = filterStr($className);
		$setWorkspace = $prefiks.$className;
		
		if(class_exists($setWorkspace))
			return $setWorkspace;
		
		foreach(array(APP."workspace/") as $workspace)
		{
			if(!file_exists($ws_dir.$className.".php"))
				return false;
			include_once ( $ws_dir.$className.".php" );
			continue;
		}
		
		$isWorkspace[$setObject] = new $setWorkspace();
		return $isWorkspace[$setObject];
	}
}

if(!function_exists('filterStr'))
{
	function filterStr($string)
	{
		$string = trim($string);
		$string = strtolower($string);
		$string = htmlentities($string);
		$string = strip_tags($string);
		$string = addslashes($string);
		
		return $string;
	}
}

/*
 * Location :./vendor/system/Settings.php
 */