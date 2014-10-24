<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'var_glob.php'        ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?
	$meta_Keywords="Propiedades Destacadas,Novedades,Hipolito Yrigoyen 1080, San Luis,442-3965,444-3709";
	$meta_canonical="";
	$meta_Title="";
	$meta_Description="La Puerta de Ingreso a su Hogar";
	$orden = system("php sitemap.php >>salida.txt 2>>error.txt &");
?>

<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'part_arriba.php'     ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>

	<div id="cuerpo_centro" >
		<div id="cuerpo_centro_centro">
			<?/*=Generar_Slide();*/ ?>
			<? /*
			<div class="cuerpo_centro_titulo titulo_naranja">¿Qué Necesitas?</div>
				<form enctype="multipart/form-data" method="post" name="Form_Buscador" id="Form_Buscador" action="">
					<fieldset> 
						<div class="post_conteiner">
							<div class="cuerpo_post_titulo titulo_naranja">Buscador de propiedades</div>
							<div class="medio_form">
								<span  class="texto_field" id="nombre_err">Tipo de inmueble:</span>
								<select id="tipoinmueble" name="tipoinmueble">
								</select>
							</div>
							<div class="medio_form">
								<span  class="texto_field" id="nombre_err">Operación:</span>
								<select id="tipoinmueble" name="tipoinmueble">
								</select>
							</div>
							<br/><br/>
							<div class="medio_form">
								<span  class="texto_field" id="nombre_err">Región/Provincia:</span>
								<select id="tipoinmueble" name="tipoinmueble">
								</select>
							</div>
							<div class="medio_form">
								<span  class="texto_field" id="nombre_err">Moneda:</span>
								<select id="tipoinmueble" name="tipoinmueble">
								</select>
							</div>
							<div class="medio_form">
								<span  class="texto_field">Rango de precio</span>
								<input type="text" value="" title="" id="" name="" maxlength="85" class="mini_t"/>
								<span  class="texto_field">a</span>
								<input type="text" value="" title="" id="" name="" maxlength="85" class="mini_t"/>
							</div>
							<a href="#" class="boton boton_buscar float_left">BUSCAR</a>
							<div class="clear"></div>
						</div>
					</fieldset>
				</form>
				<form enctype="multipart/form-data" method="post" name="Form_Buscador" id="Form_Buscador" action="">
					<fieldset> 
						<div class="post_conteiner">
							<div class="cuerpo_post_titulo titulo_naranja">Buscar por código</div>
							<div class="medio_form">
								<span  class="texto_field" id="nombre_err">Código:</span>
								<input type="text" value="" title="" id="" name="" maxlength="85" />
							</div><a href="#" class="boton boton_buscar float_left">BUSCAR</a>
							<div class="clear"></div>
						</div>
					</fieldset>
				</form>
			<div class="separador"></div>
			*/ ?>
			<? 
				$temp_novedades=Generar_Novedades(0);
				if ($temp_novedades["OK"]==1){
			?>
			<div class="cuerpo_centro_titulo titulo_morado">Novedades</div><div class="post_conteiner">
				<?=$temp_novedades["Data"]; ?>
				<div id="cargando_mas_post" ><img class="valign" alt="" src=""/><a href="javascript:cargar_mas();" class="cargar_mas" title="">Cargar m&aacute;s Propiedades</a></div>
			</div>
			<? } ?>

			<div class="separador"></div>

			<div class="cuerpo_centro_titulo titulo_celeste">D&#243;nde estamos</div>
			<div class="post_conteiner">
					<div id="GoogleMap"></div>
					<div class="cuerpo_texto">
					<span class="letras_rojas">La Puerta de Ingreso a su Hogar</span><br/>
					<span class="letras_negras"><br/>
					Hipolito Yrigoyen 1080, San Luis<br/>
					Tel/Fax: (0266) 442-3965 / 444-3709<br/>
					</span>
					<br/>
					<span class="letras_azabache">Horario de atencion de 9 a 13 hs y de 17 a 20:30 hs.-</span><br/>
					</div>
					<span class="stretch"></span>
			</div>
			<div class="separador"></div>
			<div class="mensaje"></div>
		</div>
		<a href="javascript:$.scrollTo('#cabecera',800);" id="cuerpo_abajo"><img class="valign" alt="" src=""/>IR AL CIELO</a>
	</div>
	<script type="text/javascript">
		var D_G={p:1,};
		$(document).ready(function(){
				Google_Maps_initialize();
				Codificar_Direccion('Hipolito Yrigoyen 1080, San Luis, San Luis',"si")
				var intervalo; 
				intervalo = setInterval(slideshow_int, 5000);
		});
		function slideshow_int() {$('#slideshow .next').click();}
		function cargar_mas(){
			$("#cargando_mas_post").html("Cargando").addClass("cargando_mas_post_gif");
			var	La_Data='ajx='+ "CMN" +'&pag=' + encodeURIComponent(D_G.p);
			$.ajax({
				type: 'POST',
				url: "<? echo traducir_url("AJAX.php") ?>",
				data:La_Data,
				success: function(data) {
					console.log(data);
					var obj = jQuery.parseJSON(data);
					switch (obj.OK) {
					case 0:
						Mensaje ("Intentalo de nuevo");
					break;
					case 1:
						$("#cargando_mas_post").before(obj.Data);
						Mensaje ("Cargar m&aacute;s Propiedades");
						D_G.p=D_G.p+1;
					break;
					case 2:
						Mensaje("No hay m&aacute;s Propiedades para mostrar");
					break;
					}
				},
				error: function() {Mensaje ("Intentalo de nuevo");}
			});
			function Mensaje (msj) {
				$("#cargando_mas_post").html('<img class="valign" alt="" src=""/><a href="javascript:cargar_mas();" class="cargar_mas" title="">'+msj+'</a>').removeClass("cargando_mas_post_gif");
			}
		}
	</script>
	<script src="<? echo traducir_url('js/jquery.slideshow.js') ?>" type="text/javascript"></script>

<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'part_abajo.php'      ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
