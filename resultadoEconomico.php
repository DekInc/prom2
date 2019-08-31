<?php
	class calcular{
		public function media($arreglo)
		{
			$suma=0;
			foreach ($arreglo as $valor){
					$suma=$suma+$valor;
				}	
			$dividendo=count($arreglo);
			return ($suma/dividendo);
		}
		public function varianza($arreglo){
			$suma=0;
			$media=media($arreglo);
			foreach ($arreglo as $valor) {
				$suma=$suma+pow(($valor-$media),2);
			}
			return ($suma/dividendo);
		}
		public function mediana($arreglo){

			echo (count($arreglo)%2);
			if((count($arreglo)%2)==1)
			{
				return $arreglo[((count($arreglo)/2)+0.5)];
			}
			else
			{
				$numero1=$arreglo[((count($arreglo)/2)-1)];
				$numero2=$arreglo[((count($arreglo)/2)+1)];
				return(($numero1+$numero2)/2);
			}
		}
		public function obtener($arreglo){
			return array('media' => media($arreglo), 'mediana' => mediana($arreglo),'varianza' => varianza($arreglo));
		}
	
	}
	
?>