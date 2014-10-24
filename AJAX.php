<?
	require("var_glob.php");
	switch($_POST['ajx']){
		/* ---> Subir Imagen   */
		case "IMG": 
			require_once("ModifiedImage.php");
			$carpeta = $_POST['dest'];
			$Nuevo_Path =$carpeta.Nombre_De_Img().".jpg";
			$image = new ModifiedImage($_FILES['pic']['tmp_name']);
			if(!empty($_FILES['pic']) && $_FILES['pic']['error'] == UPLOAD_ERR_OK) {
				if($_POST['crpr']=="si"){
					if (($image->getWidth() < $_POST['crpran']) || ($image->getHeight() < $_POST['crpral'])){
						echo resultado_final("imgmp");
					}else{
						if($image->getWidth() < $image->getHeight()){
							// imagen alta
							$image->resizeToWidth($_POST['crpran']);
						}else{
							// imagen ancha
							if ($_POST['crpran'] <= $_POST['crpral']){
								$image->resizeToHeight($_POST['crpral']);	
							}else{
								$image->resizeToWidth($_POST['crpran']);
							}
						}
						$image->save($Nuevo_Path);
						echo resultado_final_img($Nuevo_Path,$image->getWidth(),$image->getHeight());
						
					}
				}elseif($_POST['crpr']=="no"){
					if($image->getWidth() > $_POST['crpran']){
						$image->resizeToWidth($_POST['crpran']);
					}

					if($image->getHeight() > $_POST['crpral']){
						$image->resizeToHeight($_POST['crpral']);
					}
					$image->save($Nuevo_Path);
					echo resultado_final_img($Nuevo_Path,$image->getWidth(),$image->getHeight());
				}else{
					if ($image->getWidth()>600){
						$image->resizeToWidth(600);
					}
					if ($image->getHeight()>500){
						$image->resizeToHeight(500);
					}
					$image->save($Nuevo_Path);
					echo resultado_final_img($Nuevo_Path,$image->getWidth(),$image->getHeight());
				}
			}else{
				echo resultado_final("error");
			}
		break;
		case "CROP":
			require_once("ModifiedImage.php");
			$image = new ModifiedImage($_POST['CROP_IMG']);
			$Img_Ratio_w= $_POST['CROP_un_W'] / $image->getWidth();
			$Img_Ratio_h= $_POST['CROP_un_H'] / $image->getHeight();
			$Inicio_y=$_POST['CROP_Y']*$Img_Ratio_w;
			$Inicio_x=$_POST['CROP_X']*$Img_Ratio_h;
			if ($_POST['CROP_RATIO']=="si"){
				$tamanio_w=$_POST['CROP_W'];
				$tamanio_h=$_POST['CROP_H'];
			}else{
				$tamanio_w=$_POST['CROP_W']/$Img_Ratio_h;
				$tamanio_h=$_POST['CROP_H']/$Img_Ratio_w;
			}
			Cortar_IMG($_POST['CROP_IMG'],$Inicio_x,$Inicio_y,$tamanio_w,$tamanio_h);
		break;
		case "EIMG":
			if(file_exists($_POST['Img_eli'])){ 
				if(unlink($_POST['Img_eli']))echo resultado_final("ok");
			} 
		break;
		/* ---> Mandar Mensaje */
		case "AG":
			echo json_encode(array("Exito"=> Agregar_Mensaje(May_Men($_POST['nombre']),May_Men($_POST['email']),May_Men($_POST['telefono']),May_Men($_POST['asunto']),May_Men($_POST['mensaje']),FechaStr(),HoraStr())));
		break;
		/* ---> Leer Mensaje */
		case "LMSG":
			echo Generar_Mensaje();
		break;
		/* ---> Borrar Mensaje */
		case "BMSG":
			echo resultado_final(Borrar_Mensaje($_POST['id_post']));
		break;
		/* ---> Pedir Info */
		case "PLI":
			echo json_encode(Obtener_info($_POST['INF']));
		break;
		/* ---> Pedir Preview Info */
		case "PPI":
			echo Generar_Info($_POST['titulo'],$_POST['contenido_textarea']);
		break;
		/* ---> Guardar toda info  */
		case "GPI":
			echo json_encode(Guardar_Info($_POST['info_id'],$_POST['titulo'],Generar_descripcion($_POST['contenido_textarea']),$_POST['contenido_textarea'],$_POST['tag']));
		break;
		/* ---> Pedir Preview Post */
		case "PPP":
			echo Generar_Post(0,$_POST["titulo"],$_POST["cargador_img_slide_Portada"],$_POST["descripcion_textarea"],$_POST["localidad"],$_POST["direccion"],$_POST["reg_prov"],$_POST["suptotal"],$_POST["mtdefrente"],$_POST["supcubierta"],$_POST["ndeplantas"],$_POST["dormitorios"],$_POST["comodidades"],$_POST["seguridad"],$_POST["banios"],$_POST["lavanderia"],$_POST["terraza"],$_POST["jardin"],$_POST["patio"],$_POST["cochera"],$_POST["antiguedad"],$_POST["asador_quincho"],$_POST["cerrado_perimetral"],$_POST["gas"],$_POST["calefacccion"],$_POST["cloacas"],$_POST["piscina"],$_POST["org_publicos_cercanos"],$_POST["escritura"],$_POST["precio"],$_POST["moneda"],$_POST["operacion"],$_POST["cargador_img_slide_Galeria"],$_POST["cargador_img_slide_Google_M"]);
		break;
		/* ---> Pedir Post Borrrar */
		case "PPB":
			$Datos=Obtener_Post(Codigo_post_deco($_POST['codpost']));
			if ($Datos["OK"]==1){
				$Obtener=$Datos["Data"];
				echo json_encode(array("OK" => "1", "post" => Generar_Post($Obtener[0]["ID"],$Obtener[0]["titulo"],$Obtener[0]["portada_pic"],$Obtener[0]["descripcion"],$Obtener[0]["localidad"],$Obtener[0]["direccion"],$Obtener[0]["region_provincia"],$Obtener[0]["suptotal"],$Obtener[0]["mtdefrente"],$Obtener[0]["supcubierta"],$Obtener[0]["ndeplantas"],$Obtener[0]["dormitorios"],$Obtener[0]["comodidades"],$Obtener[0]["seguridad"],$Obtener[0]["banios"],$Obtener[0]["lavanderia"],$Obtener[0]["terraza"],$Obtener[0]["jardin"],$Obtener[0]["patio"],$Obtener[0]["cochera"],$Obtener[0]["antiguedad"],$Obtener[0]["asador_quincho"],$Obtener[0]["cerrado_perimetral"],$Obtener[0]["gas"],$Obtener[0]["calefacccion"],$Obtener[0]["cloacas"],$Obtener[0]["piscina"],$Obtener[0]["org_publicos_cercanos"],$Obtener[0]["escritura"],$Obtener[0]["precio"],$Obtener[0]["moneda"],$Obtener[0]["operacion"],$Obtener[0]["galeria_pic"],$Obtener[0]["google_map_pic"]), "direccion" =>  $Obtener[0]["direccion"], "region_provincia" => $Obtener[0]["region_provincia"], "mostra_gmap" => $Obtener[0]["mostra_gmap"]));
			}else{
				echo json_encode(array("OK" => "0"));				
			}
		break;
		/* ---> Borrar Post */
		case "LPB":
			echo resultado_final(Borrar_Post(Codigo_post_deco($_POST['codpost'])));
		break;
		/* ---> Mostrar Post */
		case "PPB":
			$Datos=Obtener_Post(Codigo_post_deco($_POST['codpost']));
			if ($Datos["OK"]==1){
				$Obtener=$Datos["Data"];
				echo json_encode(array("OK" => "1", "post" => Generar_Post($Obtener[0]["ID"],$Obtener[0]["titulo"],$Obtener[0]["portada_pic"],$Obtener[0]["descripcion"],$Obtener[0]["localidad"],$Obtener[0]["direccion"],$Obtener[0]["region_provincia"],$Obtener[0]["suptotal"],$Obtener[0]["mtdefrente"],$Obtener[0]["supcubierta"],$Obtener[0]["ndeplantas"],$Obtener[0]["dormitorios"],$Obtener[0]["comodidades"],$Obtener[0]["seguridad"],$Obtener[0]["banios"],$Obtener[0]["lavanderia"],$Obtener[0]["terraza"],$Obtener[0]["jardin"],$Obtener[0]["patio"],$Obtener[0]["cochera"],$Obtener[0]["antiguedad"],$Obtener[0]["asador_quincho"],$Obtener[0]["cerrado_perimetral"],$Obtener[0]["gas"],$Obtener[0]["calefacccion"],$Obtener[0]["cloacas"],$Obtener[0]["piscina"],$Obtener[0]["org_publicos_cercanos"],$Obtener[0]["escritura"],$Obtener[0]["galeria_pic"],$Obtener[0]["google_map_pic"]), "direccion" =>  $Obtener[0]["direccion"], "region_provincia" => $Obtener[0]["region_provincia"], "mostra_gmap" => $Obtener[0]["mostra_gmap"]));
			}else{
				echo json_encode(array("OK" => "0"));
			}
		break;
		/* ---> Pedir todo el Post */
		case "PTP":
			$Datos=Obtener_Post(Codigo_post_deco($_POST['codpost']));
			if ($Datos["OK"]==1){
				$Obtener=$Datos["Data"];
				echo json_encode(array("OK" => "1", "post" => $Obtener[0]));
			}else{
				echo json_encode(array("OK" => "0"));
			}
		break;
		/* ---> Guardar Correo */
		case "AEC":
			echo json_encode(Guardar_Correo($_POST["correo"])); 
		break;
		/* ---> Pedir Correo */
		case "PEC":
			echo json_encode(Obtener_Correo()); 
		break;
		/* ---> Agregar Post */
		case "AEP":
			echo json_encode(Agregar_Propiedad($_POST['titulo'],$_POST['descripcion_textarea'],$_POST['localidad'],$_POST['suptotal'],$_POST['mtdefrente'],$_POST['supcubierta'],$_POST['ndeplantas'],$_POST['dormitorios'],$_POST['comodidades'],$_POST['seguridad'],$_POST['banios'],$_POST['lavanderia'],$_POST['terraza'],$_POST['jardin'],$_POST['patio'],$_POST['cochera'],$_POST['antiguedad'],$_POST['asador_quincho'],$_POST['cerrado_perimetral'],$_POST['gas'],$_POST['calefacccion'],$_POST['cloacas'],$_POST['piscina'],$_POST['org_publicos_cercanos'],$_POST['escritura'],$_POST["precio"],$_POST["moneda"],$_POST["operacion"],$_POST["tipoinmueble"],$_POST["direccion"],$_POST["reg_prov"],$_POST["mostra_gmap"],$_POST["cargador_img_slide_Google_M"],$_POST["cargador_img_slide_Portada"],$_POST["cargador_img_slide_Galeria"],$_POST["cargador_img_slide_FB_Pic"],$_POST["destacado"],$_POST["tag"]));
		break;
		/* ---> Update Post */
		case "EEP":
			echo json_encode(Editar_Propiedad($_POST['info_id'], $_POST['titulo'],$_POST['descripcion_textarea'],$_POST['localidad'],$_POST['suptotal'],$_POST['mtdefrente'],$_POST['supcubierta'],$_POST['ndeplantas'],$_POST['dormitorios'],$_POST['comodidades'],$_POST['seguridad'],$_POST['banios'],$_POST['lavanderia'],$_POST['terraza'],$_POST['jardin'],$_POST['patio'],$_POST['cochera'],$_POST['antiguedad'],$_POST['asador_quincho'],$_POST['cerrado_perimetral'],$_POST['gas'],$_POST['calefacccion'],$_POST['cloacas'],$_POST['piscina'],$_POST['org_publicos_cercanos'],$_POST['escritura'],$_POST["precio"],$_POST["moneda"],$_POST["operacion"],$_POST["tipoinmueble"],$_POST["direccion"],$_POST["reg_prov"],$_POST["mostra_gmap"],$_POST["cargador_img_slide_Google_M"],$_POST["cargador_img_slide_Portada"],$_POST["cargador_img_slide_Galeria"],$_POST["cargador_img_slide_FB_Pic"],$_POST["destacado"],$_POST["tag"]));
		break;
		/* ---> LOGIN */
		case "LOGIN":
			echo json_encode(Login($_POST['usuario'],$_POST['contrasenia']));
		break;
		/* ---> Pedir mas post */
		case "CMP":
			echo json_encode(Generar_Ultimas_Propiedades($_POST['al_ve'],$_POST['tipo'],$_POST['reg'],$_POST['pag']));
		break;
		/* ---> Pedir mas novedades */
		case "CMN":
			echo json_encode(Generar_Novedades($_POST['pag']));
		break;

		case "CRONOJOB":
			echo "Listo_1";
			return "Listo";
		break;
	}
	
?>