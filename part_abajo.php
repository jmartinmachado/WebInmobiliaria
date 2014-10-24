<? 	if( !defined( '_AUTOGAN' ) && !defined( '_VALID_VVM' ) ) die( 'Restricted access' ); ?>
			<div id="pie"><img class="valign" alt="" src=""/>Petrino Inmobiliaria © 2012 - <a href="<? echo traducir_url('terminosycondiciones') ?>" title="" alt="">Terminos y Condiciones Generales</a> - <a href="http://juanmartinmachado.com.ar/" title="" alt="" target="_blan">Diseño y Desarrollo</a></div>
		</div>
		<?/* <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>*/?>
		
		<?
			if (bandera("optimizado")){		
				require_once 'part_abajo_script_optimizado.php';
			}else{
				require_once 'part_abajo_script.php';
			}
		?>
	</body>
</html>