<? 	if( !defined( '_AUTOGAN' ) && !defined( '_VALID_VVM' ) ) die( 'Restricted access' ); ?>

<?
	function Conectar(){
		if (Bandera("online")){
			$servidor="localhost";
			$usuario="petrinoinmobil01";
			$password="tachibana";
			$base_datos="petrinoinmobil01";
		}else{
			if (Bandera("offline-online")){
				$servidor="";
				$usuario="";
				$password="";
				$base_datos="";
			}else{
				$servidor="localhost";
				$usuario="root";
				$password="";
				$base_datos="petrinoinmobil01";
			}
		}
		if (!($link=mysql_connect($servidor,$usuario,$password))){
			$link = false;
		}
		if($link<>false && !(mysql_select_db($base_datos,$link))){
			$link=false;
		}
		return $link;
	}
/*-----------------------------------------------------------*/
	function Agregar_Mensaje($nombre,$email,$telefono,$asunto,$mensaje,$fecha,$hora){
		$FBD_CON=Conectar();
		if($FBD_CON<>false){
			$sql=mysql_query("INSERT INTO `contacto` (`ID` ,`nombre` ,`email` ,`asunto` ,`telefono`, `mensaje` ,`fecha` ,`hora`)VALUES (NULL ,  '$nombre',  '$email',  '$asunto',  '$telefono', '$mensaje',  '$fecha',  '$hora');",$FBD_CON);
			if(mysql_affected_rows()>0){
				Mandar_Mail($nombre,$email,$telefono,$asunto,$mensaje,$fecha,$hora);
				return 1;
			}else{
				return 0;
			}
			mysql_close($FBD_CON);
		}
	}
	function Agregar_Propiedad($titulo,$descripcion,$localidad,$suptotal,$mtdefrente,$supcubierta,$ndeplantas,$dormitorios,$comodidades,$seguridad,$banios,$lavanderia,$terraza,$jardin,$patio,$cochera,$antiguedad,$asador_quincho,$cerrado_perimetral,$gas,$calefacccion,$cloacas,$piscina,$org_publicos_cercanos,$escritura,$precio,$moneda,$operacion,$tipo_inmueble,$direccion,$region_provincia,$mostra_gmap,$google_map_pic,$portada_pic,$galeria_pic,$FB_pic,$destacado,$tags){
		$FBD_CON=Conectar();
		if($FBD_CON<>false){
			$sql=mysql_query("INSERT INTO  `petrinoinmobil01`.`propiedades` (`ID` ,`titulo` ,`descripcion` ,`localidad` ,`suptotal` ,`mtdefrente` ,`supcubierta` ,`ndeplantas` ,`dormitorios` ,`comodidades` ,`seguridad` ,`banios` ,`lavanderia` ,`terraza` ,`jardin` ,`patio` ,`cochera` ,`antiguedad` ,`asador_quincho` ,`cerrado_perimetral` ,`gas` ,`calefacccion` ,`cloacas` ,`piscina` ,`org_publicos_cercanos` ,`escritura` ,`precio` ,`moneda` ,`operacion` ,`tipo_inmueble` ,`direccion` ,`region_provincia` ,`google_map_pic` ,`mostra_gmap` ,`portada_pic` ,`galeria_pic` ,`FB_pic` ,`destacado` ,`tags`) VALUES ( 'NULL' ,  '$titulo' ,'$descripcion' ,'$localidad' ,'$suptotal' ,'$mtdefrente' ,'$supcubierta' ,'$ndeplantas' ,'$dormitorios' ,'$comodidades' ,'$seguridad' ,'$banios' ,'$lavanderia' ,'$terraza' ,'$jardin' ,'$patio' ,'$cochera' ,'$antiguedad' ,'$asador_quincho' ,'$cerrado_perimetral' ,'$gas' ,'$calefacccion' ,'$cloacas' ,'$piscina' ,'$org_publicos_cercanos' ,'$escritura' ,'$precio' ,'$moneda' ,'$operacion' ,'$tipo_inmueble' ,'$direccion' ,'$region_provincia' ,'$google_map_pic' ,'$mostra_gmap' ,'$portada_pic' ,'$galeria_pic' ,'$FB_pic' ,'$destacado' ,'$tags');",$FBD_CON);
			if(mysql_affected_rows()>0){
				return array("OK" => 1, "Data" => Generar_Url_Post(mysql_insert_id(),$tipo_inmueble,$titulo,$region_provincia));
			}else{
				return array("OK" => 0, "Data" => "");
			}
			mysql_close($FBD_CON);
		}else{
			return array("OK" => 3, "Data" => "");
		}
	}
