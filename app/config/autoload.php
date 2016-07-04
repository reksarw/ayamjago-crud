<?php
if(!defined("RUN")) exit; // Keep silent
/**
| ------------------------------------
| Autoload.php
| ------------------------------------
|
| Autoload ini digunakan untuk menginclude 
| secara otomatis Resources maupun mines 
| yang telah disediakan pada folder utama AyamJago
|
| Untuk melakukan konfigurasi RESOURCES
|
| $autoload['resources'] = array('resources1','resources2','resources3');
|
| dapat melihat semua resources di folder Resources
| pada folder utama AyamJago
|
| default:
| vendor/Resources/
|
| Selanjutnya, untuk mengkonfigurasi MINES
|
| $autoload['mines'] = array('mines1','mines2','mines3');
| 
| mines terdapat pada folder Mines yang terletak
| pada folder utama file AyamJago
|
| default:
| vendor/Mines/
|
| Note:
| Cukup menggunakan huruf kecil saja untuk menggunakan autoload ini
| dan autoload harus berupa array
|
*/

$autoload['resources'] = array();

$autoload['mines'] = array();

/*
 * Location : ./app/config/autoload.php
 */