<?php
/** 
 * Setting error also known as DEBUG , 
 * You can set value is :
 * FALSE or false and all Error will be not display
 * and TRUE or true is display all error
 *
 * if you use development mode , you can set DEBUG is TRUE
 */
 
defined("DEBUG") or define('DEBUG' , TRUE);

/** Setting MVC Application Directory */

$APPLICATION = "app";

/** then setting AJ system Directory */

$RUN = "vendor";

/** is Defined index AJ ? Okay! if not define We will define it. */

defined("INDEX_AJ") or define("INDEX_AJ" , pathinfo(__FILE__, PATHINFO_BASENAME));

/** Define ROOT_DIR if is need */

defined("ROOT_DIR") or define("ROOT_DIR" , str_replace("\\" , "/" , getcwd()).'/');

/** Next to , we will define APP as MVC Directory */

defined("APP") or define("APP" , str_replace("\\","/",str_replace(INDEX_AJ , $APPLICATION.'\\' , $_SERVER['SCRIPT_FILENAME'])));

/** And the last , define RUN as AyamJago System for run all Function :) */

defined("RUN") or define("RUN" , str_replace("\\","/",str_replace(INDEX_AJ , $RUN.'\\' , $_SERVER['SCRIPT_FILENAME'])));

/** Check the MVC Directory and is write directory ? */

if (!is_dir($APPLICATION) or !is_writable($APPLICATION))
{
	exit("File ".$APPLICATION." not found or File is not writable. Error in : ".INDEX_AJ);
}

/** After it, we check again for AJ System , What is writable directory ? */

if (!is_dir($RUN) or !is_writable($RUN))
{
	exit("File ".$RUN." not found or File is not writable. Error in : ".INDEX_AJ);
}

/** And , we will Run it :) */

require_once (RUN.'system/AyamJago.php');

/*
 * Location : ./index.php
 */