<?php
if(!defined("RUN")) exit; // Keep silent
/**
| ------------------------------------
| Routes.php
| ------------------------------------
|
| Konfigurasi untuk default controller yang akan di muat awal
| dan juga untuk routing atau mengatur URL baru
| 
| Contoh konfigurasi untuk default_controller
|
| $route['default_controller'] = "home";
| 
| Controller dapat ditemukan: app/controllers/home.php
|
| Contoh konfigurasi untuk new Routing atau URL Baru
|
| $routes['ayamjago.framework'] = "home/index";
| 
| Contoh sederhana:
| $routes['url_baru'] = "controller/method";
*/

$route['default_controller'] = "home";
//$route['index'] = "home/index";

/*
 * Location : ./app/config/routes.php
 */