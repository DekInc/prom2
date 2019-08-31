<?php
	error_reporting(0);
	session_start();	
	if(isset($_GET["function"])){
		switch($_GET["function"]){
			case 'Reset':
				include 'classDia.php';
				include 'classTrabajador.php';
				ResetTrabajadorXMes();
				ResetTrabajosXMes();
				ResetDaysFromSession();
			break;
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
				$ThisDay = $ListDias[count($ListDias) - 1];
				$NumeroTrabajadores = (int)$_SESSION["NumeroTrabajadores"];
				$BaseCrecimiento = (((int)$_SESSION["CapacidadMax"] / (int)$_SESSION["DuracionTarea"]) * (int)$_SESSION["NumeroTrabajadores"]) * 30;
				//Primer inicialización basada en 1 trabajador
				if ($BaseCrecimiento == 0) {
					$BaseCrecimiento = 120;
					addnewrandomworkers(1);
					SaveWorkersToSession();
					$_SESSION['trabajos'] = $BaseCrecimiento;
				}
				$_SESSION["BaseCrecimiento"] = $BaseCrecimiento;
				for($i = 0; $i < count($ListTrabajadores); $i++){
					if ($ListTrabajadores[$i]->Activo) {
						$ListTrabajadores[$i]->ListTrabajos[] = new Trabajos($ThisDay, GetScore());
						//call_user_func(array($ListTrabajadores[$i], 'CalcSalario'));
						// $this->ListTrabajadores[$i]->CalcSalario();
						if (count($ListTrabajadores[$i]->ListTrabajos) > 1){
							if (
								$ListTrabajadores[$i]->ListTrabajos[count($ListTrabajadores[$i]->ListTrabajos) - 1]->Calificacion == 1
								&& $ListTrabajadores[$i]->ListTrabajos[count($ListTrabajadores[$i]->ListTrabajos) - 2]->Calificacion == 1
							) {
								$ListTrabajadores[$i]->Activo = false;
								if ($_SESSION['trabajos'] > $BaseCrecimiento){
									addnewrandomworkers(1);									
									$NumeroTrabajadores++;
								}
							}
						}
					} else $NumeroTrabajadores--;
				}
				SaveWorkersToSession();
				GetTrabajadorXMes();
				GetTrabajosXMes();
				if (count($ListTrabajadoresXMes) == 0)
					AddTrabajadorXMes(1, (int)$_SESSION["NumeroTrabajadores"]);
				else if (substr($ThisDay->Dia, 0, 2 ) === "01" && $ThisDay->Vuelta == 1) {
					$TrabajadoresActivosXMes = 0;
					for($i = 0; $i < count($ListTrabajadores); $i++){
						if ($ListTrabajadores[$i]->Activo)
							$TrabajadoresActivosXMes++;
					}
					AddTrabajadorXMes(($ListTrabajadoresXMes[count($ListTrabajadoresXMes) - 1]->x + 1), (int)$TrabajadoresActivosXMes);
				}
				//Operación de incrementar o disminuir los trabajos, onda sinuidal...
				if (substr($ThisDay->Dia, 0, 2 ) === "01" && count($ListTrabajosXMes) > 1 && $ThisDay->Vuelta == 1){
					$SeSube = rand(1, 2);
					if (($ListTrabajadoresXMes[count($ListTrabajadoresXMes) - 1]->x) == 12) {
						if ($_SESSION['trabajos'] > $BaseCrecimiento)
							$_SESSION['trabajos'] = $_SESSION['trabajos'] - $_SESSION['trabajos'] * (rand(40, 80) / 100);
						else
							$_SESSION['trabajos'] = $_SESSION['trabajos'] - $_SESSION['trabajos'] * (rand(5, 15) / 100);
					} else {						
						if ($SeSube == 2){
							$_SESSION['trabajos'] = $_SESSION['trabajos'] + $BaseCrecimiento * (rand(100, 140) / 100);
						} else if ($_SESSION['trabajos'] > $BaseCrecimiento) {
							$_SESSION['trabajos'] = $_SESSION['trabajos'] - $_SESSION['trabajos'] * (rand(1, 10) /100);
						} else {
							$_SESSION['trabajos'] = $_SESSION['trabajos'] - $BaseCrecimiento * (rand(10, 40) / 100);
						}
					}
					//Capacidad operativa
					if ($_SESSION['trabajos'] < ($BaseCrecimiento * 0.6)) {
						$z = 0;
						$TrabajadorADesactivar = null;
						$ContTrabajadoresActivos = 0;
						for($z = 0; $z < count($ListTrabajadores); $z++)
							if ($ListTrabajadores[$z]->Activo)
								$ContTrabajadoresActivos++;
						if ($ContTrabajadoresActivos > 1){
							for($z = 0; $z < count($ListTrabajadores); $z++){
								if ($ListTrabajadores[$z]->Activo) {
									$ListTrabajadoresXMes[$z]->Activo = false;
									$z = count($ListTrabajadores);
								}								
							}						
							$_SESSION["NumeroTrabajadores"] = $_SESSION["NumeroTrabajadores"] - 1;
							SaveWorkersToSession();
						}
					}
					else if ($_SESSION['trabajos'] > ($BaseCrecimiento * 3.0)){
						addnewrandomworkers(1);
						saveworkerstosession();
						$_SESSION["NumeroTrabajadores"] = $_SESSION["NumeroTrabajadores"] + 1;
					} 					
					// else if ($_SESSION['trabajos'] > ($BaseCrecimiento * 1.4) && $_SESSION['trabajos'] < ($BaseCrecimiento * 1.8)){
						// AddNewRandomWorkers(1);
						// SaveWorkersToSession();
					// } 
					// else if ($_SESSION['trabajos'] > ($BaseCrecimiento) * 1.8 && $_SESSION['trabajos'] < ($BaseCrecimiento * 2.2)){
						// AddNewRandomWorkers(1);						
						// AddNewRandomWorkers(1);
						// SaveWorkersToSession();
					// } 
					// else if ($_SESSION['trabajos'] > ($BaseCrecimiento * 1.8)){
						// AddNewRandomWorkers(1);
						// AddNewRandomWorkers(1);
						// AddNewRandomWorkers(1);
						// SaveWorkersToSession();
					// }
				}
				if (count($ListTrabajosXMes) == 0)
					AddTrabajosXMes(1, (int)$_SESSION["trabajos"]);
				else if (substr($ThisDay->Dia, 0, 2 ) === "01" && $ThisDay->Vuelta == 1){
					AddTrabajosXMes(($ListTrabajosXMes[count($ListTrabajosXMes) - 1]->x + 1), (int)$_SESSION["trabajos"]);
				}
				SaveTrabajadorXMes();
				SaveTrabajosXMes();
				if ((int)$_SESSION['trabajos'] > (int)$_SESSION["NumeroTrabajadores"]) {					
					$_SESSION['trabajos'] = (int)$_SESSION['trabajos'] - $NumeroTrabajadores;
				}
				else {
					$_SESSION['trabajos'] = 0;	
				}
			break;
		}
	} else {
		echo 'Error al seleccionar función.';
	}
?>