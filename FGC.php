<? 	if( !defined( '_AUTOGAN' ) && !defined( '_VALID_VVM' ) ) die( 'Restricted access' ); ?>
<?
/*-------------------------------------------------------*/
	function Generar_Mensaje(){
		$Obtener=Obtener_Mensaje();
		$Obtener_Count=count($Obtener);
		if($Obtener_Count){
			$Obtener_Fecha="";
			$FGC="";
			for($i=0;$i<$Obtener_Count;$i++){
				$FGC.=Generar_Mensaje_Generico($Obtener[$i]["ID"],$Obtener[$i]["nombre"],$Obtener[$i]["email"],$Obtener[$i]["asunto"],$Obtener[$i]["telefono"],$Obtener[$i]["mensaje"],$Obtener[$i]["fecha"],$Obtener[$i]["hora"],$Obtener_Fecha==$Obtener[$i]["fecha"]);
				$Obtener_Fecha=$Obtener[$i]["fecha"];
			}
			
		}else{
			$FGC='<dt class="mensajes_dia"><span class="Modern_Pics">!</span> Nada por ac&aacute;...</dt>';
		}
		return $FGC;
	}
	function Generar_Mensaje_Generico($ID,$nombre,$email,$asunto,$telefono,$mensaje,$fecha,$hora, $nuevafecha){
		global $GLOB_NoSeleccionar;
		$FGC='';
		if (!$nuevafecha){
			$FGC.='<dt class="mensajes_dia" id="mensajes_dt_fecha_'.$fecha.'" ><img class="valign" alt="" src=""/><span class="Modern_Pics">5</span>'.Transformar_Fecha($fecha).'</dt>';
		}
		return $FGC.'<dd id="mensajes_dd_'.$ID.'" class="mensajes_dd_fecha_'.$fecha.'" ><div class="cargando_table" id="mensajes_cargando_'.$ID.'"></div><table cellspacing="10px" border="0" ><tr><td class="sin_border"><img class="valign" alt="" src=""/>'.date("H:i",strtotime($hora)).'</td><td class="mensajes_opcion sin_border"><img class="valign" alt="" src=""/><a href="javascript:Manejar_mensajes(\'S\',\''.$ID.'\')" class="mensajes_opcion_El"><span class="Modern_Pics">X</span></a></td></tr><tr><td colspan=2>Nombre y Apellido: '.$nombre.'</td></tr><tr><td colspan=2>Asunto: '.$asunto.'</td></tr><tr><td >E-Mail: '.$email.'</td><td >Telefono: '.$telefono.'</td></tr><tr ><td colspan=2 class="mensajes_mensaje sin_border"><a>'.$mensaje.'</a></td></tr></table></dd>';
	}
	function Generar_Info($titulo,$descrpcion){
		return '<div id="cuerpo_centro_centro"><div class="cuerpo_centro_titulo titulo_celeste">'.$titulo.'</div><div class="cuerpo_texto">'.bbcode_deco($descrpcion).'</div></div>';
	}
	function Generar_Post($ID,$titulo,$portada,$descripcion,$localidad,$direccion,$region_provincia,$suptotal,$mtdefrente,$supcubierta,$ndeplantas,$dormitorios,$comodidades,$seguridad,$banios,$lavanderia,$terraza,$jardin,$patio,$cochera,$antiguedad,$asador_quincho,$cerrado_perimetral,$gas,$calefacccion,$cloacas,$piscina,$org_publicos_cercanos,$escritura,$precio,$moneda,$operacion,$Galeria_Fotos,$Img_Google){
		global $GLOB_NoSeleccionar;
		$Img_Portada= json_decode(stripslashes($portada));
		$Img_google_m= json_decode(stripslashes($Img_Google));
		$FGC='<div id="cuerpo_centro_centro"><div class="cuerpo_centro_titulo titulo_morado">'.Codigo_post($ID).' - '.(($operacion == 1) ? "Alquiler": "Venta")." ".$titulo.'</div><div class="cuerpo_post"><div class="cuerpo_post_izq">	<img src="'.traducir_url($Img_Portada[0]).'" height="201" width="537" alt="" title="" class="post_img"/><div class="separador"></div><div class="cuerpo_post_titulo titulo_morado">Descripci&oacute;n</div><div class="cuerpo_post_descripcion">'.bbcode_deco($descripcion);
		$FGC.='<div id="galeria">'."\n";
		$Img_Galeria= json_decode(stripslashes($Galeria_Fotos));
		for($i=(count($Img_Galeria)-2); $i>=0; $i--){
			$FGC.='<div class="pic" style="background:url('.traducir_url($Img_Galeria[$i]).');"><a href="'.traducir_url($Img_Galeria[$i]).'" title="" target="_blank"></a></div>'."\t"."\n";
		}
		
		for($i=(5-((count($Img_Galeria)-1)%5)); $i>0; $i--){
			$FGC.='<div class="pic"></div>'."\t"."\n";
		}
		$FGC.='<span class="stretch"></span></div></div>';

		if($ID!=0)$FGC.='<div class="separador"></div>
			<div class="cuerpo_post_titulo titulo_morado">Consultar sobre esta propiedad </div>
			<form enctype="multipart/form-data" method="post" name="Form_Contacto" id="Form_Contacto" action="">
			<div class="cargando cargando_bg" '.$GLOB_NoSeleccionar.' ></div>
			<fieldset>
			<input type="text" value="Nombre y Apellido (requerido)" title="Nombre y Apellido (requerido)" id="nombre" name="nombre" maxlength="85" /><br/>
			<span  class="error" id="nombre_err">&nbsp;</span><br/>
			<input type="text" value="E-mail (requerido)" title="E-mail (requerido)" id="email" name="email" maxlength="85" /><br/>
			<span  class="error" id="email_err">&nbsp;</span><br/>
			<input type="text" value="Tel&eacute;fono (requerido)" title="Tel&eacute;fono (requerido)" id="telefono" name="telefono" maxlength="85" /><br/>
			<span  class="error" id="telefono_err">&nbsp;</span><br/>
			<textarea id="mensaje" name="mensaje" maxlength="5000" title="Mensaje (requerido)" rows="20">Mensaje (requerido)</textarea><br/>
			<span class="error" id="mensaje_err">&nbsp;</span><br/>
			<input value="Enviar" name="aceptar" id="aceptar" class="aceptar" type="button" onclick="Enviar_Comentario()" /><input type="hidden" value="'.$ID.'" id="asunto" name="asunto" maxlength="85" /></fieldset></form>';
		$FGC.='</div>';
		
		$FGC.='<div class="cuerpo_post_der">
		<div id="GoogleMap"></div>
		<span id="GoogleMap_default">'.traducir_url($Img_google_m[0]).'</span>
		<div class="separador"></div>';
		
		$FGC_Temp="<ul>";
		
		$FGC_Temp.='<li>Precio de '.(($operacion == 1) ? "alquiler": "venta").': '.(($moneda == 1) ? "AR$": "US$")." ".$precio.".00 </span></li>";
		
		if(trim($direccion)!="")$FGC_Temp.='<li>Direccion: '.$direccion.'. Cerca de '.$org_publicos_cercanos.'</li>';
		
		if(trim($localidad)!="")$FGC_Temp.='<li>Localidad: '.$localidad.'</li>';
		
		if(trim($localidad)!="")$FGC_Temp.='<li>Provincia: '.$region_provincia.'</li>';
		
		if($suptotal>0)$FGC_Temp.='<li>Sup. Total: '.$suptotal." m<span class='sup'>2</span></li>";

		if($mtdefrente>0)$FGC_Temp.='<li>Mt. de Frente: '.$mtdefrente." m<span class='sup'>2</span></li>";
		
		if($supcubierta>0)$FGC_Temp.='<li>Sup. Cubierta: '.$supcubierta." m<span class='sup'>2</span></li>";
		
		if($ndeplantas>0)$FGC_Temp.='<li>N&#176; de Plantas: '.$ndeplantas.'</li>';
		
		if($dormitorios>0)$FGC_Temp.='<li> Cant. de Dormitorios: '.$dormitorios.'</li>';
		
		if($banios>0)$FGC_Temp.='<li> Cant. de Ba&#241;os: '.$banios.'</li>';

		if(trim($seguridad)!="")$FGC_Temp.='<li>Seguridad: '.$seguridad.'</li>';
		
		$FGC_Temp_comodidades=((trim($comodidades)) ? '<li>'. implode("</li><li>", explode(",",$comodidades)).'</li>': ""); 

		if($lavanderia>1)$FGC_Temp_comodidades.='<li>'.((($lavanderia == 2) ? "": "Sin").' Lavanderia').'</li>';
		
		if($terraza>1)$FGC_Temp_comodidades.='<li>'.((($terraza == 2) ? "": "Sin").' Terraza').'</li>';
		
		if($jardin>1)$FGC_Temp_comodidades.='<li>'.((($jardin == 2) ? "": "Sin").' Jard&#237;n').'</li>';

		if($patio>1)$FGC_Temp_comodidadesFGC_Temp_comodidades.='<li>'.((($patio == 2) ? "": "Sin").' Patio').'</li>';

		if($cochera>1)$FGC_Temp_comodidades.='<li>'.((($cochera == 2) ? "": "Sin").' Cochera').'</li>';

		if($asador_quincho>1)$FGC_Temp_comodidades.='<li>'.((($asador_quincho == 2) ? "Asador": (($asador_quincho == 3) ? "Quincho": "Asador y Quincho"))).'</li>';

		if($cerrado_perimetral>1)$FGC_Temp_comodidades.='<li>'.((($cerrado_perimetral == 2) ? "": "Sin").' Cerrado Perimetral').'</li>';

		if($gas>1)$FGC_Temp_comodidades.='<li>'.((($gas == 2) ? "Garrafa": (($gas == 3) ? "Gas Natural": "Sin Gas"))).'</li>';

		if($calefacccion>1)$FGC_Temp_comodidades.='<li>'.((($calefacccion == 2) ? "": "Sin").' Calefacci&#243;n').'</li>';

		if($cloacas>1)$FGC_Temp_comodidades.='<li>'.((($cloacas == 2) ? "": "Sin").' Cloacas').'</li>';

		if($piscina>1)$FGC_Temp_comodidades.='<li>'.((($piscina == 2) ? "": "Sin").' Piscina').'</li>';

		if(trim($FGC_Temp_comodidades))$FGC_Temp.='<li>Comodidades: '.'<ul>'.$FGC_Temp_comodidades.'</ul></li>';
		

		if(trim($antiguedad)!="")$FGC_Temp.='<li>Antig&#252;edad: '.$antiguedad.'</li>';

		if(trim($escritura)!="")$FGC_Temp.='<li>Escritura: '.$escritura.'</li>';
		
		$FGC_Temp.="</ul>";
		if(trim($FGC_Temp)!="")$FGC.='<div class="cuerpo_post_titulo titulo_morado">Ficha T&eacute;cnica</div><div class="cuerpo_post_descripcion cuerpo_post_ficha_tecnica">'.$FGC_Temp.'</div>';
				
		if($operacion == 1)$FGC.='<div class="cuerpo_post_titulo titulo_morado">Requisitos para alquilar</div><div class="cuerpo_post_descripcion cuerpo_post_ficha_tecnica">'.$FGC_Temp.'</div>';

		$FGC.='</div><div class="separador"></div>';
		$FGC.='</div></div>';
		return $FGC;
	}
	function Generar_Slide(){
		$Obtener=Obtener_Destacado();
		if ($Obtener["OK"]==1){
			$Obtener_Count=count($Obtener["Data"]);
			if ($Obtener_Count>0){
				$FGC='<div class="cuerpo_centro_titulo titulo_rojo">Propiedades Destacadas</div><div id="slideshow"><ul class="slides">';
				for($i=0;$i<$Obtener_Count-1;$i++){
					$Img= json_decode(stripslashes($Obtener["Data"][$i]["portada_pic"]));
					$FGC.='<li><a href="'.Generar_Url_Post($Obtener["Data"][$i]["ID"],$Obtener["Data"][$i]["tipo_inmueble"],$Obtener["Data"][$i]["titulo"],$Obtener["Data"][$i]["region_provincia"]).'" target="_blank"><img src="'.traducir_url($Img[0]).'" width="900" height="338" alt="'.$Obtener["Data"][$i]["region_provincia"].'" /><div class="slides_descripcion"><img class="valign" alt="" src="">'.($Obtener["Data"][$i]["operacion"]==1 ? "Alquiler" : "Venta")." - ".$Obtener["Data"][$i]["titulo"].'</div></a></li>';
				}
				$FGC.='</ul><span class="arrow previous"></span><span class="arrow next"></span></div><div class="separador"></div>';
			}else{
				$FGC="";
			}
		}else{
			$FGC="";
		}
		return $FGC;
	}
	function Generar_Novedades($pagina){
		$Obtener=Obtener_Novedades($pagina);
		$FGC="";
		if ($Obtener["OK"]==1){
			$Obtener_Count=count($Obtener["Data"]);
			if ($Obtener_Count>0){
				for ($i = 0; $i < $Obtener_Count && $i < 4; $i++) {
					$Img= json_decode(stripslashes($Obtener["Data"][$i]["FB_pic"]));
					$FGC.='<div class="cuerpo_post"><div class="cuerpo_post_titulo  titulo_morado">'.($Obtener["Data"][$i]["operacion"]==1 ? "Alquiler" : "Venta")." - ".$Obtener["Data"][$i]["titulo"].'</div><img src="'.traducir_url($Img[0]).'" width="150" height="150" class="cuerpo_post_img" /><div class="cuerpo_post_descripcion">'.Cortar_TXT($Obtener["Data"][$i]["descripcion"],150).'</div><a href="'.Generar_Url_Post($Obtener["Data"][$i]["ID"],$Obtener["Data"][$i]["tipo_inmueble"],$Obtener["Data"][$i]["titulo"],$Obtener["Data"][$i]["region_provincia"]).'" class="boton">¡Conoce más!</a></div>'."\t"."\n";
					if ((($i+1)%2==0))$FGC.='<span class="stretch"></span>';
				}
			}
		}
		return array("OK" => $Obtener["OK"], "Data" => $FGC);;
	}
	function Generar_Ultimas_Propiedades($al_ve,$tipo,$reg,$pagina){
		$Obtener=Obtener_Ultimas_Propiedades($al_ve,Traducir_tipo($tipo),$reg,$pagina);
		$Obtener_Count=count($Obtener["Data"]);
		$FGC="";
		if ($Obtener["OK"]==1){
			for ($i = 0; $i < $Obtener_Count && $i < 7; $i++) {
				$Img= json_decode(stripslashes($Obtener["Data"][$i]["portada_pic"]));
				$FGC.='
				<li>
					<a href="'.Generar_Url_Post($Obtener["Data"][$i]["ID"],$Obtener["Data"][$i]["tipo_inmueble"],$Obtener["Data"][$i]["titulo"],$Obtener["Data"][$i]["region_provincia"]).'" target="_blank"><img src="'.traducir_url($Img[0]).'" width="675" height="253" alt="'.$Obtener["Data"][$i]["titulo"].'" />
					<div class="slides_descripcion"><img class="valign" alt="" src="">'.$Obtener["Data"][$i]["titulo"].'</div>
					</a><div class="separador"></div></li>';
			}
		}
		return array("OK" => $Obtener["OK"], "Data" => $FGC);
	}
	function Generar_Menu_Al_ve($prin,$dest,$expandir){
		return '
		<dl class="menu">
			<dt>
				<a href="#" class="menu_boton '.url_amigable($dest).' menu_expandir" title="" alt="">[+]</a>
				<a href="'.traducir_url($prin."/".url_amigable($dest)).'" title="" alt="">'.$dest.'</a>
			</dt>
			<dd class="'.url_amigable($dest).'" '.(($expandir == true) ? "style=\"display: none;\"": "").' >
				<a href="'.traducir_url($prin."/".url_amigable($dest)."/san_luis").'"  title="" alt="">- San Luis</a>
			</dd>
			<dd class="'.url_amigable($dest).'" '.(($expandir == true) ? "style=\"display: none;\"": "").' >
				<a href="'.traducir_url($prin."/".url_amigable($dest)."/otras_regiones").'"  title="" alt="">- Otras regiones</a>
			</dd>
		</dl>';
	}
	function Generar_404(){
		return '<div id="cuerpo_centro_centro"><p align="center"><img src="'.traducir_url("img/mvcVW.jpg").'" alt="404" alt=""><br/>&nbsp;<br/><span class="letras_negras">La propiedad no existe o ha sido borrada.</span></p><div class="mensaje"></div></div>';
	}
