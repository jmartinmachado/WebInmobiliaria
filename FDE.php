<?
	if( !defined( '_AUTOGAN' ) && !defined( '_VALID_VVM' ) ) die( 'Restricted access' );
	function Bandera($a){
		global $GLOB_Banderas;
		return $GLOB_Banderas[$a];
	}
	function traducir_url($url){
		global $GLOB_Pagina;
		global $GLOB_Pagina_non_protocol;
		global $GLOB_Pagina_LocalHost;
		if(Bandera("cortar")){ 
			if($url=="inicio"){
				return $GLOB_Pagina;
			}else{
				if (Extencion($url)=="css" || Extencion($url)=="jpg"  || Extencion($url)=="js" || Extencion($url)=="ico"){
					return $GLOB_Pagina_non_protocol.$url;
				}else{
					return $GLOB_Pagina.$url;
				}
			}
		}else{
			return $GLOB_Pagina_LocalHost.$url;
		}
	}
	function HoraStr($t=0){
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$hora = getdate(time());
		$hora["hours"] = ($hora["hours"]<10) ? "0".$hora["hours"] : $hora["hours"];
		$hora["minutes"] = ($hora["minutes"]<10) ? "0".$hora["minutes"] : $hora["minutes"];
		$hora["seconds"] = ($hora["seconds"]<10) ? "0".$hora["seconds"] : $hora["seconds"];
		switch ($t) {
			case 0:
				return $hora["hours"] . ":" . $hora["minutes"] . ":" . $hora["seconds"]; 
			break;
			case 1:
				return $hora["hours"]; 
			break;
			case 2:
				return $hora["minutes"]; 
			break;
			case 3:
				return $hora["seconds"]; 
			break;
		}
	}
	function FechaStr($t=0){
		switch ($t) {
			case 0:
				return date("Y-m-d");
			break;
			case 1:
				return date("Y");
			break;
			case 2:
				return date("m");
			break;
			case 3:
				return date("d");
			break;
		}
	}
	function Extencion($path) {
		return substr(strrchr($path, "."),1);
	}
	function resultado_final($str){
		return json_encode(array('status'=>$str));
	}
	function resultado_final_img($str,$Width,$Height){
		return json_encode(array('status'=>$str,'width'=>$Width,'height'=>$Height));
	}
	function Nombre_De_Img(){
		$dia_semana=intval(strftime("%w"));
		$dia_numero=intval(strftime("%d"));
		$mes=intval(strftime("%m"));
		$año=strftime("%Y");
		$hora=strftime("%H%M%S");
		$hexadecimal=$hora.$dia_numero.$mes.$año;
		return strtoupper(base_convert($hexadecimal, 10, 25));
	}
	function Cortar_IMG($img,$x,$y,$tamanio_w,$tamanio_h){
		$jpeg_quality = 90;
		$img_r = imagecreatefromjpeg($img);
		$dst_r = ImageCreateTrueColor( $tamanio_w, $tamanio_h);
		imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$tamanio_w,$tamanio_h,$tamanio_w,$tamanio_h);
		imagejpeg($dst_r,$img,$jpeg_quality);
	}
	function Mandar_Mail($nombre,$email,$telefono,$asunto,$mensaje,$fecha,$hora){
		$Obtener=Obtener_Correo();
		if ($Obtener["OK"]==1){	
			if ($asunto=="NONE"){
				$asunto_final="Consulta en general";
				$mensaje_final="Enviado el ".$fecha." a las ".$hora."<br/> &nbsp; <br/>".$nombre." <br/> ".$telefono." <br/> ".$email."<br/> &nbsp; <br/> <u>Mensaje:</u><br/>".$mensaje;
			}else{
				$Obtener_Post=Obtener_Post(Codigo_post_deco($asunto));
				$Obtener_Post_URL=Generar_Url_Post($Obtener_Post["Data"][0]["ID"],$Obtener_Post["Data"][0]["tipo_inmueble"],$Obtener_Post["Data"][0]["titulo"],$Obtener_Post["Data"][0]["region_provincia"]);
				$asunto_final="Consulta ".$Obtener_Post["Data"][0]["titulo"];
				$mensaje_final="Enviado el ".$fecha." a las ".$hora."<br/> &nbsp; <br/>".$nombre." <br/> ".$telefono." <br/> ".$email."<br/> &nbsp; <br/> <u>Mensaje:</u><br/>".$mensaje."<br/> &nbsp; <br/> Propiedad Consultada --> <a href='".$Obtener_Post_URL."' alt='_blank'>".$Obtener_Post_URL."</a>";
			}
			require("phpmailer.inc.php");
			#require("smtp.inc.php");
			$mail = new phpmailer;
			$mail->IsSMTP();
			$mail->From = "noreply@petrinoinmobiliaria.com.ar";
			$mail->FromName = "Consulta";
			$mail->Host = "smtp.petrinoinmobiliaria.com.ar;smtp1.petrinoinmobiliaria.com.ar";  // specify main and backup server
			$mail->AddAddress($Obtener["Data"], "Petrino Inmobiliaria");
			$mail->AddReplyTo(trim($email), trim($nombre));
			$mail->WordWrap = 0; 
			$mail->IsHTML(true);
			$mail->Subject = $asunto_final;
			$mail->Body = $mensaje_final;
			$mail->Send(); 
		}
	}
	function Generar_Sitemap(){
		global $GLOB_Pagina;
		Generar_XML("sitemap_principal.xml",true,array(0,
			array('url' => $GLOB_Pagina, "ultima_modificacion" => FechaStr(),"prioridad" => 1.0),
			array('url' => $GLOB_Pagina."alquiler", "ultima_modificacion" => FechaStr(),"prioridad" => 1.0),
			array('url' => $GLOB_Pagina."ventas", "ultima_modificacion" => FechaStr(),"prioridad" => 1.0),
			array('url' => $GLOB_Pagina."servicios", "ultima_modificacion" => FechaStr(),"prioridad" => 1.0),
			array('url' => $GLOB_Pagina."quienes_somos", "ultima_modificacion" => FechaStr(),"prioridad" => 1.0),
			array('url' => $GLOB_Pagina."contacto", "ultima_modificacion" => FechaStr(),"prioridad" => 1.0),
			array('url' => $GLOB_Pagina."terminosycondiciones", "ultima_modificacion" => FechaStr(),"prioridad" => 1.0)
		));
		$Obtener=Obtener_Sitemap();
		if ($Obtener["OK"]==1){
			Generar_XML("sitemap_propiedades.xml",false,$Obtener["Data"]);
		}
	}
	function Generar_XML($Path_XML,$t,$Datos){
		if (file_exists($Path_XML)){
			unlink($Path_XML);
		}
		$fp=fopen($Path_XML,"a");
		$p=count($Datos);
		$Contenido='<?xml version="1.0" encoding="UTF-8"?>';
		
		if($t){
			$Contenido='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
			for ($i = 1 ; $i < $p; $i++) {
				$Contenido.='<url>';
				$Contenido.='<loc>'.$Datos[$i]["url"].'</loc>';
				$Contenido.='<lastmod>'.$Datos[$i]["ultima_modificacion"].'</lastmod>';
				$Contenido.='<changefreq>monthly</changefreq>';
				$Contenido.='<priority>'.$Datos[$i]["prioridad"].'</priority>';
				$Contenido.='</url>';
			}
			$Contenido.='</urlset>';
		}else{
			$Contenido='<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
			for ($i = 1 ; $i < $p; $i++) {
				$Contenido.='<sitemap>';
				$Contenido.='<loc>'.$Datos[$i]["url"].'</loc>';
				$Contenido.='<lastmod>'.$Datos[$i]["ultima_modificacion"].'</lastmod>';
				$Contenido.='</sitemap>';
			}
			$Contenido.='</sitemapindex>';
		}
		fwrite($fp, $Contenido);
		fclose($fp);
	}
	function Guardar_Archivo($Path,$MSJ,$metodo="a"){
		if (file_exists($Path) && $metodo=="a"){
			unlink($Path);
		}
		$fp = fopen($Path,$metodo);
		fwrite($fp, $MSJ);
		fclose($fp);
	}
?>