/*-----------------------------------------------------------*/
	function Guardar_Info($ID,$titulo,$descripcion,$contenido,$tags){
		$FBD_CON=Conectar();
		if($FBD_CON<>false){
			$Fecha=FechaStr();
			$Hora=HoraStr();
			$sql=mysql_query("UPDATE  `info` SET  `titulo` =  '$titulo', `descripcion` =  '$descripcion', `contenido` =  '$contenido', `tags` =  '$tags' WHERE  `info`.`ID` =$ID LIMIT 1 ;",$FBD_CON);
			return array("status"=> 1);
		}else{
			return array("status"=> 2);
		}
		mysql_close($FBD_CON);
	}
	function Guardar_Correo($correo){
		$FBD_CON=Conectar();
		if($FBD_CON<>false){
			$Fecha=FechaStr();
			$Hora=HoraStr();
			$sql=mysql_query("UPDATE  `correo` SET  `correo` =  '$correo' WHERE  `correo`.`ID` =1 ;",$FBD_CON);
			return array("OK"=> 1);
		}else{
			return array("OK"=> 2);
		}
		mysql_close($FBD_CON);
	}
/*-----------------------------------------------------------*/
	function Editar_Propiedad($ID,$titulo,$descripcion,$localidad,$suptotal,$mtdefrente,$supcubierta,$ndeplantas,$dormitorios,$comodidades,$seguridad,$banios,$lavanderia,$terraza,$jardin,$patio,$cochera,$antiguedad,$asador_quincho,$cerrado_perimetral,$gas,$calefacccion,$cloacas,$piscina,$org_publicos_cercanos,$escritura,$precio,$moneda,$operacion,$tipo_inmueble,$direccion,$region_provincia,$mostra_gmap,$google_map_pic,$portada_pic,$galeria_pic,$FB_pic,$destacado,$tags){
		$FBD_CON=Conectar();
		if($FBD_CON<>false){

			$sql=mysql_query("UPDATE  `propiedades` SET  `titulo`  = '$titulo', `descripcion`  = '$descripcion', `localidad` = '$localidad', `suptotal` = '$suptotal', `mtdefrente` = '$mtdefrente', `supcubierta` = '$supcubierta', `ndeplantas` = '$ndeplantas', `dormitorios` = '$dormitorios', `comodidades` = '$comodidades', `seguridad` = '$seguridad', `banios` = '$banios', `lavanderia` = '$lavanderia', `terraza` = '$terraza', `jardin` = '$jardin', `patio` = '$patio', `cochera` = '$cochera', `antiguedad` = '$antiguedad', `asador_quincho` = '$asador_quincho', `cerrado_perimetral` = '$cerrado_perimetral', `gas` = '$gas', `calefacccion` = '$calefacccion', `cloacas` = '$cloacas', `piscina` = '$piscina', `org_publicos_cercanos` = '$org_publicos_cercanos', `escritura` = '$escritura', `precio`  = '$precio', `moneda`  = '$moneda', `operacion`  = '$operacion', `tipo_inmueble`  = '$tipo_inmueble', `direccion`  = '$direccion', `region_provincia`  = '$region_provincia', `mostra_gmap` = '$mostra_gmap', `google_map_pic`  = '$google_map_pic', `portada_pic`  = '$portada_pic', `galeria_pic`  = '$galeria_pic', `FB_pic`  = '$FB_pic', `destacado`  = '$destacado', `tags` = '$tags' WHERE  `ID` ='$ID'",$FBD_CON);
			if(mysql_affected_rows()>0){
				return array("OK" => 1, "Data" => Generar_Url_Post($ID,$tipo_inmueble,$titulo,$region_provincia));
			}else{
				return array("OK" => 0, "Data" => "");
			}
			mysql_close($FBD_CON);
		}else{
			return array("OK" => 0, "Data" => "");
		}
	}
