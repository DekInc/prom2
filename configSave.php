<?php
	session_start();
	$_SESSION["trabajos"] = $_POST['numerotrabajos'];
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
	
	include 'classTrabajador.php';
	AddNewRandomWorkers($_SESSION["NumeroTrabajadores"]);
	SaveWorkersToSession();	
	
	include 'classDia.php';
	$NewDay = new Dia(date("d/m/Y"), 1);
	AddNewDay($NewDay);
	SaveDaysToSession();
?>