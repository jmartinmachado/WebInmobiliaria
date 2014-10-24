<?
	if( !defined( '_AUTOGAN' ) && !defined( '_VALID_VVM' ) ) die( 'Restricted access' );
	function Login($usuario,$contra){
		$Obtener=Obtener_Usuario_Pass();
		$Obtener_count=count($Obtener);
		if ($Obtener_count>0){
			if ($contra==$Obtener["contrasenia"]){
				return array("user" =>$usuario,"verf" => md5($usuario.$contra.FechaStr()));
			}else{
				return array("user" =>"","verf" => "INVALIDO");
			}

		}else{
			return array("user" =>"","verf" => "INVALIDO");
		}
	}
?>