<?php
	session_start();
	session_unset(); 
	session_destroy();
	session_start();
	include 'classTrabajador.php';
	include 'classDia.php';	
	
	$_SESSION["trabajos"] = $_POST['numerotrabajos'];
	$_SESSION["MaxTrabajos"] = $_POST['txtMaxTrabajos'];
	$_SESSION["BaseCrecimiento"] = 0;
	$_SESSION["CapacidadMax"] = $_POST['CapacidadMaxdiaria'];
	$_SESSION["DuracionTarea"] = $_POST['duraciontarea'];
	$_SESSION["Remuneracion"] = $_POST['remuneracion'];
	$_SESSION["VelAnimacion"] = $_POST['VelAnimacion'];
	$_SESSION["DiasPasados"] = 0;
	$_SESSION["NumeroTrabajadores"] = $_POST['txtNumeroTrabajadores'];		
	// $_SESSION["CapacidadMax"] = $_POST['submit'];
	// $_SESSION["DuracionTarea"] = $_POST['submit'];
	$_SESSION["Trabajoefectivo"] = $_POST['trabajoefectivo'];
	$_SESSION["newsession"] = true;
	$_SESSION["saveddata"] = true;
	unset($_POST['submit']);	
	
	AddNewRandomWorkers($_SESSION["NumeroTrabajadores"]);
	SaveWorkersToSession();		
	
	$NewDay = new Dia(date("d/m/Y"), 1);
	AddNewDay($NewDay);
	SaveDaysToSession();
?>