<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'var_glob.php'        ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?
	$meta_Keywords="";
	$meta_canonical="contacto";
	$meta_Title="- Contacto";
	$meta_Description="Venta de Inmuebles en la zona de San Luis"
?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'part_arriba.php'     ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
		<div id="cuerpo_centro" >
			<div id="cuerpo_centro_centro">
				<div class="cuerpo_centro_titulo titulo_celeste">¿Qué Necesitás?</div>
				<form enctype="multipart/form-data" method="post" name="Form_Contacto" id="Form_Contacto" action="">
				<div class="cargando cargando_bg" <? echo $GLOB_NoSeleccionar; ?> ></div>
					<fieldset>
						<input type="text" value="Nombre y Apellido (requerido)" title="Nombre y Apellido (requerido)" id="nombre" name="nombre" maxlength="85" />
						<br/>
						<span  class="error" id="nombre_err">&nbsp;</span>
						<br/>
						<input type="text" value="E-mail (requerido)" title="E-mail (requerido)" id="email" name="email" maxlength="85" />
						<br/>
						<span  class="error" id="email_err">&nbsp;</span>
						<br/>
						<input type="text" value="Teléfono (requerido)" title="Teléfono (requerido)" id="telefono" name="telefono" maxlength="85" />
						<br/>
						<span  class="error" id="telefono_err">&nbsp;</span>
						<br/>
						<textarea id="mensaje" name="mensaje" maxlength="5000" title="Mensaje (requerido)" rows="20">Mensaje (requerido)</textarea>
						<br/>
						<span class="error" id="mensaje_err">&nbsp;</span>
						<br/>
						<input value="Enviar" name="aceptar" id="aceptar" class="aceptar" type="button" onclick="Enviar_Comentario()" />
						<input type="hidden" value="NONE" id="asunto" name="asunto" maxlength="85" />
					</fieldset>
				</form>
			</div>
			<a href="javascript:$.scrollTo('#cabecera',800);" id="cuerpo_abajo"><img class="valign" alt="" src=""/>IR AL CIELO</a>
		</div>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'part_abajo.php'      ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>