/*--------------------------------------------------------*/
	function Cortar_TXT($FGC,$Tam){
		$FGC=Limpiar_bbcode($FGC);
		if (strlen($FGC)>$Tam){
			$FGC=substr($FGC,0,$Tam)."... ";
		}
		return Caracteres_Esp($FGC);
	}
	function url_amigable($FGC) {
		$FGC=trim($FGC);
		$separador = "_";
		$FGC = str_replace(",","_",$FGC);
		$FGC = str_replace(".","_",$FGC);
		$FGC = strtolower($FGC);
		$FGC = strtr($FGC, "áéíóúÁñÑ", "aeiouAnN");
		$FGC = trim(preg_replace("[^ A-Za-z0-9]", "", $FGC));
		$FGC = preg_replace("#[ \t\n\r]+#", $separador, $FGC);
		return $FGC; 
	}
	function May_Men($FGC){
		$FGC=str_replace("<","&lt;",$FGC);
		$FGC=str_replace(">","&gt;",$FGC);
		return $FGC;
	}
	function Transformar_Fecha($fecha){
		$nombre_mes=array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre");
		$nombre_dia=array ("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
		$dia_semana=strftime ( "%w" ,strtotime($fecha));
		$dia_numero=strftime ( "%d" ,strtotime($fecha));
		$mes=strftime ( "%m" ,strtotime($fecha));
		$año=strftime ( "%Y" ,strtotime($fecha));
		return $nombre_dia[$dia_semana].", ".$dia_numero." de ".$nombre_mes[$mes-1]." de ".$año;
	}
	function _wordwrap($FGC){
		$split = explode(" ", $FGC);
		foreach($split as $key=>$value){
			if (strlen($value) > 20){
				$split[$key] = chunk_split($value, 5, "&#8203;");
			}
		}
		return implode(" ", $split);
	}
	function Escribir_Menu($FGC_id,$FGC_Insertar){
		global $GLOB_NoSeleccionar;
		$FGC='<div id="'.$FGC_id.'" class="menu" '.$GLOB_NoSeleccionar.'><dl id="Estilo"><dt id="Estilo_f"><img class="valign" alt="" src=""/>Estilo</dt><dd id="b"><img class="valign" alt="" src=""/>Negrita</dd><dd id="i"><img class="valign" alt="" src=""/>Italica</dd><dd id="u"><img class="valign" alt="" src=""/>Subrayado</dd><dd id="s"><img class="valign" alt="" src=""/>Tachado</dd></dl>';
		if ($FGC_Insertar=="1"){
			$FGC.='<dl id="Alinieacion"><dt id="Alinieacion_f"><img class="valign" alt="" src=""/>Alinieacion</dt><dd id="left"><img class="valign" alt="" src=""/>Izquierda</dd><dd id="center"><img class="valign" alt="" src=""/>Centrado</dd><dd id="right"><img class="valign" alt="" src=""/>Derecha</dd></dl><dl id="tamanio"><dt id="tamanio_f"><img class="valign" alt="" src=""/>Tama&ntilde;o</dt><dd id="13"><img class="valign" alt="" src=""/>Peque&ntilde;a</dd><dd id="16"><img class="valign" alt="" src=""/>Normal</dd><dd id="19"><img class="valign" alt="" src=""/>Grande</dd><dd id="21"><img class="valign" alt="" src=""/>Enorme</dd></dl><dl id="Insertar"><dt id="Insertar_f"><img class="valign" alt="" src=""/>Insertar</dt><dd id="link"><img class="valign" alt="" src=""/>Link</dd><dd id="imagen"><img class="valign" alt="" src=""/>Imagen</dd><dd id="youtube"><img class="valign" alt="" src=""/>V&iacute;deos Youtube</dd><dd id="vimeo"><img class="valign" alt="" src=""/>V&iacute;deos Vimeo</dd></dl>';
		}
		$FGC.='</div>';
		return $FGC;
	}
	function bbcode_deco($FGC){
		$FGC = comillas_deco($FGC);
		$FGC = str_replace("<","&lt;",$FGC);
		$FGC = str_replace(">","&gt;",$FGC);
		$FGC = preg_replace("/\[b\](.*)\[\/b\]/Usi", "<b>\\1</b>", $FGC);
		$FGC = preg_replace("/\[i\](.*)\[\/i\]/Usi", "<i>\\1</i>", $FGC);
		$FGC = preg_replace("/\[u\](.*)\[\/u\]/Usi", "<u>\\1</u>", $FGC);
		$FGC = preg_replace("/\[s\](.*)\[\/s\]/Usi", "<s>\\1</s>", $FGC);
		$FGC = preg_replace("/\[align=(.*)\](.*)\[\/align\]/Usi", "<div class=\"post_align_\\1\" >\\2</div>", $FGC);
		$FGC = preg_replace("/\[size=(.*)\](.*)\[\/size\]/Usi", "<span class=\"post_size_\\1\" >\\2</span>", $FGC);
		$FGC = preg_replace("/\[url=(.*)\](.*)\[\/url\]/Usi", "<a href=\"\\1\"   title=\"\" target=\"_blank\" rel=\"nofollow\"  class=\"post_link\">\\2</a>", $FGC);
		$FGC = preg_replace("/\[img=(.*)\]/Usi", "<img src=\"".traducir_url("\\1")."\" class=\"post_img\" />", $FGC);
		$FGC = str_replace("[vimeo]http://vimeo.com/","<iframe src=\"http://player.vimeo.com/video/",$FGC);
		$FGC = str_replace("[/vimeo]","?title=0&amp;byline=0&amp;portrait=0\" width=\"480\" height=\"360\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>",$FGC);
		$FGC = str_replace("[youtube]http://www.youtube.com/watch?v=","<iframe width=\"480\" height=\"360\" src=\"http://www.youtube.com/embed/",$FGC);
		$FGC = str_replace("[/youtube]","?wmode=transparent\" frameborder=\"0\" allowfullscreen></iframe>",$FGC);
		return Agregar_BR($FGC);
	}
	function comillas_deco($FGC){
		$FGC=str_replace("\\'","\"",$FGC);
		$FGC=str_replace("\\\"","&quot;",$FGC);
		return $FGC;
	}
	function Agregar_BR($FGC){
		return str_replace("\n","<br/>",$FGC);

		///return nl2br($FGC);
	}
	function Generar_descripcion($FGC){
		$partes=explode("\n",$FGC);
		return Limpiar_bbcode($partes[0]);
	}
	function Limpiar_bbcode($FGC){
		$FGC = comillas_deco($FGC);
		$FGC = str_replace("<","&lt;",$FGC);
		$FGC = str_replace(">","&gt;",$FGC);
		$FGC = preg_replace("/\[b\](.*)\[\/b\]/Usi", "\\1", $FGC);
		$FGC = preg_replace("/\[i\](.*)\[\/i\]/Usi", "\\1", $FGC);
		$FGC = preg_replace("/\[u\](.*)\[\/u\]/Usi", "\\1", $FGC);
		$FGC = preg_replace("/\[s\](.*)\[\/s\]/Usi", "\\1", $FGC);
		return Caracteres_Especiales_INV($FGC);
	}
	function Caracteres_Esp($FGC){
		$FGC = str_replace("¿","&iquest;",$FGC);
		$FGC = str_replace("á","&aacute;",$FGC);
		$FGC = str_replace("é","&eacute;",$FGC);
		$FGC = str_replace("í","&iacute;",$FGC);
		$FGC = str_replace("ó","&oacute;",$FGC);
		$FGC = str_replace("ú","&uacute;",$FGC);
		$FGC = str_replace("ñ","&ntilde;",$FGC);
		return $FGC;
	}
	function Caracteres_Especiales_INV($FGC){

		
		$FGC = str_replace("&iquest;","¿",$FGC);
		$FGC = str_replace("&aacute;","á",$FGC);
		$FGC = str_replace("&eacute;","é",$FGC);
		$FGC = str_replace("&iacute;","í",$FGC);
		$FGC = str_replace("&oacute;","ó",$FGC);
		$FGC = str_replace("&uacute;","ú",$FGC);
		$FGC = str_replace("&ntilde;","ñ",$FGC);
		return $FGC;
	}
	function Cargador_de_img($id,$titulo,$cant_img,$img_destino,$img_cropear,$cant_alto,$img_ancho) {
		return '
		<div class="cargador_img" id="cargador_img_slide_'.$id.'">
		<div class="medio_form"><span  class="texto_field">
			<img class="valign" alt="" src=""/>'.$titulo.'</span>
			<span class="texto_field cargador_img_opcion cargador_img_subir" id="slide_'.$id.'">
			<img class="valign" alt="" src=""/>
			<span class="Modern_Pics">]</span>
				Subir Imagen
			</span>
			</div>
			<br/>
			<ul class="cargador_img_lista_archivos">
			</ul>
			<span id="cargador_cant_img"      name="cargador_cant_img" style="display:none" >'.$cant_img.'</span>
			<span id="cargador_img_destino"   name="cargador_img_destino"  style="display:none" >'.$img_destino.'</span>
			<span id="cargador_img_cropear"   name="cargador_img_cropear"  style="display:none" >'.$img_cropear.'</span>
			<span id="cargador_cant_alto"     name="cargador_cant_alto"    style="display:none" >'.$cant_alto.'</span>
			<span id="cargador_img_ancho"     name="cargador_img_ancho"    style="display:none" >'.$img_ancho.'</span>
		</div>
		<br/>
		<span  class="error" id="cargador_img_slide_'.$id.'_err">&nbsp;</span>';
	}
	function Codigo_post($FGC){
	
		return zerofill(dechex($FGC),4);
	}
	function Codigo_post_deco($FGC){

		return hexdec($FGC);
	}
	function zerofill($FGC, $largo){
		$largo = (int)$largo;
		$relleno = '';
		if (strlen($FGC) < $largo) {
			$relleno = str_repeat('0', $largo - strlen($FGC));
		}
		return strtoupper($relleno.$FGC);
	}
	function Traducir_tipo($FGC){
		switch ($FGC) {
		case "casas":
			return 1;
		break;
		case "casa_quinta":
			return 2;
		break;
		case "departamentos":
			return 3;
		break;
		case "terrenos_y_lotes":
			return 4;
		break;
		case "Campos":
			return 5;
		break;
		case "oficinal_y_locales":
			return 6;
		break;
		case "negocios_e_industria":
			return 7;
		break;
		case "fondo_de_comercio":
			return 8;
		break;

		}
	}
	function Traducir_tipo_inv($FGC){
		switch ($FGC) {
		case 1:
			return "casas";
		break;
		case 2:
			return "casa_quinta";
		break;
		case 3:
			return "departamentos";
		break;
		case 4:
			return "terrenos_y_lotes";
		break;
		case 5:
			return "Campos";
		break;
		case 6:
			return "oficinal_y_locales";
		break;
		case 7:
			return "negocios_e_industria";
		break;
		case 8:
			return "fondo_de_comercio";
		break;

		}
	}
	function Generar_Url_Post($ID,$tipopropiedad,$titulo,$reg_prov){
		return traducir_url(url_amigable(Traducir_tipo_inv($tipopropiedad))."/".Codigo_post($ID)."/".url_amigable($reg_prov)."/".url_amigable($titulo)).".html";
	}
?>
