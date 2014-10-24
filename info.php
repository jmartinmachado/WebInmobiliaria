<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'var_glob.php'        ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
 <?
 	$Obtener=Obtener_info($_GET["tipo"]);
 	if ($Obtener["OK"]==1){
		$meta_Keywords=$Obtener["Data"][0]["tags"];
		$meta_canonical=$_GET["tipo"];
		$meta_Title="- ".$Obtener["Data"][0]["titulo"];
		$meta_Description=$Obtener["Data"][0]["descripcion"];
	}

?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'part_arriba.php'     ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
		<div id="cuerpo_centro">
			<?
			 if ($Obtener["OK"]==1){
				echo Generar_Info($Obtener["Data"][0]["titulo"],$Obtener["Data"][0]["contenido"]);
			 }else{
			 	echo Generar_Info("","");
			 } 
			?>
			<a href="javascript:$.scrollTo('#cabecera',800);" id="cuerpo_abajo"><img class="valign" alt="" src=""/>IR AL CIELO</a>
		</div>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
<?    require_once 'part_abajo.php'      ?>
<? /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/ ?>
