<? 	if( !defined( '_AUTOGAN' ) && !defined( '_VALID_VVM' ) ) die( 'Restricted access' ); ?>

<script type="text/javascript">
	/* Contacto */
	function onkeydown_input(o){
		if($(o).val()==$(o).attr('title')){
			$(o).val('');
			$(o).addClass('FORM_focus');
		}
		$("form #"+$(o).attr("id")+"_err").html("&nbsp;");
	}
	function onblur_input(o){
		if($(o).val()==$(o).attr('title')||$(o).val()==''){
			$(o).val($(o).attr('title'));
			$(o).removeClass('FORM_focus');
		}
		
	}
	function sValidosarCadena(string) {
		var output="";
		string=string.replace(/¿/gi,"&iquest;");
		string=string.replace(/á/gi,"&aacute;");
		string=string.replace(/é/gi,"&eacute;");
		string=string.replace(/í/gi,"&iacute;");
		string=string.replace(/ó/gi,"&oacute;");
		string=string.replace(/ú/gi,"&uacute;");
		string=string.replace(/ñ/gi,"&ntilde;");
		for (var i=0; i<string.length;i++){
			if ( string.charCodeAt(i) > 0 && string.charCodeAt(i) < 127){
				output += string.charAt(i);
			}
		}
		return $.trim(output);
	}
	function limpiar(output)  {
		output=output.replace(/&iquest;/gi,"¿");
		output=output.replace(/&aacute;/gi,"á");
		output=output.replace(/&eacute;/gi,"é");
		output=output.replace(/&iacute;/gi,"í");
		output=output.replace(/&oacute;/gi,"ó");
		output=output.replace(/&uacute;/gi,"ú");
		output=output.replace(/&ntilde;/gi,"ñ");
		return output;
	}
	function Validar_Mail(valor){
		if(!(/\w{1,}[@][\w\-]{1,}([.]([\w\-]{1,})){1,3}$/.test(valor))){
			return false;
		}else{
			return true;
		}
	}
	function Enviar_Comentario(){
		var InpTexts=$("form input[type!='button'], form textarea");
		var listo=1;
		var ult_err="";
		if(!Validar_Mail($("#email").val())){
			listo=0;
			ult_err=$(this).attr("id");
			$("form #email_err").html("El Correo Electronico no es valido");
		}else{
			$("form #email_err").html("&nbsp;");
		}
		$.each(InpTexts,function(){
			if(empty($(this).val()) || $(this).val()==$(this).attr("title")){
				$("form #"+$(this).attr("id")+"_err").html("Campo Obligatorio");
				listo=0;
				if(empty(ult_err)){
					ult_err=$(this).attr("id");
				}
			}
		});
		if (listo==1){
			var La_Data="";
			$.each(InpTexts,function(){
				La_Data = La_Data + $(this).attr("id") + '=' + encodeURIComponent(sValidosarCadena($(this).val())) + '&' ;
			});
			La_Data = La_Data+'ajx='+'AG';
			$("form fieldset").fadeTo("slow",0.3);
			$("form .cargando").fadeTo("slow",1.0);
			$.ajax({
				type: 'POST',
				url: "<? echo traducir_url("AJAX.php") ?>",
				data:La_Data,
				success: function(){
					Mensaje ("Mensaje recibido!");
				},
				error: function() {
					Mensaje ("Hubo un error! Intente más tarde.");
				}
			});
		}else{
			$.scrollTo("form #"+ult_err,500,{offset:-50});
		}
		function Mensaje (msj) {
			$("form fieldset").fadeTo("slow",0.2);
			$("form  .cargando").fadeTo("slow",0.3,function () {
				$(this).removeClass("cargando_bg").html('<img class="valign">'+ msj).fadeTo("slow",1.0);
				$.each(InpTexts,function(){
					$(this).val($(this).attr("title"))
				});
			});
		}
	}
	/*----------*/
	/*-- GMaps -*/
	<? if (bandera("gmap")) { ?>
	var geocoder;
	var map;
	var infowindow = new google.maps.InfoWindow();
	function Google_Maps_initialize() {
		geocoder = new google.maps.Geocoder();
		var myOptions = {
			mapTypeId: google.maps.MapTypeId.SATELLITE
		}
		map = new google.maps.Map(document.getElementById("GoogleMap"), myOptions);
	}
	function Codificar_Direccion(direccion,mostrar) {
		var address = limpiar(direccion);
		var resultado;
		geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK && mostrar=="si") {
				map.setCenter(results[0].geometry.location);
				map.setZoom(17);
				var marker = new google.maps.Marker({
					map: map, 
					position: results[0].geometry.location
				});
			}else{
				$("#GoogleMap").css("background","url("+$("#GoogleMap_default").text().trim()+")"); 
			}
		});
	}
	<? }else{ ?>
	function Google_Maps_initialize() {
		// NO OPERACION :P
	}
	function Codificar_Direccion(direccion,mostrar) {
		$("#GoogleMap").css("background","url("+$("#GoogleMap_default").text().trim()+")"); 
	}
	<? } ?>
	/*----------*/
	function menu_estatico() {
		if ($(window).scrollTop() >= $("#cabecera_arriba").outerHeight() && $(window).width() > 995) {
			$("#cabecera #menu").addClass("menu_estatico");
		}else{
			$("#cabecera #menu").removeClass("menu_estatico");
		}
	}
	function Tamanio_Cargar() {
		$("form").each(function () {
			$("#"+$(this).attr("id")+" .cargando").css("height",$(this).outerHeight()+"px");
			$("#"+$(this).attr("id")+" .cargando").css("width",$(this).outerWidth()+"px");
		});
	}
	/*----------*/
	$(document).ready(function(){
		var tabindex = 1;
		$('input,select,textarea').each(function() {
			if (this.type != "hidden") {
				var $input = $(this);
				$input.attr("tabindex", tabindex);
				tabindex++;
			}
		});
		
		$(".cargando").hide().css("visibility","visible");
		
//		$("input[type!='button'], textarea").keypress(function() {onfocus_input($(this))});

		$("input[type!='button'], textarea").keydown(function() {onkeydown_input($(this))});

		$("input[type!='button'], textarea").blur(function() {onblur_input($(this))});

		$("input,select").keypress(function(event) {
			if ( event.which == 13 ) {
				var id_temp="#"+$('[tabindex="'+(parseInt($(this).attr("tabindex"))+1)+'"]').attr("id");
				event.preventDefault();
				if ($(id_temp).attr("type")=="button"){
					$(id_temp).click();
				}else{
					$(id_temp).focus();
				}
			}
		});
		Tamanio_Cargar();
	});
	$("#cabecera #menu A").mouseleave((function () {$(this).fadeTo("slow",1.0);})).mouseover(function () {$(this).fadeTo("slow",0.8);});
</script>