<?
	/*-----------------------*/
	define( '_AUTOGAN',1);
	define( '_VALID_VVM',1);
	/*-----------------------*/
	$GLOB_Pagina="http://"."petrinoinmobiliaria.com.ar"."/";
	$GLOB_Pagina_non_protocol="//"."petrinoinmobiliaria.com.ar"."/";
	$GLOB_Pagina_LocalHost="http://localhost/petrino/";
	$GLOB_NoSeleccionar="oncontextmenu='return false' ondragstart='return false' onmousedown='return false' onselectstart='return false'";
	/*-----------------------*/
	$GLOB_Banderas=array(
		"cortar" => false,
		"gmap" => false,
		"online" => false,
		"offline-online" => false,
		"optimizado" => false,
		"sitemap" => false,
		"sitemap_automatico" => false,
		"social" => false,
	);
	#if (function_exists('date_default_timezone_set')) {date_default_timezone_set(date_default_timezone_get());}
	/*-----------------------*/
	if ($GLOB_Banderas["online"])error_reporting(0);
	/*-----------------------*/
	require_once("FGC.php");
	require_once("FDE.php");
	require_once("FBD.php");
	/*-----------------------*/
?>