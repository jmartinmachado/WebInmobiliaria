<?
	$expire=time()+60*60*24*30;
	setcookie("user", "Petrino", $expire);
?>

<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'var_glob.php'        ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?
	$meta_Keywords="";
	$meta_canonical="";
	$meta_Title="";
	$meta_Description=""
?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?> 
<?    require_once 'part_arriba.php'     ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>


	<link href="<?=traducir_url('css/admin.css') ?>" rel="stylesheet" type="text/css"> 
	<link href="<?=traducir_url('css/jquery.Jcrop.min.css') ?>" rel="stylesheet" type="text/css"> 
	
	<? if (bandera("optimizado")){ ?>
	
	<script src="<?=traducir_url('js/jquery.librerias.comprimidas.js') ?>" type="text/javascript"></script>
	<? }else{ ?>
	
	<script src="<?=traducir_url('js/json2.js') ?>" type="text/javascript"></script>
	<script src="<?=traducir_url('js/jquery.cookie.js') ?>" type="text/javascript"></script>
	<script src="<?=traducir_url('js/jquery.selectrange.js') ?>" type="text/javascript"></script>
	<script src="<?=traducir_url('js/jquery.fieldselection.js') ?>"  type="text/javascript"></script>	
	<script src="<?=traducir_url('js/jquery.lightbox-0.5.pack.js') ?>" type="text/javascript"></script>
	<script src="<?=traducir_url('js/jquery.Jcrop.min.js') ?>" type="text/javascript"></script>
	<script src="<?=traducir_url('js/jquery.color.js') ?>" type="text/javascript"></script>
	<? } ?>

	<div id="cuerpo_centro" >
		<? /*if ( (isset($_COOKIE['Login_Petrino_Veri'])) && ($_COOKIE['Login_Petrino_Veri']==Verificacion($_COOKIE['Login_Petrino_User'])) ) { */ ?>
		<? if ( true) {  ?>
		<div id="cuerpo_centro_centro">
			<div style="text-align:right"><a href="javascript:Login_Salir()" style="color:#000"><span class="Modern_Pics">X</span>Salir</a></div>
			<div class="cuerpo_centro_titulo titulo_celeste">PANEL DE CONTROL</div>
			<form >
				<fieldset id="botonera">
					<input type="button" onclick="Cambiar_Lugar('agregar_post')" class="Boton" value="Agregar Post" id="post">
					<input type="button" onclick="Cambiar_Lugar('borrar')" class="Boton" value="Borrar Post" id="post">
					<input type="button" onclick="Cambiar_Lugar('edit')" class="Boton" value="Editar Post" id="post">
					<span class="stretch"></span>
					<br/>
					<input type="button" onclick="Cambiar_Lugar('servicios')" class="Boton" value="Servicios" id="servicios ">
					<input type="button" onclick="Cambiar_Lugar('quienes_somos')" class="Boton" value="Q. Somos" id="qsomos">
					<input type="button" onclick="Cambiar_Lugar('terminosycondiciones')" class="Boton" value="Term. y Cond" id="termycond">
					<input type="button" onclick="Cambiar_Lugar('Mensajes')" class="Boton" value="Mensajes" id="mensaje">
					<input type="button" onclick="Cambiar_Lugar('Correo')" class="Boton" value="Correo" id="correo">
					<span class="stretch"></span>
				</fieldset>
			</form> 
			<? /* -----> Mensaje  */ ?>
			<div class="DIV_FORM" id="Aviso_DIV" style="display: none">
				<div class="cargador_img aviso">
					<div class="medio_form">
						<span  class="texto_field"><img class="valign" alt="" src=""/>
							<span class="aviso_texto"></span>
							<span class="cargador_img_opcion aviso_cerrar"><span class="Modern_Pics">X</span>Cerrar</span>
						</span>
					</div>
					<br/>
				</div>
			</div>
			<? /* -----> Posteeo  */ ?>
			<div id="Post_DIV" class="DIV_FORM" style="display: none">
				<form enctype="multipart/form-data" method="post" name="Form_Post_DIV" id="Form_Post_DIV" action="">
					<div class="cargando cargando_bg" <? echo $GLOB_NoSeleccionar; ?> ></div>
					<fieldset>
						<br/>
						<input type="text" value="Titulo (requerido)" title="Titulo (requerido)" name="titulo" id="titulo" maxlength="85" />
						<br/>
						<span  class="error" id="titulo_err">&nbsp;</span>
						<br/>
						<? echo Escribir_Menu("descripcion","1") ?>
						<br/>
						<textarea id="descripcion_textarea" name="descripcion_textarea" maxlength="20000" title="Descripci&oacute;n (requerido)" rows="20">Descripci&oacute;n (requerido)</textarea>
						<br/>
						<span class="error" id="descripcion_textarea_err">&nbsp;</span>
						<br/> 
						<? /*--*/ ?>
						<br/>
						<input type="text" value="Sup. Total" title="Sup. Total" name="suptotal" id="suptotal" maxlength="85" class="no_req" onkeypress="return permite(event, 'num')"/>
						<br/>
						<span  class="error" id="suptotal_err">&nbsp;</span>
						<br/>
						<input type="text" value="Mt de Frente" title="Mt de Frente" name="mtdefrente" id="mtdefrente" maxlength="85" class="no_req" onkeypress="return permite(event, 'num')"/>
						<br/>
						<span  class="error" id="mtdefrente_err">&nbsp;</span>
						<br/>
						<input type="text" value="Sup. Cubierta" title="Sup. Cubierta" name="supcubierta" id="supcubierta" maxlength="85" class="no_req" onkeypress="return permite(event, 'num')"/>
						<br/>
						<span  class="error" id="supcubierta_err">&nbsp;</span>
						<br/>
						<input type="text" value="N&#176; de plantas" title="N&#176; de plantas" name="ndeplantas" id="ndeplantas" maxlength="85" class="no_req" onkeypress="return permite(event, 'num')"/>
						<br/>
						<span  class="error" id="ndeplantas_err">&nbsp;</span>
						<br/>
						<input type="text" value="N&#176; de Dormitorios" title="Dormitorios" name="dormitorios" id="dormitorios" maxlength="85" class="no_req" onkeypress="return permite(event, 'num')"/>
						<br/>
						<span  class="error" id="dormitorios_err">&nbsp;</span>
						<br/>
						<input type="text" value="N&#176; de Ba&#241;os" title="Ba&#241;os" name="banios" id="banios" maxlength="85" class="no_req"  onkeypress="return permite(event, 'num')"/>
						<br/>
						<span  class="error" id="banios_err">&nbsp;</span>
						<br/>
						<input type="text" value="Seguridad" title="Seguridad" name="seguridad" id="seguridad" maxlength="85" class="no_req" />
						<br/>
						<span  class="error" id="seguridad_err">&nbsp;</span>
						<br/>
						<input type="text" value="Patio" title="Patio" name="patio" id="patio" maxlength="85" class="no_req" />
						<br/>
						<span  class="error" id="patio_err">&nbsp;</span>
						<br/>
						<input type="text" value="Comodidades" title="Comodidades" name="comodidades" id="comodidades" maxlength="85" class="no_req" />
						<br/>
						<span  class="error" id="comodidades_err">&nbsp;</span>
						<br/>
						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Lavanderia</span>
							<select id="lavanderia" name="lavanderia">
							<option value="1" default>Sin Especificar</option>
							<option value="2">Si</option>
							<option value="3">No</option>
							</select>
						</div>
						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Terraza</span>
							<select id="terraza" name="terraza">
							<option value="1" default>Sin Especificar</option>
							<option value="2">Si</option>
							<option value="3">No</option>
							</select>
						</div>
						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Cochera</span>
							<select id="cochera" name="cochera">
							<option value="1" default>Sin Especificar</option>
							<option value="2">Si</option>
							<option value="3">No</option>
							</select>
						</div>
						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Jardin</span>
							<select id="jardin" name="jardin">
							<option value="1" default>Sin Especificar</option>
							<option value="2">Si</option>
							<option value="3">No</option>
							</select>
						</div>


						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Parrilla</span>
							<select id="asador_quincho" name="asador_quincho">
							<option value="1" default>Sin Especificar</option>
							<option value="2">Asador</option>
							<option value="3">Quincho</option>
							<option value="4">Asador y Quincho</option>
							</select>
						</div>

						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Gas</span>
							<select id="gas" name="gas">
							<option value="1">Sin Especificar</option>
							<option value="2">Garrafa</option>
							<option value="3">Natural</option>
							<option value="4">Sin Gas</option>
							</select>
						</div>

						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Perimetral</span>
							<select id="cerrado_perimetral" name="cerrado_perimetral">
							<option value="1">Sin Especificar</option>
							<option value="2">Si</option>
							<option value="3">No</option>
							</select>
						</div>

						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Calefaccion</span>
							<select id="calefacccion" name="calefacccion">
							<option value="1">Sin Especificar</option>
							<option value="2">Si</option>
							<option value="3">No</option>
							</select>
						</div>

						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Cloacas</span>
							<select id="cloacas" name="cloacas">
							<option value="1">Sin Especificar</option>
							<option value="2">Si</option>
							<option value="3">No</option>
							</select>
						</div>

						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Piscina</span>
							<select id="piscina" name="piscina">
							<option value="1">Sin Especificar</option>
							<option value="2">Si</option>
							<option value="3">No</option>
							</select>
						</div>

						<input type="text" value="Antig&#252;edad" title="Antig&#252;edad" name="antiguedad" id="antiguedad" maxlength="85" class="no_req" />
						<br/>
						<span  class="error" id="antiguedad_err">&nbsp;</span>
						<br/>
						<input type="text" value="Escritura" title="Escritura" name="escritura" id="escritura" maxlength="85" class="no_req" />
						<br/>
						<span  class="error" id="escritura_err">&nbsp;</span>
						<br/>
						<? /*--*/ ?>
						<input type="text" value="Precio (requerido)" title="Precio (requerido)" name="precio" id="precio" maxlength="85" onkeypress="return permite(event, 'num')"  />
						<br/>
						<span  class="error" id="precio_err">&nbsp;</span>
						<br/>
						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Moneda</span>
							<select id="moneda" name="moneda">
							<option value="1" default>Pesos</option>
							<option value="2">Dolares</option>
							</select>
						</div>
						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Operaci&oacute;n</span>
							<select id="operacion" name="operacion">
							<option value="1">Alquiler</option>
							<option value="2">Venta</option>
							</select>
						</div>
						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Tipo de inmueble</span>
							<select id="tipoinmueble" name="tipoinmueble">
							<option value="1" default>Casa</option>
							<option value="2" >Casa Quinta</option>
							<option value="3">Departamento</option>
							<option value="4">Terrenos y Lotes</option>
							<option value="5">Campos</option>
							<option value="6">Oficinas y Locales</option>
							<option value="7">Negocios e Industria</option>
							<option value="8">Fondo de Comercio</option>
							</select>
						</div>
						<input type="text" value="Direcci&oacute;n" title="Direcci&oacute;n" name="direccion" id="direccion" maxlength="85" class="no_req"/>
						<br/>
						<span  class="error" id="direccion_err">&nbsp;</span>
						<br/>
						<input type="text" value="Org. Publicos Cercanos" title="Org. Publicos Cercanos" name="org_publicos_cercanos" id="org_publicos_cercanos" maxlength="85" class="no_req" />
						<br/>
						<span  class="error" id="org_publicos_cercanos_err">&nbsp;</span>
						<br/>
						<input type="text" value="Localidad" title="Localidad" name="localidad" id="localidad" maxlength="85"  />
						<br/>
						<span  class="error" id="localidad_err">&nbsp;</span>
						<input type="text" value="Regi&oacute;n/Provincia (requerido)" title="Regi&oacute;n/Provincia (requerido)" name="reg_prov" id="reg_prov" maxlength="85" />
						<br/>
						<span  class="error" id="reg_prov_err">&nbsp;</span>
						<br/>
						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Mostrar Mapa</span>
							<select id="mostra_gmap" name="mostra_gmap">
							<option value="si" default>Si</option>
							<option value="no">No</option>
							</select>
						</div>
						<br/>
						<? echo Cargador_de_img("Google_M","Google Map","1","img_post/google_map/","si","200","345"); ?>
						<br/>
						<? echo Cargador_de_img("Portada","Portada","1","img_post/portada/","si","338","900"); ?>
						<br/>
						<? echo Cargador_de_img("Galeria","Galeria","8","img_post/galeria/","talvez","200","200"); ?>
						<br/>
						<? echo Cargador_de_img("FB_Pic","FB Pic","1","img_post/FB_PIC/","si","200","200"); ?>
						<br/>
						<div class="medio_form">
							<span  class="texto_field"><img class="valign" alt="" src=""/>Destacado</span>
							<select id="destacado" name="destacado">
							<option value="no" default>No</option>
							<option value="si">Si</option>
							</select>
						</div>
						<br/>
						<input type="text" value="Tags (requerido)" title="Tags (requerido)" name="tag" id="tag" maxlength="85" />
						<br/>
						<span  class="error" id="tag_err">&nbsp;</span>
						<br/>
						<input value="Preview" name="aceptar" id="aceptar" type="button" onclick="Enviar_Post(1)" class="boton_es" />
						<br/>
						<input type="hidden" value="" id="info_id" name="info_id" maxlength="85" class="no_req"/>
						<br/>
					</fieldset>
				</form>
			</div>
			<? /* --------------- */ ?>
			<? /* -----> EditPost */ ?>
			<div id="Edit_borrar_DIV" class="DIV_FORM" style="display: none">
				<form enctype="multipart/form-data" method="post" name="Form_Edit_borrar_DIV" id="Form_Edit_borrar_DIV" action="">
					<div class="cargando cargando_bg" <? echo $GLOB_NoSeleccionar; ?> ></div>
					<fieldset>
						<input type="text" value="Codigo de la Propiedad (requerido)" title="Codigo de la Propiedad (requerido)" name="codpost" id="codpost" maxlength="85" style="width:300px" />
						<br/>
						<span  class="error" id="codpost_err" style="width:300px">&nbsp;</span>
						<br/>
						<input value="Buscar" name="buscar" id="buscar" type="button" onclick="Borrar_Editar(1)" class="boton_es" />
					</fieldset>
				</form>
			</div>
			<? /* -----> Mensajes */ ?>
			<div id="Info_DIV" class="DIV_FORM" style="display: none">
				<form enctype="multipart/form-data" method="post" name="Form_Info_DIV" id="Form_Info_DIV" action="">
					<div class="cargando cargando_bg" <? echo $GLOB_NoSeleccionar; ?> ></div>
					<fieldset>
						<input type="text" value="Titulo (requerido)" title="Titulo (requerido)" name="titulo" id="titulo" maxlength="85" />
						<br/>
						<span  class="error" id="titulo_err">&nbsp;</span>
						<br/>
						<? echo Escribir_Menu("contenido","1") ?>
						<br/>
						<textarea id="contenido_textarea" name="contenido_textarea" maxlength="20000" title="Contenido (requerido)" rows="20">Contenido (requerido)</textarea>
						<br/>
						<span class="error" id="contenido_textarea_err">&nbsp;</span>
						<br/>
						<input type="text" value="Tags (requerido)" title="Tags (requerido)" name="tag" id="tag" maxlength="85" />
						<br/>
						<span  class="error" id="tag_err">&nbsp;</span>
						<br/>
						<input value="Preview" name="aceptar" id="aceptar" type="button" onclick="Enviar_Info(1)" class="boton_es" />
						<input type="hidden" value="" id="info_id" name="info_id" maxlength="85" />
					</fieldset>
				</form>
			</div>
			<? /* --------------- */ ?>
			<? /* -----> Mensajes */ ?>
			<div id="Mensajes_DIV" class="DIV_FORM" style="display: none">
				<dl id="mensajes">
					<dt id="mensajes_opcion" <? echo $GLOB_NoSeleccionar ?> onclick="javascript:Manejar_mensajes('R',0)"><img class="valign" alt="" src=""/><span class="Modern_Pics">R</span> Cargar Mensajes</dt>
				</dl>
			</div>
			<? /* --------------- */ ?>
			<? /* -----> Correo */ ?>
			<div id="Correo_DIV" class="DIV_FORM" style="display: none">
				<form enctype="multipart/form-data" method="post" name="Form_Correo_DIV" id="Form_Correo_DIV" action="">
					<div class="cargando cargando_bg" <? echo $GLOB_NoSeleccionar; ?> ></div>
					<fieldset>
						<input type="text" value="Correo de destino (requerido)" title="Correo de destino (requerido)" name="correo" id="correo" maxlength="85" style="width:300px" />
						<br/>
						<span  class="error" id="correo_err" style="width:300px">&nbsp;</span>
						<br/>
						<input value="Guardar" name="Guardar" id="guardar" type="button" onclick="Editar_Correo()" class="boton_es" />
					</fieldset>
				</form>
			</div>
			<? /* --------------- */ ?>
			<? /* ------- Drop    */ ?>
			<div class="Cuadro_Dialogo" style="visibility: hidden" >
				<div class="Cuadro_Dialogo_imagen">
					<form id="f_Cuadro_Dialogo_imagen">
			  		<br>
						<p align=center>
							<span id="Cuadro_Dialogo_dropbox" class="dropbox central"><span id="Cuadro_Dialogo_dropbox_output" >Tirar aca la imagen para el Post</span></span>
							<input type="hidden" value="" id="Cuadro_Dialogo_dropbox_output_ok" title="">
							<input type="hidden" value="" id="Cuadro_Dialogo_dropbox_cropear" title="">
							<input type="hidden" value="" id="Cuadro_Dialogo_dropbox_textarea" title="">
							<input type="hidden" value="" id="Cuadro_Dialogo_dropbox_alto" title="">
							<input type="hidden" value="" id="Cuadro_Dialogo_dropbox_ancho" title="">
							<input type="hidden" value="" id="Cuadro_Dialogo_dropbox_destino" title="">
							<? /*------------ */ ?>
							<input type="hidden" value="" id="Cuadro_Dialogo_dropbox_Crop_X" title="">
							<input type="hidden" value="" id="Cuadro_Dialogo_dropbox_Crop_Y" title="">
							<input type="hidden" value="" id="Cuadro_Dialogo_dropbox_Crop_W" title="">
							<input type="hidden" value="" id="Cuadro_Dialogo_dropbox_Crop_H" title="">
						</p>
						<br>
						<input type="button" class="boton_es" id="" value="Aceptar" onclick="Cuadro_Dialogo_img_Salir()">
					</form>
				</div>
			</div>
			<? /*--*/ ?>
			<? /* ------- Preview */ ?>
			<div id="Post_Preview"></div>
			<? /* --------------- */ ?>
		</div>
		<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
		<?
			if (bandera("optimizado")){		
				require_once 'admin_script_optimizado.php';
			}else{
				require_once 'admin_script.php';
			}
		?>
		<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
		<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
		<? }else{ ?> 
			<div id="cuerpo_centro_centro">
				<div class="cuerpo_centro_titulo titulo_celeste">PANEL DE CONTROL</div>
				<div id="Login_DIV" class="DIV_FORM" >
					<form enctype="multipart/form-data" method="post" name="Form_Info_DIV" id="Form_Login_DIV" action="">
						<div class="cargando cargando_bg" <? echo $GLOB_NoSeleccionar; ?> ></div>
						<fieldset>
							<input type="text" value="" title="Usuario (requerido)" name="usuario" id="usuario" maxlength="85" style="width:300px" />
							<br/>
							<span  class="error" id="usuario_err" style="width:300px">&nbsp;</span>
							<br/>
							<input type="password" value="" title="" name="contrasenia" id="contrasenia" maxlength="85" style="width:300px" />
							<br/>
							<span  class="error" id="contrasenia_err" style="width:300px">&nbsp;</span>
							<br/>
							<input value="Ingresar" name="ingresar" id="ingresar" type="button" onclick="Login()" class="boton_es" />
							<br/>
							<span  class="error" id="login_err" style="width:300px;text-align:center">&nbsp;</span>
						</fieldset>
					</form>
				</div>
			</div>
			<script type="text/javascript">
				function Login(){
					var InpTexts=$("#Form_Login_DIV input[type!='button']");
					var listo=1;
					var ult_err="";
					var	La_Data="";
					$.each(InpTexts,function(){
						if((empty($(this).val()) || $(this).val()==$(this).attr("title")) ){
							$("#Form_Login_DIV #"+$(this).attr("id")+"_err").html("Campo Obligatorio");
							listo=0;
							if(empty(ult_err)){
								ult_err=$(this).attr("id");
							}
						}
					});
					if (listo==1){
						$("#Form_Login_DIV fieldset").fadeTo("fast",0.3);
						$("#Form_Login_DIV .cargando").fadeTo("fast",1.0);
						$.each(InpTexts,function(){
							La_Data = La_Data + $(this).attr("id") + '=' + encodeURIComponent(sValidosarCadena($(this).val())) + '&' ;
						});
						La_Data = La_Data+'ajx='+'LOGIN';
						$.ajax({
							type: 'POST',
							url: "AJAX.php",
							data:La_Data,
							success: function(data){
								var obj = jQuery.parseJSON(data);
								if (obj.verf=="INVALIDO"){
									$("#Form_Login_DIV fieldset").fadeTo("fast",1.0);
									$("#Form_Login_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
									$("#Form_Login_DIV #login_err").html("Nombre de usuario y contrase&ntilde;a no validos");
								}else{
									$.cookie("Login_Petrino_User", obj.user, { expires: 7 });
									$.cookie("Login_Petrino_Veri", obj.verf, { expires: 7 });
									window.location.reload();
								}
							}
						});

					}else{
						$.scrollTo("#Form_Post_DIV #"+ult_err,500);
					}
				}
			</script>
		<? } ?>
		<a href="javascript:$.scrollTo('#cabecera',800);" id="cuerpo_abajo"><img class="valign" alt="" src=""/>IR AL CIELO</a>
	</div>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'part_abajo.php'      ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
