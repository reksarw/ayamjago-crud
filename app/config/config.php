<?php
if(!defined("RUN")) exit; // Keep silent
/**
| ------------------------------------
| Config.php
| ------------------------------------
|
| File ini adalah konfigurasi untuk App yang akan dibuat
| pada file ini terdapat:
| 1.base_url
| 2.timezone
| 3.MySecretKey
| 4.language
|
*/

/**
 * 1.base_url
 * -
 * URL untuk AyamJago root.
 *
 * Untuk contoh:
 * 		http://example.com/
 *
 * PENTING! untuk diisi.
 * Jika kosong maka base_url otomatis akan terisi secara otomatis
 */
 
$config['base_url']		 = "";

/**
 * 2.timezone
 * -
 * Timezone berfungsi sebagai mencocokan waktu server
 * dengan waktu web yang akan dibuat.
 *
 * Lihat selengkapnya:
 * http://php.net/manual/en/timezones.php
 */

$config['timezone'] 	= "Asia/Jakarta";

/**
 * 3.MySecretKey
 * -
 * MySecretKey digunakan untuk mengenkripsi satu arah
 * maupun dua arah pada sebuah string atau kalimat.
 * Jika key kosong maka default key adalah:
 * AyamJagoFramework
 */

$config['MySecretKey'] 	= "";

/**
 * 4.language
 * -
 * Language ini bertujuan untuk mengatur kata dimana
 * jika ada kesalahan dalam sebuah website yang akan dibuah
 *
 * File language dapat dilihat di:
 * app/workspace/language/LANGUAGE_YANG_DIPILIH
 *
 * Perlu diingat:
 * nama folder harus sama
 * ketentuan nama file dan variabel harus sama dengan defaultnya
 */
 
$config['language']		= "id-ID";

/*
 * Location : ./app/config/config.php
 */