<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?      require_once 'var_glob.php'      ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?
	$Obtener_temp=Obtener_Post(Codigo_post_deco($_GET["id"]));
	if ($Obtener_temp["OK"]==1){
		$Obtener=$Obtener_temp["Data"];
		$meta_Keywords=$Obtener[0]["tags"];
		$meta_canonical=$_GET["id"].".html";
		$meta_Title="- ".$Obtener[0]["titulo"];
		$meta_Description=Cortar_TXT($Obtener[0]["descripcion"],200);
		$Facebook_Pic_temp=json_decode(stripslashes($Obtener[0]["FB_pic"]));
		$Facebook_Pic=$Facebook_Pic_temp[0];
	}
?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ ?>
<?    require_once 'part_arriba.php'      ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ ?>
	<script src="<? echo traducir_url('js/jquery.lightbox-0.5.pack.js') ?>" type="text/javascript"></script>
	<div id="cuerpo_centro" >
		<?
			if ($Obtener_temp["OK"]==1){
				echo Generar_Post($Obtener[0]["ID"],$Obtener[0]["titulo"],$Obtener[0]["portada_pic"],$Obtener[0]["descripcion"],$Obtener[0]["localidad"],$Obtener[0]["direccion"],$Obtener[0]["region_provincia"],$Obtener[0]["suptotal"],$Obtener[0]["mtdefrente"],$Obtener[0]["supcubierta"],$Obtener[0]["ndeplantas"],$Obtener[0]["dormitorios"],$Obtener[0]["comodidades"],$Obtener[0]["seguridad"],$Obtener[0]["banios"],$Obtener[0]["lavanderia"],$Obtener[0]["terraza"],$Obtener[0]["jardin"],$Obtener[0]["patio"],$Obtener[0]["cochera"],$Obtener[0]["antiguedad"],$Obtener[0]["asador_quincho"],$Obtener[0]["cerrado_perimetral"],$Obtener[0]["gas"],$Obtener[0]["calefacccion"],$Obtener[0]["cloacas"],$Obtener[0]["piscina"],$Obtener[0]["org_publicos_cercanos"],$Obtener[0]["escritura"],$Obtener[0]["precio"],$Obtener[0]["moneda"],$Obtener[0]["operacion"],$Obtener[0]["galeria_pic"],$Obtener[0]["google_map_pic"]);
			}else{
				echo Generar_404(); 
			}
		?>
		<a href="javascript:$.scrollTo('#cabecera',800);" id="cuerpo_abajo"><img class="valign" alt="" src=""/>IR AL CIELO</a>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
				
				Google_Maps_initialize();
				Codificar_Direccion('<? echo $Obtener[0]["direccion"] ?>, $Obtener[0]["localidad"], <? echo $Obtener[0]["region_provincia"]?>',<? echo "\"".$Obtener[0]["mostra_gmap"]."\"" ?>)
				$('.pic a').lightBox({
					imageLoading: '<? echo traducir_url("img/loading.gif") ?>',
					imageBtnClose: '<? echo traducir_url("img/cerrar.gif") ?>',
					imageBtnPrev: '<? echo traducir_url("img/ant.gif") ?>',
					imageBtnNext: '<? echo traducir_url("img/sig.gif") ?>',
					containerResizeSpeed: 350,
					txtImage: 'Imagen',
					txtOf: 'de'
				});
		});
	</script>

<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'part_abajo.php'      ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
