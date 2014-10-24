<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<? 	if( !defined( '_AUTOGAN' ) && !defined( '_VALID_VVM' ) ) die( 'Restricted access' ); ?>
<? 
	if(!isset($meta_Keywords))$meta_Keywords="";
	if(!isset($meta_Subject))$meta_Subject="";
	if(!isset($meta_Title))$meta_Title="";
	if(!isset($meta_canonical))$meta_canonical="";
	$meta_Keywords="Petrino Inmobiliaria, ".$meta_Keywords;
	$meta_Subject=$GLOB_Pagina.$meta_canonical;
	$meta_canonical=$GLOB_Pagina.$meta_canonical;
	$meta_Title="Petrino Inmobiliaria ".$meta_Title;
	if(!isset($Facebook_Pic) || $Facebook_Pic=="")$Facebook_Pic="img/FB-Pic.jpg";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/Blog">
	<head>
		<meta name="msvalidate.01" content="F62B435AC3D987645717634BB208D6AB"/> 
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"/>
		<meta name='title' content='<? echo $meta_Title ?>' />
		<meta name='author' content='Juan Martin Machado' />
		<meta name='subject' content='<? echo $meta_Subject ?>' />
		<meta name='description' content='<? echo $meta_Description ?>' />
		<meta name='keywords' content='<? echo $meta_Keywords ?>' />
		<meta name='language' content='spanish' />
		<meta name='revisit' content='1 day' />
		<meta name='distribution' content='global' />
		<meta name='robots' content='all' />
		<link rel='canonical' href='<? echo $meta_canonical ?>' /> 
		<link rel="shortcut icon" href="<? echo traducir_url('favicon.ico') ?>" type="image/vnd.microsoft.icon" />
		<link rel="stylesheet" type="text/css" href="<? echo traducir_url('css/principal.css') ?>" />
		<meta property="fb:app_id" content="230506060318310"/> 
		<meta property="fb:admins" content="256891047692699"/>
		<meta property="og:title" content="<? echo $meta_Title ?>"/>
		<meta property="og:site_name" content="Petrino"/>
		<meta property="og:url" content="<? echo $meta_canonical ?>"/>
		<meta property="og:description"  content="<? echo $meta_Description ?>"/>
		<meta property="og:type" content="blog" />
		<meta property="og:image" content="<? echo traducir_url($Facebook_Pic) ?>" />
		<meta itemprop="name" content="<? echo $meta_Title ?>">
		<meta itemprop="description" content="<? echo $meta_Description ?>">
		<meta itemprop="image" content="<? echo traducir_url($Facebook_Pic) ?>">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript">window.jQuery || document.write('<script src="<? echo traducir_url('js/jquery.min.js') ?>"><\/script>')</script>
		<script src="<?=traducir_url('js/jQuery.ScrollTo.js') ?>" type="text/javascript"></script>

		
		
		<?/*<script type="text/javascript">window.jQuery || document.write('')</script>*/?>

		<title><? echo $meta_Title ?></title>
	</head>
	<body>
		<div id="fb-root"></div>
		<script type="text/javascript">
			<? if (Bandera("online"))echo "function detenerError(){return true};window.onerror=detenerError;" ?>
			<? if (false) { ?>
			/** Api de Twitter **/
			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
			/*------------------*/
			/** Google Analitycs **/
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-21787039-1']);
			_gaq.push(['_setDomainName', '.inmobiliariapetrino.com.ar']);
			_gaq.push(['_deleteCustomVar', 1]);
			_gaq.push(['_trackPageview']);
			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
			/*-------------------*/
			/** Api de Facebook **/
			window.fbAsyncInit = function() {FB.init({appId: '230506060318310', status: true, cookie: true,xfbml: true});FB.api('/me', function(response) {console.log(response.name);});};
			(function() {var e = document.createElement('script'); e.async = true; e.src = document.location.protocol + '//connect.facebook.net/es_LA/all.js';document.getElementById('fb-root').appendChild(e);}());
			/*------------------*/
			/** Api de Google+ **/
			window.___gcfg = {lang: 'es-419'};
			(function () {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
			/*--------*/
			<? }  ?>
			/** Misc **/
			function empty(a){var b;if(""===a||0===a||"0"===a||null===a||!1===a||"undefined"===typeof a)return!0;if("object"==typeof a){for(b in a)return!1;return!0}return!1}function GE(a){return document.getElementsByName(a)[0]};
			/*--------*/
			/*
			if (!window.console) { window.console = {log: function(){}} };
			function rmt(l) { var img = new Image(); img.src = l; document.getElementById('tmp-img').appendChild(img); } 
			function fbWindow(location, address, gaCategory, gaAction, entryLink) { _gaq.push(['_trackEvent', gaCategory, gaAction, entryLink, 1]); var w = 640; var h = 460; var sTop = window.screen.height/2-(h/2); var sLeft = window.screen.width/2-(w/2); var sharer = window.open(address, "Share", "status=1,height="+h+",width="+w+",top="+sTop+",left="+sLeft+",resizable=0"); }
			function twttrWindow(location, address, gaCategory, gaAction, entryLink) { _gaq.push(['_trackEvent', gaCategory, gaAction, entryLink, 1]); var w = 640; var h = 460; var sTop = window.screen.height/2-(h/2); var sLeft = window.screen.width/2-(w/2); var sharer = window.open(address, "Share", "status=1,height="+h+",width="+w+",top="+sTop+",left="+sLeft+",resizable=0"); }
			*/
			/*--------*/
		</script>
			<div id="cabecera" class="sombra">
				<a href="<? echo traducir_url("inicio") ?>" id="logo"></a>
				<div id="cabecera_arriba">
					<a href="<? echo traducir_url("inicio") ?>" id="logo"></a>
					<div class="botones_Sociales">
						<ul class="social"> 
							<li>
							<div class="facebook-like"> 
							<div class="fb-like" data-href="https://www.facebook.com/PetrinoInmobiliariaGrupo" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
							</div>
							</li>
							<li>
							<div class="google-plus"> 
							<g:plusone size="medium"></g:plusone>
							</div>
							</li>
							<li>
							<div class="twitter-follow">
									<a href="https://twitter.com/PetrinoSL" class="twitter-follow-button" data-show-count="false" data-lang="es" data-dnt="true">Seguir a @PetrinoSL</a>
							</div>
							</li>
						</ul> 
					</div>
				</div>
				<div id="menu">
					<div id="repisa">
					<a href="<? echo traducir_url("inicio") ?>"   >Inicio</a> 
					<a href="<? echo traducir_url("alquiler") ?>" >Alquiler</a>
					<a href="<? echo traducir_url("ventas") ?>"   >Ventas</a>
					<a href="<? echo traducir_url("servicios") ?>" >Servicios</a>
					<a href="<? echo traducir_url("quienes_somos") ?>"  >Quienes Somos</a>
					<a href="<? echo traducir_url("contacto") ?>"  >Contacto</a>
					</div>
				</div>
			</div>
			<div id="cuerpo" class="sombra">
