<?php

if ( ! function_exists('isTanggalLahir'))
{
	function isTanggalLahir($format)
	{
		$x = explode("-",$format);
		$tahun = $x[0];
		$bulan = $x[1];
		$tanggal = $x[2];
		
		if(strlen($format) == 0)
		{
			return false;
		}
		
		if ( strlen($tahun) > 4 || $tahun > date("Y"))
		{
			return false;
		}
	
		if ( strlen($bulan) > 2 || $bulan > 12 )
		{
			return false;
		}
		
		if ( strlen($tanggal) > 2 || $tanggal > 31 )
		{
			return false;
		}
		
		return true;
	}
}

if ( ! function_exists('isNull'))
{
	function isNull($string)
	{
		return (bool) strlen($string) == 0;
	}
}
