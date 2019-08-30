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
					if ($_GET['vuelta'] == 1)
						$_SESSION["DiasPasados"] = (int)$_SESSION["DiasPasados"] + 1;
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
			case 'GetNewTrabajos':
				echo $_SESSION['trabajos'];
				include 'classDia.php';
				include 'classTrabajador.php';
				GetDaysFromSession();
				GetWorkersFromSession();
				$ThisDay = $ListDias[count($ListDias) - 1]->Dia;
				for($i = 0; $i < count($ListTrabajadores); $i++){
					$ListTrabajadores[$i]->ListTrabajos
				}				
				if ((int)$_SESSION['trabajos'] > (int)$_SESSION["NumeroTrabajadores"])
					$_SESSION['trabajos'] = (int)$_SESSION['trabajos'] - (int)$_SESSION["NumeroTrabajadores"];
				else 
					$_SESSION['trabajos'] = 0;	
			break;
		}
	} else {
		echo 'Error al seleccionar función.';
	}
?>