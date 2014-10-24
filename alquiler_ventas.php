<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'var_glob.php'        ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?
	$meta_Keywords="Alquiler, venta ,Inmuebles, Casas, Departamentos, Terrenos y Lotes, Campos, Oficinas y Locales, Negocios e Industria";
	$meta_canonical="alquiler";
	$meta_Title="- Alquiler";
	$meta_Description="Alquileres de Inmuebles en la zona de San Luis"
?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'part_arriba.php'     ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>

<? 
	if(isset($_GET["al_ve"])){
		$al_ve=$_GET["al_ve"];
	}else{
		$al_ve=1;
	}
	$Al_final=(($al_ve==1) ? "alquiler": "ventas");
	if(isset($_GET["reg"])){
		$reg=$_GET["reg"];
	}else{
		$reg="san_luis";
	}
	if(isset($_GET["tipo"])){
		$tipo=$_GET["tipo"];
	}else{
		$tipo="casas";
	}
?>
		<div id="cuerpo_centro" >
			<div id="cuerpo_centro_izq" >
				<?=Generar_Menu_Al_ve($Al_final,"Casas", $tipo!="casas")?>
				<?=Generar_Menu_Al_ve($Al_final,"Casa Quinta",$tipo!="casa_quinta")?>
				<?=Generar_Menu_Al_ve($Al_final,"Departamentos",$tipo!="departamentos")?>
				<?=Generar_Menu_Al_ve($Al_final,"Terrenos y Lotes",$tipo!="terrenos_y_lotes")?>
				<?=Generar_Menu_Al_ve($Al_final,"Campos",$tipo!="campos")?>
				<?=Generar_Menu_Al_ve($Al_final,"Oficinal y Locales",$tipo!="oficinal_y_locales")?>
				<?=Generar_Menu_Al_ve($Al_final,"Negocios e Industria",$tipo!="negocios_e_industria")?>
				<?=Generar_Menu_Al_ve($Al_final,"Fondo de Comercio",$tipo!="fondo_de_comercio")?>
			</div>
			<div id="cuerpo_centro_der">
				<div class="cuerpo_centro_titulo titulo_morado">Ultimas Propiedades</div>
				<ul id="portada_individual">
					<? 
						$Obtener=Generar_Ultimas_Propiedades($al_ve,$tipo,$reg,0);
						if ($Obtener["OK"]==1){
							echo $Obtener["Data"];
							echo '<div id="cargando_mas_post" ><img class="valign" alt="" src=""/><a href="javascript:cargar_mas();" class="cargar_mas" title="">Cargar m&aacute;s Propiedades</a></div>';
						}else{
							echo '<div id="cargando_mas_post" >Nada por ac&aacute;...</div>';
						}
					?>
				</ul>
			</div>
			<a href="javascript:$.scrollTo('#cabecera',800);" id="cuerpo_abajo"><img class="valign" alt="" src=""/>IR AL CIELO</a>
		</div>
	<script type="text/javascript"> 
		var D_G={p:1,};

		$("DL.menu DT A.menu_boton").click(function(){
			if($(this).hasClass("menu_expandir")){
				$(this).removeClass("menu_expandir").addClass("menu_reducir");
			}else{
				$(this).removeClass("menu_reducir").addClass("menu_expandir");
			}

		})		/*
		.slideToggle("normal");
			if ($("DL.menu DT A."+tt).hasClass("menu_expandir")){
				$("DL.menu DT A."+tt).
			}else{
				$("DL.menu DT A."+tt)
			}
		/*
		function Animar_Menu(tt){
			
		}
		*/
		function cargar_mas(){
			$("#cargando_mas_post").html("Cargando").addClass("cargando_mas_post_gif");
			var	La_Data='ajx='+ "CMP" +'&al_ve=' + encodeURIComponent("<? echo $al_ve ?>") + '&tipo=' + encodeURIComponent("<? echo $tipo ?>") + '&reg=' + encodeURIComponent("<? echo $reg ?>") + '&pag=' + encodeURIComponent(D_G.p);
			$.ajax({
				type: 'POST',
				url: "<? echo traducir_url("AJAX.php") ?>",
				data:La_Data,
				success: function(data) {
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
		<? if ($Obtener["OK"]==1){ ?>
		$(window).scroll(function () {if ($(window).scrollTop() >= $(document).height() - $(window).height()) {cargar_mas();}});
		<? } ?>
	</script>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'part_abajo.php'      ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
