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
 
/** Well , Define AyamJago Version */

defined("AJ_VERSION") or define('AJ_VERSION' , '1.0');

require RUN."system/Settings.php";

if(!AJ_PHP_REQUIRE())
{
	echo "AyamJago Framework membutuhkan versi PHP 5.6.0 atau lebih";
	echo "\n Versi PHP saat ini : ".PHP_VERSION;
	exit;
}

$CTR =& take_class("Controller");

$CFG =& take_class("Config");

$RUN =& take_class("Run");

$RUN->AyamJago(DEBUG);

/*
 * Location :./vendor/system/AyamJago.php
 */