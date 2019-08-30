<?php
	error_reporting(0);
	session_start();	
	if(isset($_GET["function"])){
		switch($_GET["function"]){
			case 'GetActualDay':
				include 'classDia.php';
				GetDaysFromSession();
				if (count($ListDias) > 0)
					echo json_encode($ListDias[count($ListDias) - 1]);
			break;
			case 'AddVueltaActualDay':
				include 'classDia.php';
				GetDaysFromSession();
				if (count($ListDias) > 0 && isset($_GET['vuelta'])){					
					$ListDias[count($ListDias) - 1]->Vuelta = $_GET['vuelta'];
					SaveDaysToSession();
					echo 1;
				}
			break;
			case 'AddDayActualDay':
				include 'classDia.php';
				GetDaysFromSession();
				if (count($ListDias) > 0){
					$ThisDay = DateTime::createFromFormat('d/m/Y', $ListDias[count($ListDias) - 1]->Dia);					
					$ThisDay->add(new DateInterval('P1D'));
					$ListDias[count($ListDias) - 1]->Dia = $ThisDay->format('d/m/Y');
					SaveDaysToSession();
					echo 1;
				}
			break;
		}
	} else {
		echo 'Error al seleccionar función.';
	}
?>