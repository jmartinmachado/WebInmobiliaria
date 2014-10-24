<?php
	require_once 'var_glob.php';
	if ( Bandera("sitemap_automatico") || (Bandera("sitemap") && (HoraStr(1)>1 && HoraStr(1)<7) && FechaStr(3)!=trim(file_get_contents("sitemap_dia.txt"))) ){
		Guardar_Archivo("sitemap_dia.txt", FechaStr(3),"a");
		Generar_Sitemap();
		Guardar_Archivo("sitemap_reporte.txt", "Sitemap generado el ".FechaStr()." a las ".HoraStr()." \n","a+");
	}
?>