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
				include 'classDia.php';
				include 'classTrabajador.php';
				GetDaysFromSession();
				GetWorkersFromSession();
				//Primer inicialización basada en 1 trabajador
				// if ($_SESSION["NumeroTrabajadores"] == 0) {					
					// // addnewrandomworkers(1);
					// // SaveWorkersToSession();
					// $_SESSION['MaxTrabajos'] = $_SESSION['trabajos'];
					// $_SESSION['trabajos'] = 180;
					// // $_SESSION["NumeroTrabajadores"] = 1;
				// }
				echo $_SESSION['trabajos'];
				$ThisDay = $ListDias[count($ListDias) - 1];
				$NumeroTrabajadores = (int)$_SESSION["NumeroTrabajadores"];
				$BaseCrecimiento = (((int)$_SESSION["CapacidadMax"] / (int)$_SESSION["DuracionTarea"]) * (int)$_SESSION["NumeroTrabajadores"]) * 30;				
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
							if (
								($ListTrabajadores[$i]->ListTrabajos[count($ListTrabajadores[$i]->ListTrabajos) - 1]->Calificacion == 2
									|| $ListTrabajadores[$i]->ListTrabajos[count($ListTrabajadores[$i]->ListTrabajos) - 1]->Calificacion == 3
								)
								&& ($ListTrabajadores[$i]->ListTrabajos[count($ListTrabajadores[$i]->ListTrabajos) - 2]->Calificacion == 2
									|| $ListTrabajadores[$i]->ListTrabajos[count($ListTrabajadores[$i]->ListTrabajos) - 2]->Calificacion == 3
								)
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
				if (count($ListTrabajadoresXMes) == 0){
					// AddTrabajadorXMes(0, 0);
					AddTrabajadorXMes(1, (int)$_SESSION["NumeroTrabajadores"]);
				}
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
							$_SESSION['trabajos'] = $_SESSION['trabajos'] - $_SESSION['trabajos'] * (rand(10, 40) / 100);
						else
							$_SESSION['trabajos'] = $_SESSION['trabajos'] - $_SESSION['trabajos'] * (rand(5, 15) / 100);
					} else {						
						if ($SeSube > 1){
							$_SESSION['trabajos'] = (int)$_SESSION["NumeroTrabajadores"] * ($_SESSION['trabajos'] + $BaseCrecimiento * (rand(120, 140) / 100));
						} else if ($_SESSION['trabajos'] > $BaseCrecimiento) {
							$_SESSION['trabajos'] = (int)$_SESSION["NumeroTrabajadores"] * ($_SESSION['trabajos'] + $BaseCrecimiento * (rand(40, 100) /100));
						} else {
							$_SESSION['trabajos'] = (int)$_SESSION["NumeroTrabajadores"] * ($_SESSION['trabajos'] + $BaseCrecimiento * (rand(60, 100) / 100));
						}
					}
					//Capacidad operativa
					if ($_SESSION['trabajos'] < ($_SESSION["MaxTrabajos"] * 0.5)) {
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
					else if ($_SESSION['trabajos'] > ($_SESSION["MaxTrabajos"] * 0.5)){
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
					if ($_SESSION['trabajos'] >= $_SESSION['MaxTrabajos'])
						$_SESSION['trabajos'] = $_SESSION['MaxTrabajos'] * (rand(5, 10) / 10);					
				}
				if (substr($ThisDay->Dia, 0, 2 ) === "15" && count($ListTrabajosXMes) > 1 && $ThisDay->Vuelta == 1){
					if($_SESSION['trabajos'] < $_SESSION['MaxTrabajos'] * 0.36) 
						$_SESSION['trabajos'] = $_SESSION['MaxTrabajos'] * (rand(5, 10) / 10);
				}
				if (count($ListTrabajosXMes) == 0) {
					AddTrabajosXMes(0, 0);
					AddTrabajosXMes(1, (int)$_SESSION["trabajos"]);
				}
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