/*-----------------------------------------------------------*/
	function Obtener_Mensaje(){
		$FBD_CON=Conectar();
		if ($FBD_CON<>false){
			$sql=mysql_query("SELECT * FROM `contacto` ORDER BY `fecha` DESC , `hora` DESC",$FBD_CON);
			$FBD=array();
			while($row=mysql_fetch_array($sql)){
				array_push($FBD,array("ID" => $row["ID"],"nombre" => $row["nombre"] ,"email" => $row["email"] ,"asunto" => $row["asunto"] ,"telefono" => $row["telefono"] ,"mensaje" => $row["mensaje"] ,"fecha" => $row["fecha"] ,"hora" => $row["hora"]));
			}
		}else{
			$FBD="";
		}
		return $FBD;
		mysql_close($FBD_CON);
	}
	function Obtener_info($dato){
		$FBD_CON=Conectar();
		if ($FBD_CON<>false){
			switch ($dato) {
				case "servicios":
					$id=1;
				break;
				case "quienes_somos":
					$id=2;
				break;
				case "terminosycondiciones":
					$id=3;
				break;
			}
			$sql=mysql_query("SELECT * FROM  `info` WHERE  `ID` =$id ORDER BY  `ID` DESC",$FBD_CON);
			if(mysql_affected_rows()>0) {
				$FBD=array();
				while($row=mysql_fetch_array($sql)){
					array_push($FBD,array("ID" => $row["ID"],"titulo" => $row["titulo"] ,"descripcion" => $row["descripcion"] , "contenido" => $row["contenido"] , "tags" => $row["tags"]));
				}
				return array("OK" => 1, "Data" => $FBD);
			}else{
				return array("OK" => 0, "Data" => "");
			}
		}else{
			return array("OK" => 0, "Data" => "");
		}
		mysql_close($FBD_CON);
	}
	function Obtener_Correo(){
		$FBD_CON=Conectar();
		if ($FBD_CON<>false){
			$sql=mysql_query("SELECT  `correo` FROM  `correo` WHERE  `ID` =1",$FBD_CON);
			if(mysql_affected_rows()>0) {
				$FBD=array();
				while($row=mysql_fetch_array($sql)){
					return array("OK" => 1, "Data" => $row["correo"]);
				}
			}else{
				return array("OK" => 0, "Data" => "");
			}
		}else{
			return array("OK" => 0, "Data" => "");
		}
		mysql_close($FBD_CON);
	}
	function Obtener_Destacado(){
		$FBD_CON=Conectar();
		if ($FBD_CON<>false){
			$sql=mysql_query("SELECT  `ID` ,  `titulo`, `tipo_inmueble`,  `region_provincia` ,  `portada_pic`, `operacion` FROM  `propiedades` WHERE  `destacado` ='si'  ORDER BY  `ID` DESC",$FBD_CON);
			$FBD=array();
			while($row=mysql_fetch_array($sql)){
				array_push($FBD,array("ID" => $row["ID"],"titulo" => $row["titulo"] ,"tipo_inmueble" => $row["tipo_inmueble"],"operacion" => $row["operacion"],"region_provincia" => $row["region_provincia"] , "portada_pic" => $row["portada_pic"]));
			}
			return array("OK" => 1, "Data" => $FBD);
		}else{
			return array("OK" => 0, "Data" => "");
		}
		
		mysql_close($FBD_CON);
	}
	function Obtener_Novedades($pagina){
		$FBD_CON=Conectar();
		if ($FBD_CON<>false){
			$sql=mysql_query("SELECT  `ID` ,  `titulo` ,  `descripcion` ,`tipo_inmueble`,  `region_provincia`, `operacion`, `FB_pic` FROM  `propiedades` ORDER BY  `ID` DESC LIMIT ".($pagina*6).", 6",$FBD_CON);
			$FBD=array();
			if(mysql_num_rows($sql)>0){
				while($row=mysql_fetch_array($sql)){
					array_push($FBD,array("ID" => $row["ID"],"titulo" => $row["titulo"] ,"descripcion" => $row["descripcion"] , "tipo_inmueble" => $row["tipo_inmueble"], "operacion" => $row["operacion"], "region_provincia" => $row["region_provincia"] , "FB_pic" => $row["FB_pic"]));
				}
				return array("OK" => 1, "Data" => $FBD);
			}else{
				return array("OK" => 2, "Data" => "");
			}
		}else{
			return array("OK" => 0, "Data" => "");
		}
		mysql_close($FBD_CON);
	}
	function Obtener_Post($id){
		$FBD_CON=Conectar();
		if ($FBD_CON<>false){
			$sql=mysql_query("SELECT * FROM  `propiedades` WHERE  `ID` =$id",$FBD_CON);
			$FBD=array();
			if(mysql_num_rows($sql)>0){
				while($row=mysql_fetch_array($sql)){
					array_push($FBD,array("ID" => $row["ID"], "titulo" => $row["titulo"], "descripcion" => $row["descripcion"], "localidad" => $row["localidad"],"suptotal" => $row["suptotal"],"mtdefrente" => $row["mtdefrente"],"supcubierta" => $row["supcubierta"],"ndeplantas" => $row["ndeplantas"],"dormitorios" => $row["dormitorios"],"comodidades" => $row["comodidades"],"seguridad" => $row["seguridad"],"banios" => $row["banios"],"lavanderia" => $row["lavanderia"],"terraza" => $row["terraza"],"jardin" => $row["jardin"],"patio" => $row["patio"],"cochera" => $row["cochera"],"antiguedad" => $row["antiguedad"],"asador_quincho" => $row["asador_quincho"],"cerrado_perimetral" => $row["cerrado_perimetral"],"gas" => $row["gas"],"calefacccion" => $row["calefacccion"],"cloacas" => $row["cloacas"],"piscina" => $row["piscina"],"org_publicos_cercanos" => $row["org_publicos_cercanos"],"escritura" => $row["escritura"], "precio" => $row["precio"], "moneda" => $row["moneda"], "operacion" => $row["operacion"], "tipo_inmueble" => $row["tipo_inmueble"], "direccion" => $row["direccion"], "region_provincia" => $row["region_provincia"], "mostra_gmap" =>$row["mostra_gmap"],"google_map_pic" => $row["google_map_pic"], "portada_pic" => $row["portada_pic"], "galeria_pic" => $row["galeria_pic"], "FB_pic" => $row["FB_pic"], "destacado" => $row["destacado"], "tags" => $row["tags"]));
				}
				return array("OK" => 1, "Data" => $FBD);
			}else{
				return array("OK" => 0, "Data" => "");
			}
		}else{
			return array("OK" => 0, "Data" => "");
		}
		return $FBD;
		mysql_close($FBD_CON);
	}
	function Obtener_Contrasenia($usuario){
		$FBD_CON=Conectar();
		if ($FBD_CON<>false){
			$sql=mysql_query("SELECT  `contrasenia` FROM  `usuarios` WHERE  `usuario` LIKE  '$usuario' LIMIT 0 , 1",$FBD_CON);
			$FBD=array();
			while($row=mysql_fetch_array($sql)){
				array_push($FBD,array("contrasenia" => $row["contrasenia"]));
			}
			return array("OK" => 1, "Data" => $FBD);
		}else{
			return array("OK" => 0, "Data" => "");
		}
		mysql_close($FBD_CON);
	}
	function Obtener_Ultimas_Propiedades($al_ve,$tipo,$reg,$pagina){
		$FBD_CON=Conectar();
		$pagina=$pagina*6;
		if ($FBD_CON<>false){
			if ($reg=="san_luis"){
				$sql_query="SELECT `ID` ,  `titulo` ,  `portada_pic`, `tipo_inmueble`, `region_provincia`   FROM  `propiedades` WHERE  `operacion` =$al_ve AND  `tipo_inmueble` =$tipo AND  `region_provincia` LIKE  '%San Luis%' and localidad LIKE '%San Luis%' ORDER BY  `ID` DESC LIMIT $pagina , 6";
			}else{
				$sql_query="SELECT `ID` ,  `titulo` ,  `portada_pic`, `tipo_inmueble`, `region_provincia`   FROM  `propiedades` WHERE  `operacion` =$al_ve AND  `tipo_inmueble` =$tipo AND  `region_provincia` NOT LIKE  '%San Luis%' and localidad NOT LIKE '%San Luis%'  ORDER BY  `ID` DESC LIMIT $pagina , 6";
			}
			//echo $sql_query;
			$sql=mysql_query($sql_query,$FBD_CON);
			if(mysql_affected_rows()>0) {
				$FBD=array();
				while($row=mysql_fetch_array($sql)){
					array_push($FBD,array("ID" => $row["ID"],"titulo" => $row["titulo"],"tipo_inmueble" => $row["tipo_inmueble"],"region_provincia" => $row["region_provincia"],"portada_pic" => $row["portada_pic"]));
				}
				return array("OK" => 1, "Data" => $FBD);
			}else{
				return array("OK" => 2, "Data" => "");
			}
		}else{
			return array("OK" => 0, "Data" => "");
		}
		mysql_close($FBD_CON);
	}
	function Obtener_Sitemap(){
		$FBD_CON=Conectar();
		if ($FBD_CON<>false){
			$sql=mysql_query("SELECT `ID` ,  `titulo` ,  `galeria_pic`, `tipo_inmueble`, `region_provincia` FROM  `propiedades`",$FBD_CON);
			$FBD=array("");
			if(mysql_num_rows($sql)>0){
				while($row=mysql_fetch_array($sql)){
					array_push($FBD,array("url" => $row["ID"].".html","ultima_modificacion" => FechaStr(),"prioridad" => 1.0));
				}
				return array("OK" => 1, "Data" => $FBD);
			}else{
				return array("OK" => 0, "Data" => "");
			}
		}else{
			return array("OK" => 0, "Data" => "");
		}
		return $FBD;
		mysql_close($FBD_CON);
		//  
	}
