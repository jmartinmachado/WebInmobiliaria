-<? if( !defined( '_AUTOGAN' ) && !defined( '_VALID_VVM' ) ) die( 'Restricted access' ); ?>
	<script type ="text/javascript">
		/**********************************************************************************/
		/*                                                                                */
		/*  TIME TO FUCKIN' PARTY!                                                        */
		/*                                                                                */
		/**********************************************************************************/
		/*   Inicializador  */
		if(!empty($.cookie("Cookie_Donde_Estoy"))){
			var Donde_Estoy=$.cookie("Cookie_Donde_Estoy");
		}else{
			  var Donde_Estoy="Post_DIV";
		}
		var Lugar_Info=$.cookie("Cookie_Lugar_Info");
		/* ---------------- */
		/* Manejar los post */
		$(".cargador_img_subir").click(function () {
			var Nombre_Del_Div= "#cargador_img_"+$(this).attr("id");
			if ($(Nombre_Del_Div+ " #cargador_cant_img").text().trim()!=0){
				Cuadro_Dialogo_img_Entrar(Nombre_Del_Div,"cargador_img_output_ok", $(Nombre_Del_Div + " #cargador_img_cropear").text().trim(),"no", $(Nombre_Del_Div + " #cargador_cant_alto").text().trim(),$(Nombre_Del_Div + " #cargador_img_ancho").text().trim(),$(Nombre_Del_Div + " #cargador_img_destino").text().trim());
			}
		}); 
		function Cargador_img_warper(Nombre_Del_Div,Url_Img){
			$(Nombre_Del_Div+ " .cargador_img_lista_archivos").append('<li id="'+Analizar_IMG(Url_Img)+'"><span class="Url_Img">'+Url_Img+'</span> (image/jpeg) - <span  class="texto_field "><a href="javascript:Eliminar_img_warper(\''+Nombre_Del_Div+'\',\''+Url_Img+'\')" class="cargador_img_opcion"><img class="valign" alt="" src=""/><span class="Modern_Pics">X</span>Eliminar Imagen</a></span></li>'); 
			var cant_img=$(Nombre_Del_Div+ " #cargador_cant_img").text().trim();
			cant_img=cant_img-1;
			if(cant_img==0){
				$(Nombre_Del_Div+ " .cargador_img_subir").fadeOut("fast");
			} 
			$(Nombre_Del_Div+ " #cargador_cant_img").text(cant_img);
			$(Nombre_Del_Div+"_err").html("&nbsp;");  
		}
		function Eliminar_img_warper(Nombre_Del_Div,Url_Img) {
			Nombre_Del_Div=Nombre_Del_Div;
			var La_Data='ajx='+'EIMG' + '&' + 'Img_eli=' + encodeURIComponent(Url_Img);
			$.ajax({
				cache : false,
				type: 'POST',
				url: "AJAX.php",
				data:La_Data,
				success: function(data){
					var cant_img=$(Nombre_Del_Div+ " #cargador_cant_img").text().trim();
					if(cant_img==0){
						$(Nombre_Del_Div+ " .cargador_img_subir").fadeIn("fast");
					}
					$(Nombre_Del_Div+" #"+Analizar_IMG(Url_Img)).detach();
					cant_img=cant_img+1;
					$(Nombre_Del_Div+ " #cargador_cant_img").text(cant_img);
				}
			});
		}
		/* ---------------- */
		function Enviar_Post(hacer){
			if (Validar_Formulario("#Form_Post_DIV")){
				$("#Form_Post_DIV fieldset").fadeTo("fast",0.3);
				$("#Form_Post_DIV .cargando").fadeTo("fast",1.0);
				var	La_Data=Generar_LaData("#Form_Post_DIV");
				switch (hacer){
					case 1:
						La_Data = La_Data+'ajx='+'PPP';
						$.ajax({
							type: 'POST',
							url: "AJAX.php",
							data:La_Data,
							success: function(data){
								$("#Post_Preview").html('<div class="separador"></div><br/>'+data+'<br/> &nbsp; <div id="" class="DIV_FORM"><form><fieldset><input value="Guardar" name="guardar" id="guardar" type="button" onclick="Enviar_Post(2)" class="boton_es" /></fieldset></form></div>').slideDown("fast",function() {
									$("#Form_Post_DIV fieldset").fadeTo("fast",1.0);
									$("#Form_Post_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
									Google_Maps_initialize();
									Codificar_Direccion($("#Form_Post_DIV #direccion").val()+$("#Form_Post_DIV #reg_prov").val(),$("#Form_Post_DIV #mostra_gmap").val());
									$('.pic a').lightBox({
										imageLoading: 'img/loading.gif',
										imageBtnClose: 'img/cerrar.gif',
										imageBtnPrev: 'img/ant.gif',
										imageBtnNext: 'img/sig.gif',
										containerResizeSpeed: 350,
									 	txtImage: 'Imagen',
										txtOf: 'de'
									});
								$.scrollTo("#Post_Preview",1000);
								});
							}
						});
					break;
					case 2:
						$.scrollTo('#cuerpo',500);
						$("#Post_Preview").delay(500).slideUp("fast");
						console.log(Lugar_Info);
						if (Lugar_Info=="editar"){
							La_Data = La_Data+'ajx='+'EEP';
							$.ajax({
								type: 'POST',
								url: "AJAX.php",
								data:La_Data,
								success: function(data){
									console.log(data);
									var obj = jQuery.parseJSON(data);
									$("#Form_Post_DIV fieldset").fadeTo("fast",1.0);
									$("#Form_Post_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
									if(obj.OK==1){
										Resetear_formulario("Form_Post_DIV");
										$("#Aviso_DIV").fadeIn("fast");
										$("#Aviso_DIV .aviso .aviso_texto").html('Propiedad Editada, click <a href="'+obj.Data+'" target="blank" alt="" title="">AQUI</a> para ir a al post');
									}else{
										alert("UP's hubo un error al cargar la base de datos. Intente de nuevo!");	
									}

								}
							});
						}else{
							La_Data = La_Data+'ajx='+'AEP';
							$.ajax({
								type: 'POST',
								url: "AJAX.php",
								data:La_Data,
								success: function(data){
									var obj = jQuery.parseJSON(data);
									$("#Form_Post_DIV fieldset").fadeTo("fast",1.0);
									$("#Form_Post_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
									if(obj.OK==1){
										Resetear_formulario("Form_Post_DIV");
										$("#Aviso_DIV").fadeIn("fast");
										$("#Aviso_DIV .aviso .aviso_texto").html('Propiedad Agregada, click <a href="'+obj.Data+'" target="blank" alt="" title="">AQUI</a> para ir a al post');
									}else{
										alert("UP's hubo un error al cargar la base de datos. Intente de nuevo!");	
									}
								}
							});
						}
					break;
				}
			}
		}
		function Borrar_Editar(hacer){
			var InpTexts=$("#Form_Edit_borrar_DIV input[type!='button'], #Form_Edit_borrar_DIV textarea, #Form_Edit_borrar_DIV	 select");
			if (Validar_Formulario("#Form_Edit_borrar_DIV")){
				$("#Form_Edit_borrar_DIV fieldset").fadeTo("fast",0.3);
				$("#Form_Edit_borrar_DIV .cargando").fadeTo("fast",1.0);
				var	La_Data=""
				$.each(InpTexts,function(){
					La_Data = La_Data + $(this).attr("id") + '=' + encodeURIComponent(sValidosarCadena($(this).val())) + '&' ;
				});
				switch(hacer){
				case 1:
					La_Data = La_Data+'ajx='+'PPB';
					$.ajax({
						type: 'POST',
						url: "AJAX.php",
						data:La_Data,
						success: function(data){
							var obj = jQuery.parseJSON(data)
							if (obj.OK==1){
								$("#Post_Preview").html('<div class="separador"></div><br/>'+obj.post+'<br/> &nbsp; <div id="" class="DIV_FORM"><form><fieldset><input value="'+((Lugar_Info == "borrar") ? "Borrar": "Editar")+'" name="Borrar_Editar_boton" id="Borrar_Editar_boton" type="button" onclick="Borrar_Editar(2)" class="boton_es" /></fieldset></form></div>').slideDown("fast",function() {
									$("#Form_Edit_borrar_DIV fieldset").fadeTo("fast",1.0);
									$("#Form_Edit_borrar_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
									Google_Maps_initialize();
									Codificar_Direccion(obj.direccion+", "+obj.region_provincia, obj.mostra_gmap);
									$('.pic a').lightBox({
										imageLoading: 'img/loading.gif',
										imageBtnClose: 'img/cerrar.gif',
										imageBtnPrev: 'img/ant.gif',
										imageBtnNext: 'img/sig.gif',
										containerResizeSpeed: 350,
										txtImage: 'Imagen',
										txtOf: 'de'
									});
									$.scrollTo("#Post_Preview",1000);
								});
							}else{
								$("#Form_Edit_borrar_DIV fieldset").fadeTo("fast",1.0);
								$("#Form_Edit_borrar_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
								alert("La propiedad no existe!");
							}
						}
					});
				break;
				case 2:
					switch(Lugar_Info){
						case "borrar":
							if (confirm("Seguro que deseas borrar esta propiedad??")) {
								La_Data = La_Data+'ajx='+'LPB';
								$.scrollTo('#cuerpo',500);
								$("#Post_Preview").delay(500).slideUp("fast");
								$.ajax({
									type: 'POST',
									url: "AJAX.php",
									data:La_Data,
									success: function(data){
										var obj = jQuery.parseJSON(data)
										$("#Form_Edit_borrar_DIV fieldset").fadeTo("fast",1.0);
										$("#Form_Edit_borrar_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
										Resetear_formulario("Form_Edit_borrar_DIV");
										$("#Aviso_DIV").fadeIn("fast");
										$("#Aviso_DIV .aviso .aviso_texto").html('Propiedad Eliminada');
									}
								});
							}else{
								$.scrollTo('#cuerpo',500);
								$("#Post_Preview").delay(500).slideUp("fast", function() {
									$("#Form_Edit_borrar_DIV fieldset").fadeTo("fast",1.0);
									$("#Form_Edit_borrar_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
								});
								Resetear_formulario("Form_Edit_borrar_DIV");
							}
						break;
						case "edit":
							$.scrollTo('#cuerpo',500);
							$("#Post_Preview").delay(500).slideUp("fast");
							La_Data = La_Data+'ajx='+'PTP';
							$.ajax({
								type: 'POST',
								url: "AJAX.php",
								data:La_Data,
								success: function(data){
									var obj = jQuery.parseJSON(data);
									if (obj["OK"]==1){
										$("#Form_Post_DIV #info_id").val(obj["post"]["ID"]);
										$("#Form_Post_DIV #titulo").val(limpiar(obj["post"]["titulo"]));
										$("#Form_Post_DIV #descripcion_textarea").val(limpiar(obj["post"]["descripcion"]));
										if (obj["post"]["localidad"]!="")$("#Form_Post_DIV #localidad").val(limpiar(obj["post"]["localidad"]));
										if (obj["post"]["suptotal"]!="")$("#Form_Post_DIV #suptotal").val(limpiar(obj["post"]["suptotal"]));
										if (obj["post"]["mtdefrente"]!="")$("#Form_Post_DIV #mtdefrente").val(limpiar(obj["post"]["mtdefrente"]));
										if (obj["post"]["supcubierta"]!="")$("#Form_Post_DIV #supcubierta").val(limpiar(obj["post"]["supcubierta"]));
										if (obj["post"]["ndeplantas"]!="")$("#Form_Post_DIV #ndeplantas").val(limpiar(obj["post"]["ndeplantas"]));
										if (obj["post"]["dormitorios"]!="")$("#Form_Post_DIV #dormitorios").val(limpiar(obj["post"]["dormitorios"]));
										if (obj["post"]["comodidades"]!="")$("#Form_Post_DIV #comodidades").val(limpiar(obj["post"]["comodidades"]));
										if (obj["post"]["seguridad"]!="")$("#Form_Post_DIV #seguridad").val(limpiar(obj["post"]["seguridad"]));
										if (obj["post"]["banios"]!="")$("#Form_Post_DIV #banios").val(limpiar(obj["post"]["banios"]));
										if (obj["post"]["lavanderia"]!="")$("#Form_Post_DIV #lavanderia").val(limpiar(obj["post"]["lavanderia"]));
										if (obj["post"]["terraza"]!="")$("#Form_Post_DIV #terraza").val(limpiar(obj["post"]["terraza"]));
										if (obj["post"]["jardin"]!="")$("#Form_Post_DIV #jardin").val(limpiar(obj["post"]["jardin"]));
										if (obj["post"]["patio"]!="")$("#Form_Post_DIV #patio").val(limpiar(obj["post"]["patio"]));
										if (obj["post"]["cochera"]!="")$("#Form_Post_DIV #cochera").val(limpiar(obj["post"]["cochera"]));
										if (obj["post"]["antiguedad"]!="")$("#Form_Post_DIV #antiguedad").val(limpiar(obj["post"]["antiguedad"]));
										if (obj["post"]["asador_quincho"]!="")$("#Form_Post_DIV #asador_quincho").val(limpiar(obj["post"]["asador_quincho"]));
										if (obj["post"]["cerrado_perimetral"]!="")$("#Form_Post_DIV #cerrado_perimetral").val(limpiar(obj["post"]["cerrado_perimetral"]));
										if (obj["post"]["gas"]!="")$("#Form_Post_DIV #gas").val(limpiar(obj["post"]["gas"]));
										if (obj["post"]["calefacccion"]!="")$("#Form_Post_DIV #calefacccion").val(limpiar(obj["post"]["calefacccion"]));
										if (obj["post"]["cloacas"]!="")$("#Form_Post_DIV #cloacas").val(limpiar(obj["post"]["cloacas"]));
										if (obj["post"]["piscina"]!="")$("#Form_Post_DIV #piscina").val(limpiar(obj["post"]["piscina"]));
										if (obj["post"]["org_publicos_cercanos"]!="")$("#Form_Post_DIV #org_publicos_cercanos").val(limpiar(obj["post"]["org_publicos_cercanos"]));
										if (obj["post"]["escritura"]!="")$("#Form_Post_DIV #escritura").val(limpiar(obj["post"]["escritura"]));
										$("#Form_Post_DIV #moneda option[value="+obj["post"]["moneda"]+"]").attr("selected","selected");
										$("#Form_Post_DIV #operacion option[value="+obj["post"]["operacion"]+"]").attr("selected","selected");
										$("#Form_Post_DIV #tipoinmueble option[value="+obj["post"]["tipo_inmueble"]+"]").attr("selected","selected");
										$("#Form_Post_DIV #mostra_gmap option[value="+obj["post"]["mostra_gmap"]+"]").attr("selected","selected");
										Cargador_img_warper_edit("Google_M", obj["post"]["google_map_pic"]);
										Cargador_img_warper_edit("Portada", obj["post"]["portada_pic"]);
										Cargador_img_warper_edit("Galeria", obj["post"]["galeria_pic"]);
										Cargador_img_warper_edit("FB_Pic", obj["post"]["FB_pic"]);
										$("#Form_Post_DIV #precio").val(limpiar(obj["post"]["precio"]));
										$("#Form_Post_DIV #direccion").val(limpiar(obj["post"]["direccion"]));
										$("#Form_Post_DIV #reg_prov").val(limpiar(obj["post"]["region_provincia"]));
										$("#Form_Post_DIV #tag").val(limpiar(obj["post"]["tags"]));
										Cambiar_Lugar('editar_post')
									}else{
										alert("La propiedad no existe!");	
									}
									$("#Form_Edit_borrar_DIV fieldset").fadeTo("fast",1.0);
									$("#Form_Edit_borrar_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
									Resetear_formulario("Form_Edit_borrar_DIV");
								}
							});
						break;
					}
				}
			}
			function Cargador_img_warper_edit(Nombre_Del_Div,Url_Imgs){
				Nombre_Del_Div="#cargador_img_slide_"+Nombre_Del_Div;
				IMGS = jQuery.parseJSON(Url_Imgs);
				var Cant_IMG=IMGS.length;
				for (var i = 0; i < Cant_IMG-1; i++) {
					Cargador_img_warper(Nombre_Del_Div,IMGS[i]);
				};
			}
		}
		/* ---------------- */
		/* Manejar Mensajes */
		function Manejar_mensajes(Que_Hacer,Post_I){
			switch (Que_Hacer) {
				case "R":
					$("#mensajes #mensajes_opcion").html("<img class=\"valign\"><span class=\"Modern_Pics\">}</span> CARGANDO...").css("color","#ccc").css("cursor","auto");
					$("#mensajes .mensajes_dia, #mensajes DD").slideUp("slow",function(){$(this).detach()});
					//setTimeout(ajax_espera, 2000); 
					var La_Data='ajx='+'LMSG';
					$.ajax({
						cache : false,
						type: 'POST',
						url: "AJAX.php",
						data:La_Data,
						success: function(data){
							$("#mensajes #mensajes_opcion").html("<img class=\"valign\"><span class=\"Modern_Pics\">R</span> Cargar Mensajes").css("color","#000").css("cursor","pointer");
							$("#mensajes").append(data);
							$(".cargando_table").fadeOut(0).hide();
							if(Post_I==0){
								$.scrollTo('#cuerpo',500);
							}
						}
					});
				break;
				case "S":
					var La_Data='ajx='+'BMSG'+'&'+ 'id_post='+encodeURIComponent(Post_I);
					var cal_dt_fecha=($("#mensajes_dd_"+Post_I).attr("class")).substring(18);
					$("#mensajes_cargando_"+Post_I).fadeTo("slow",0.8);
					$(this).detach();
					$("#mensajes_dd_"+Post_I).fadeTo("slow",0.2,function(){
						$(this).slideUp("fast",function(){
							$(this).detach();
							if($(".mensajes_dd_fecha_"+cal_dt_fecha).length==0){
								$("#mensajes_dt_fecha_"+cal_dt_fecha).fadeTo("fast",0.7).slideUp("slow",function(){
								$("#mensajes_dt_fecha_"+cal_dt_fecha).detach();
									if($("#mensajes .mensajes_dia").length==0){$("#mensajes").append("<dt class=\"mensajes_dia\"><span class=\"Modern_Pics\">!</span> Nada por ac&aacute;...</dt>");}
								});
							}
						});
					});
					$.ajax({
						type: 'POST',
						url: "AJAX.php",
						data:La_Data,
						success: function(data){}
					});
				break;
			}
		}
		/*   Manejar Correo   */
		function Cargar_Correo(){
			$("#Form_Correo_DIV fieldset").fadeTo("fast",0.3);
			$("#Form_Correo_DIV .cargando").fadeTo("fast",1.0);
			var La_Data='ajx='+'PEC';
			$.ajax({
				type: 'POST',
				url: "AJAX.php",
				data:La_Data,
				success: function(data){
					var obj = jQuery.parseJSON(data);
					if(obj.OK==1){
						$("#Form_Correo_DIV #correo").val(limpiar(obj["Data"]));
					}else{
						Resetear_formulario("Form_Correo_DIV");
					}
					$("#Form_Correo_DIV fieldset").fadeTo("fast",1.0);
					$("#Form_Correo_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
				}
			});
		}
		function Editar_Correo(){
			var InpTexts=$("#Form_Correo_DIV input[type!='button']");
			var ult_err=Validar_Formulario(InpTexts,"");
			if (ult_err==0){
				$("#Form_Correo_DIV fieldset").fadeTo("fast",0.3);
				$("#Form_Correo_DIV .cargando").fadeTo("fast",1.0);
				var	La_Data=Generar_LaData(InpTexts,"")+'ajx='+'AEC';
				$.ajax({
					type: 'POST',
					url: "AJAX.php",
					data:La_Data,
					success: function(data){
						var obj = jQuery.parseJSON(data);
						if(obj.OK==1){
							$("#Form_Correo_DIV fieldset").fadeTo("fast",1.0);
							$("#Form_Correo_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
							$("#Aviso_DIV").fadeIn("fast");
							$("#Aviso_DIV .aviso .aviso_texto").html('Correo Actualizado');
						}else{
							alert("UP's hubo un error al cargar la base de datos. Intente de nuevo!");
						}
					}
				});
			}
		}
		/* ---------------- */
		/* Manejar info     */
		function Enviar_Info(hacer){
			var InpTexts=$("#Form_Info_DIV input[type!='button'], #Form_Info_DIV textarea");
			var ult_err=Validar_Formulario(InpTexts,"");
			if (ult_err==0){
				$("#Form_Info_DIV fieldset").fadeTo("fast",0.3);
				$("#Form_Info_DIV .cargando").fadeTo("fast",1.0);
				var	La_Data=Generar_LaData(InpTexts,"");
				switch (hacer) {
					case 1:
						La_Data = La_Data+'ajx='+'PPI';
						$.ajax({
							type: 'POST',
							url: "AJAX.php",
							data:La_Data,
							success: function(data){
								$("#Post_Preview").html('<div class="separador"></div><br/>'+data+'<br/> &nbsp;  <div id="" class="DIV_FORM"><form><fieldset><input value="Guardar" name="guardar" id="guardar" type="button" onclick="Enviar_Info(2)" class="boton_es" /></fieldset></form></div>').slideDown("fast",function() {
									$("#Form_Info_DIV fieldset").fadeTo("fast",1.0);
									$("#Form_Info_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
									$.scrollTo("#Post_Preview",1000);
								});
							}
						});
					break;
					case 2:
						La_Data = La_Data+'ajx='+'GPI';
						$.scrollTo('#cuerpo',500);
						$("#Post_Preview").delay(500).slideUp("fast");
						$.ajax({
							type: 'POST',
							url: "AJAX.php",
							data:La_Data,
							success: function(data){
								$("#Form_Info_DIV fieldset").fadeTo("fast",1.0);
								$("#Form_Info_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
								$("#Aviso_DIV").fadeIn("fast");
								$("#Aviso_DIV .aviso .aviso_texto").html('Propiedad Agregada, click <a href="'+obj.Data+'" target="blank" alt="" title="">AQUI</a> para ir a al post');

							}
						});
					break;
				}
			}
		}
		function Cargar_Info(Lugar_Info){
			$("#Form_Info_DIV fieldset").fadeTo("fast",0.3);
			$("#Form_Info_DIV .cargando").fadeTo("fast",1.0);
			var La_Data='ajx='+'PLI'+ "&INF=" + encodeURIComponent(Lugar_Info);
			$.ajax({
				type: 'POST',
				url: "AJAX.php",
				data:La_Data,
				success: function(data){
					var obj = jQuery.parseJSON(data);
					if(obj.OK==1){
						$("#Form_Info_DIV #titulo").val(limpiar(obj["Data"][0].titulo));
						$("#Form_Info_DIV #contenido_textarea").val(limpiar(obj["Data"][0].contenido));
						$("#Form_Info_DIV #tag").val(limpiar(obj["Data"][0].tags));
						$("#Form_Info_DIV #info_id").val(limpiar(obj["Data"][0].ID));
						
					}
					$("#Form_Info_DIV fieldset").fadeTo("fast",1.0);
					$("#Form_Info_DIV .cargando").fadeTo("fast",0.0,function() {$(this).hide();});
				}
			});
		}
		/* ---------------- */
		/*   Manejar Menu   */
		$(".menu dd").hide();
		$(".menu dl dt").click(function() {
			var menu_ident=$(this).parent().children("dd");
			if($(menu_ident).css("display")=="none"){
			$(".menu dd").fadeOut("fast");
				$(menu_ident).fadeIn("fast");
			}
		});
		$(".menu").mouseleave(function(){
			
			$(".menu dd").fadeOut("fast");
		});
		$(".menu dl dd").click(function() {
			var Tipo=$(this).parents("dl").attr("id");
			var Nombre_Form=$(this).parents("form").attr("id");
			var Accion=$(this).attr("id");
			var Text_Area_Nombre=($(this).parents("div").attr("id"))+"_textarea";
			var dftemp="";
			var abrir="";
			var cerrar="";
			switch (Tipo){
				case "Estilo":
					abrir="["+Accion+"]";
					cerrar="[/"+Accion+"]";
				break;
				case "Alinieacion":
					abrir="[align="+Accion+"]";
					cerrar="[/align]";
				break;
				case "tamanio":
					abrir="[size="+Accion+"]";
					cerrar="[/size]";
				break;
				case "Insertar":
					switch(Accion){
						case "link":
							dftemp=prompt('Ingrese la URL que desea postear','http://');
							if(dftemp!=null && dftemp!="http://"){
								if (dftemp.substring (0, 7)!="http://" && dftemp.substring(0, 8)!="https://"){
									dftemp="http://"+dftemp;
								}

								abrir="[url="+dftemp+"]";
								cerrar="[/url]";
								dftemp=Analizar_URL (dftemp);
							}else{
								dftemp="";
							}
							break;
						case "imagen":
							Cuadro_Dialogo_img_Entrar(Nombre_Form,Text_Area_Nombre,"no","si",1000,600,"img_post/MISC/");
						break;
						case "youtube":
							dftemp=prompt('Ingrese la url del video de YouTube:\n\nEjemplo:\n http://www.youtube.com/watch?v=danYFxGnFxQ','Url del video de YouTube');
							if(dftemp!=null && dftemp!='Url del video de YouTube'){
								abrir="[align=center][youtube]"+dftemp+"[/youtube][/align]\n";
								cerrar="";
								dftemp=""
							}else{
								dftemp=""
							}
						break;
						case "vimeo":
							dftemp=prompt('Ingrese la url del video de Vimeo:\n\nEjemplo:\n http://vimeo.com/36509870','Url del video de Vimeo');
							if(dftemp!=null && dftemp!='Url del video de Vimeo'){
								abrir="[align=center][vimeo]"+dftemp+"[/vimeo][/align]\n";
								cerrar="";
								dftemp=""
							}else{
								dftemp=""
							}
						break;
					}
				break;
			}
			TextArea_Warp(Text_Area_Nombre,abrir,cerrar,dftemp);
		});
		function TextArea_Warp(Text_Area_Nombre,abrir,cerrar,d_fault){
			var Text_Area = $(Obtener_Formulario()+" #"+Text_Area_Nombre);
			var rango=Text_Area.getSelection();
			var sel_tamanio=rango.length;
			var sel_inicio=rango.start;
			var sel_final=rango.end;
			var s1=(Text_Area.val()).substring(0,sel_inicio);
			var s2=(Text_Area.val()).substring(sel_inicio,sel_final)
			var s3=(Text_Area.val()).substring(sel_final,Text_Area.val().length);
			if(sel_final==1||sel_final==2){
				sel_final=sel_tamanio;
			}
			if(sel_final!=sel_tamanio){
				abrir=abrir+d_fault;
			}
			if (Text_Area.val()==Text_Area.attr("title")){
				Text_Area.val(abrir+cerrar);
			}else{
				Text_Area.val(s1+abrir+s2+cerrar+s3);
			}
			Tam_Seleccion=sel_final+cerrar.length+abrir.length;
			Text_Area.selectRange(Tam_Seleccion,Tam_Seleccion);
		}
		/* ---------------- */
		/*   Manejar Drop   */
		Construir_Drop();
		function handleFileSelect(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			var dropeo= $($(evt.target).children());
			var dropeo_ok= $(evt.target).next("input[type=hidden]");
			var files = evt.dataTransfer.files;
			var output = [];
			for (var i = 0, f; f = files[i]; i++) {
				if (!f.type.match('image.jpeg')) {
					$(dropeo).fadeOut('fast',function(){
						$(dropeo).css("color","red").text("Solamente Imagenes JPG...").fadeIn("fast");
						$(dropeo_ok).val("");
					});
					continue;
				}else{
					var reader = new FileReader();
					reader.onloadstart = function(e) {
						$(dropeo).css("color","#acacac").text("Cargando Imagen...").fadeIn("fast").addClass("cargando_mas_post_gif");
					};
					reader.onload = (function(theFile) {
						return function(e) {
							if(theFile.size<700000){
								var data = new FormData();
								data.append('pic', theFile);
								data.append('ajx', "IMG");
								data.append('crpr', $("#Cuadro_Dialogo_dropbox_cropear").val());
								data.append('crpral', $("#Cuadro_Dialogo_dropbox_alto").val());
								data.append('crpran', $("#Cuadro_Dialogo_dropbox_ancho").val());
								data.append('dest', $("#Cuadro_Dialogo_dropbox_destino").val());
								$.ajax({
									cache: false,
									contentType: false,
									processData: false,
									type: 'POST',
									url: "AJAX.php",
									data:data,
									success: function(data){
										var obj = jQuery.parseJSON(data);
										switch(obj.status){
											case "imgmp":
												$(dropeo).removeClass("cargando_mas_post_gif").css("color","red").text("La Imagen es demaciado pequenia").fadeIn("fast");
											break;
											case "error":
												$(dropeo).removeClass("cargando_mas_post_gif").css("color","red").text("Error al cargar la imagen, Intente de nuevo").fadeIn("fast");
											break;
											default:
												$(dropeo_ok).val(obj.status)
												var span = '<img class="miniatura" src="'+ obj.status + '" title=""/>';
												$(dropeo).removeClass("cargando_mas_post_gif").html(span);
												$(".dropbox").css("width","auto");
												$(function($){
													var jcrop_api; 
													initJcrop();
													function initJcrop(){
														$("#" + $(dropeo).attr("id") + ' .miniatura').Jcrop({
															bgOpacity: 0.5,
															bgColor: 'white',
															addClass: 'jcrop-light',
															allowSelect: false,
															onSelect: Actualizar_Coordenadas
														},function(){
															jcrop_api = this;
															jcrop_api.setOptions({ bgFade: true });
															jcrop_api.ui.selection.addClass('jcrop-selection');
															var ratio_ancho = (parseInt($("#Cuadro_Dialogo_dropbox IMG").outerWidth())/obj.width);
															var ratio_alto  = (parseInt($("#Cuadro_Dialogo_dropbox IMG").outerHeight ())/obj.height);
															var ancho = parseInt($("#Cuadro_Dialogo_dropbox_ancho").val())*ratio_ancho;
															var alto  = parseInt($("#Cuadro_Dialogo_dropbox_alto").val())*ratio_alto;
															
															if ($("#Cuadro_Dialogo_dropbox_cropear").val()!="no"){
																jcrop_api.setOptions({ aspectRatio:  ancho / alto  });
																jcrop_api.setOptions({minSize: [ ancho, alto ]});
																jcrop_api.focus();
																jcrop_api.setSelect([0,0,ancho,alto]);
															}else{
																jcrop_api.setSelect([0,0,100,100]);
															}
														});
													};
												});
											break;
										}
										
									}
								});
							}else{
								$(dropeo).css("color","red").removeClass("cargando_mas_post_gif").text("La Imagen no debe superar los 700 KB").fadeIn("fast");
							}
						}
					})(f);
					reader.readAsBinaryString(f);
				}
			}
		}
		function handleDragOver(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			evt.dataTransfer.dropEffect = 'copy';
		}
		function Construir_Drop(){
			var Construir_Drop_formulario="f_Cuadro_Dialogo_imagen";
			DropArchivo_nombre=Construir_Drop_formulario+"_"+$(this).attr("id");
			$("#"+Construir_Drop_formulario+" .dropbox").attr("name",  DropArchivo_nombre);
			var DropArchivo = GE(DropArchivo_nombre); 
			DropArchivo.addEventListener('dragover', handleDragOver, true); 
			DropArchivo.addEventListener('drop', handleFileSelect, true);
		}
		/* ---------------- */
		/* Manejar Cuadro D */
		var Cuadro_Dialogo_Nombre_Form="";
		var Cuadro_Dialogo_Text_Area_Nombre="";
		var Centrar_intervalo;
		$(".Cuadro_Dialogo").hide(function(){
			$(".Cuadro_Dialogo").css("visibility","visible")
			$(".Cuadro_Dialogo_imagen").hide();
		});
		function Cuadro_Dialogo_img_Entrar(Nombre_Form,Text_Area_Nombre,Cropear,A_text_area,Cropear_Alto,Cropear_Ancho,Img_Dest){
			if (Cropear!="no"){
				$("#Cuadro_Dialogo_dropbox span").html("Tirar aca la imagen para el Post. Min. Alto: "+Cropear_Alto+"px Min. Ancho: "+Cropear_Ancho+"px");
			}else{
				$("#Cuadro_Dialogo_dropbox span").html("Tirar aca la imagen para el Post.");
			}
			$("#Cuadro_Dialogo_dropbox_cropear").val(Cropear);
			$("#Cuadro_Dialogo_dropbox_textarea").val(A_text_area);
			$("#Cuadro_Dialogo_dropbox_alto").val(Cropear_Alto);
			$("#Cuadro_Dialogo_dropbox_ancho").val(Cropear_Ancho);
			$("#Cuadro_Dialogo_dropbox_destino").val(Img_Dest);
			$(".Cuadro_Dialogo_imagen").show();
			Cuadro_Dialogo_Nombre_Form=Nombre_Form;
			Cuadro_Dialogo_Text_Area_Nombre=Text_Area_Nombre;
			//Cuadro_Dialogo_Centrar();
			$(".Cuadro_Dialogo").fadeIn("fast");
		}
		function Cuadro_Dialogo_img_Salir(){
			$(".Cuadro_Dialogo").fadeOut("fast", function(){
				if(empty($("#Cuadro_Dialogo_dropbox_output").text().trim())){
					var data = new FormData();
					data.append('ajx', "CROP");
					data.append('CROP_IMG', $("#Cuadro_Dialogo_dropbox_output_ok").val());
					data.append('CROP_X', $("#Cuadro_Dialogo_dropbox_Crop_X").val());
					data.append('CROP_Y', $("#Cuadro_Dialogo_dropbox_Crop_Y").val());
					if ($("#Cuadro_Dialogo_dropbox_cropear").val()=="si"){
						data.append('CROP_W', $("#Cuadro_Dialogo_dropbox_ancho").val());
						data.append('CROP_H', $("#Cuadro_Dialogo_dropbox_alto").val());
					}else{
						data.append('CROP_W', $("#Cuadro_Dialogo_dropbox_Crop_W").val());
						data.append('CROP_H', $("#Cuadro_Dialogo_dropbox_Crop_H").val());
					}
					data.append('CROP_RATIO', $("#Cuadro_Dialogo_dropbox_cropear").val());
					data.append('CROP_un_W', $("#Cuadro_Dialogo_dropbox IMG").outerWidth());
					data.append('CROP_un_H', $("#Cuadro_Dialogo_dropbox IMG").outerHeight());
					$.ajax({
						cache: false,
						contentType: false,
						processData: false,
						type: 'POST',
						url: "AJAX.php",
						data:data,
						success: function(data){
							
						}
					});
					if ($("#Cuadro_Dialogo_dropbox_textarea").val()=="si"){
						TextArea_Warp(Cuadro_Dialogo_Text_Area_Nombre," ","[align=center][img="+$("#Cuadro_Dialogo_dropbox_output_ok").val()+"][/align]","");
					}else{
						Cargador_img_warper(Cuadro_Dialogo_Nombre_Form,$("#Cuadro_Dialogo_dropbox_output_ok").val());	
					}
				}
				$("#Cuadro_Dialogo_dropbox_output").text("Tirar aca la imagen para el Post");
				$("#Cuadro_Dialogo_dropbox_ok").val("");
				$("#Cuadro_Dialogo_dropbox_alto").val("");
				$("#Cuadro_Dialogo_dropbox_ancho").val("");
				$("#Cuadro_Dialogo_dropbox_destino").val("");
				$("#Cuadro_Dialogo_dropbox_cropear").val("");
				$("#Cuadro_Dialogo_dropbox_textarea").val("");
				$(".Cuadro_Dialogo_imagen").hide();
				$(".dropbox").css("width","900px");
			});
		}
		function Cuadro_Dialogo_Centrar(){
			$(".Cuadro_Dialogo").css("margin-top",-(($(".Cuadro_Dialogo").outerHeight())/2));
			$(".Cuadro_Dialogo").css("margin-left",-(($(".Cuadro_Dialogo").outerWidth())/2));
		}
		function Actualizar_Coordenadas(c){
			$('#Cuadro_Dialogo_dropbox_Crop_X').val(c.x);
			$('#Cuadro_Dialogo_dropbox_Crop_Y').val(c.y);
			$('#Cuadro_Dialogo_dropbox_Crop_W').val(c.w);
			$('#Cuadro_Dialogo_dropbox_Crop_H').val(c.h);
		};
		/* ---------------- */
		/*     Misc         */
		function Validar_Formulario(formulario){
			var bandera=true;
			/*
			$(formulario+" .cargador_img").each(function(){
				var Cargadores_IMG_ID="#"+$(this).attr("id");
				if ($(Cargadores_IMG_ID + " .cargador_img_lista_archivos LI").length==0){
					$(Cargadores_IMG_ID+"_err").html("Al  menos una imagen");
					Manejo($(this).attr("id"));
				}
			});
			$(formulario+" input[type!='button'], #Form_Post_DIV textarea, #Form_Post_DIV select").each(function(){
				if( (empty($(this).val()) || $(this).val()==$(this).attr("title")) && !$(this).hasClass("no_req") ){
					$(formulario+" #"+$(this).attr("id")+"_err").html("Campo Obligatorio");
					
				} else if ($(this).attr("id")=="correo" && !Validar_Mail($(this).val())) {
					$(formulario+" #"+$(this).attr("id")+"_err").html("El Correo Electronico no es valido");
					Manejo($(this).attr("id"));
				}
			});
			function Manejo(elemento){
				if(bandera){
					bandera=false;
					$.scrollTo(formulario+" #"+elemento,500);
				}
			}
			*/
			return bandera;
		}
		function Generar_LaData(formulario){
			var	La_Data="";
			$(formulario+" input[type!='button'], #Form_Post_DIV textarea, #Form_Post_DIV select").each(function(){
				if ($(this).hasClass("no_req") && $(this).val()==$(this).attr("title")){
					La_Data = La_Data + $(this).attr("id") + '=' + encodeURIComponent(sValidosarCadena("")) + '&' ;	
				} else {
					La_Data = La_Data + $(this).attr("id") + '=' + encodeURIComponent(sValidosarCadena($(this).val())) + '&' ;
				}
			});
			$(formulario+" .cargador_img").each(function(){
				var Cargadores_IMG=$(this).attr("id");
				var Cargadores_IMG_LI=$("#" + Cargadores_IMG + " .cargador_img_lista_archivos LI");
				var json_XD = "[";
				$.each(Cargadores_IMG_LI,function(){
					var ID_LI="#"+$(this).attr("id");
					json_XD = json_XD + "\"" + $(ID_LI+" .Url_Img").text().trim() + "\"" + ", ";
				});
				json_XD = json_XD + "\"\"]";
				La_Data = La_Data + Cargadores_IMG + '=' + encodeURIComponent(json_XD) + '&' ;
			});
			return La_Data;
		}
		function Resetear_formulario(formulario){
			var InpTexts=$("#"+formulario+" input[type!='button'], #"+formulario+" textarea, #"+formulario+" select");
			var Cargadores_IMG=$("#"+formulario+" .cargador_img");
			$.each(InpTexts,function(){
				$(this).val($(this).attr("title"));
			});
			$.each(Cargadores_IMG,function(){
				if($(this).attr("id")=="cargador_img_slide_Portada"){
					var Cargadores_IMG="#"+$(this).attr("id");
					var Cant_LI=$(Cargadores_IMG + " .cargador_img_lista_archivos LI").length;
					$(Cargadores_IMG + " .cargador_img_lista_archivos LI").detach();
					$(Cargadores_IMG + " #cargador_cant_img").text(parseInt($(Cargadores_IMG + " #cargador_cant_img").text().trim())+Cant_LI);
					$(Cargadores_IMG + " .cargador_img_subir").fadeIn("fast");
				}
			});
		}
		function Obtener_Formulario(){
			return "#Form_"+Donde_Estoy;
		}
		function Analizar_URL (STR) {
			Ultimo_Slash=STR.lastIndexOf ('/', STR.length-1)
			STR_Out=STR.substring (0, Ultimo_Slash+1)
			if (STR_Out!="http://"){
				return (STR_Out); 
			}
		}
		function Analizar_IMG (STR) {
			Ultimo_Slash=STR.lastIndexOf ('/', STR.length-1)
			Ultimo_Dot=STR.lastIndexOf ('.', STR.length-1)
			STR_Out=STR.substring (Ultimo_Slash+1, Ultimo_Dot)
			return (STR_Out); 
		}
		function Cambiar_Lugar (lugar) {
			$("#Post_Preview").slideUp("fast",function(){
				$(this).html("");
				$("#"+Donde_Estoy).slideUp("slow", function() {
					switch (lugar) {
						case "agregar_post":
							 Donde_Estoy="Post_DIV";
							 Lugar_Info="agregar";
							 Resetear_formulario("Form_Post_DIV");
						break;
						case "editar_post":
							 Donde_Estoy="Post_DIV";
							 Lugar_Info="editar";
						break;
						case "editar_post":
							 Donde_Estoy="Post_DIV";
							 Lugar_Info="editar_post";
							 Resetear_formulario("Form_Post_DIV");
						break;
						case "borrar":
							 Donde_Estoy="Edit_borrar_DIV";
							 Lugar_Info="borrar";
							 Resetear_formulario("Form_Edit_borrar_DIV");
						break;
						case "edit":
							Donde_Estoy="Edit_borrar_DIV";
							Lugar_Info="edit";
							Resetear_formulario("Form_Edit_borrar_DIV");
						break;
						case "Correo":
						case "Correo_DIV":
							Donde_Estoy="Correo_DIV";
							Lugar_Info="";
							Cargar_Correo();
						break;
						case "Mensajes":
						case "Mensajes_DIV":
							 Donde_Estoy="Mensajes_DIV";
							 Lugar_Info="";
							 Manejar_mensajes('R',0);
						break;
						case "servicios":
						case "quienes_somos":
						case "terminosycondiciones":
							 Donde_Estoy="Info_DIV";
							 Lugar_Info=lugar;
							 Cargar_Info(Lugar_Info);
						break;
					}
					$(".aviso_cerrar").click();
					$("#"+Donde_Estoy).slideDown("slow", function() {
						Tamanio_Cargar();
						$.scrollTo('#botonera',500);
					});
					$.cookie("Cookie_Donde_Estoy", Donde_Estoy, { expires: 7 });
					$.cookie("Cookie_Lugar_Info", Lugar_Info, { expires: 7 });
				});
			});
		}
		function permite(elEvento,permitidos){
			var numeros="0123456789";
			var caracteres="abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ";
			var simbolos="!$%&()=?¡._-,;.:@*[]+{}"
			var retroceso=String.fromCharCode(8);
			var tab=String.fromCharCode(9);
			var caracteres_simbolos=simbolos+caracteres;
			var fechas=numeros+"/";
			var numeros_caracteres=numeros+caracteres;
			var numeros_simbolos=numeros+simbolos;
			var todo=simbolos+caracteres+numeros+"";
			switch(permitidos){
			case 'num':
				permitidos=numeros;
			break;
			case'car':
				permitidos=caracteres;
			break;
			case 'car_sim':
				permitidos=caracteres+simbolos;
			break;
			case 'num_car':
				permitidos=numeros_caracteres;
			break;
			case 'num_sim':
				permitidos=numeros_simbolos;
			break;
			case 'fecha':
				permitidos=fechas;
			break;
			case 'todo':
				permitidos=todo;
			}
			permitidos=permitidos+tab+retroceso;
			var evento=elEvento||window.event;
			var codigoCaracter=evento.charCode||evento.keyCode;
			var caracter=String.fromCharCode(codigoCaracter);
			return permitidos.indexOf(caracter)!=-1;
		}
		function Login_Salir(){
			$.cookie("Login_Petrino_User", "", { expires: 7 });
			$.cookie("Login_Petrino_Veri", "", { expires: 7 });
			window.location.reload();
		}
		$(".aviso_cerrar").click(function(){
			$("#Aviso_DIV").fadeOut("normal", function(){
				$(this).css("display","none");
			});
		});
		$(document).ready(function letsFuckingParty(){
			if (!empty(Lugar_Info)){
				Cambiar_Lugar (Lugar_Info);
			}else{
				Cambiar_Lugar (Donde_Estoy);
			}
		});
		/* ---------------- */
		/*---> y colorín, colorado este script se ha acabado*/
	</script>