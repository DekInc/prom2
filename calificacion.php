<?php
	session_start();
?>
<?php 	
	/**
	 * 
	 */
	
	
function generar(){				
			$resultado=rand(1,10);
			if ($resultado == 10)
			{
				$resultado=rand(1,10);
				if($resultado==1||$resultado==3||$resultado==5||$resultado==7){
					return "Calificacion ".rand(2,3);
				}else{
					$resultado=rand(1,10);
					if($resultado==5){
						return "Calificacion 1";
					}else{generar();}
				}
			}
			else 
			{
				
				return "Calificacion ".rand(4,5);
			}
	}
	
	
	
?>