/*-----------------------------------------------------------*/
	function Borrar_Mensaje($id){
		$FBD_CON=Conectar();
		$sql=mysql_query("DELETE FROM `contacto` WHERE `contacto`.`ID` = '$id' LIMIT 1",$FBD_CON);
		mysql_close($FBD_CON);
		return 1;
	}
	function Borrar_Post($id){
		$FBD_CON=Conectar();
		$sql=mysql_query("DELETE FROM `propiedades` WHERE `propiedades`.`ID` = '$id' LIMIT 1",$FBD_CON);
		mysql_close($FBD_CON);
		return 1;
	}
/*-----------------------------------------------------------*/	
	function Login($usuario,$contra){
		$Obtener=Obtener_Contrasenia($usuario);
		$Obtener_count=count($Obtener["Data"]);
		if ($Obtener_count>0){
			if ($contra==$Obtener["Data"][0]["contrasenia"]){
				return array("user" =>$usuario,"verf" => Verificacion($usuario));
			}else{
				return array("user" =>"","verf" => "INVALIDO");
			}

		}else{
			return array("user" =>"","verf" => "INVALIDO");
		}
	}
	function Verificacion($usuario){
		$Obtener=Obtener_Contrasenia($usuario);
		if($Obtener["OK"]==1){
			$Obtener_count=count($Obtener["Data"]);
			if ($Obtener_count>0){
				return md5($usuario.$Obtener["Data"][0]["contrasenia"].FechaStr()); 
			}else{
				return "INVALIDO";
			}
		}else{
			return "INVALIDO";
		}
	}
?> 