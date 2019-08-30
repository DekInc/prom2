<?php
	session_start();
	class Trabajos{		
		public $Dia = null;
		public $Calificacion = 0;
		public function __construct($Dia_, $Calificacion_){			
			$this->Dia = $Dia_;
			$this->Calificacion = $Calificacion_;
		}
	}
	$ListTrabajadores = [];	
	class Trabajador{
		public $Nombre = '';
		public $Salario = 0.0;
		public $ListTrabajos = null;
		public function __construct($Nombre_){
			$this->Nombre = $Nombre_;
		}
	}
	function AddNewWorker($Nombre_) {
		global $ListTrabajadores;
		$ListTrabajadores[] = new Trabajador($Nombre_);
		//print_r($ListTrabajadores);
	}
	function AddNewRandomWorkers($Num) {
		global $ListTrabajadores;
		for($i = 0; $i < $Num; $i++){
			$Rand1 = rand(1, 6660);
			AddNewWorker('Trabajador_' . $Rand1);
		}		
	}
	function SaveWorkersToSession() {
		global $ListTrabajadores;
		$_SESSION['ListTrabajadores'] = json_encode($ListTrabajadores);
		//print_r($ListTrabajadores);
		//echo serialize($ListTrabajadores) . '<br>';
	}
	function GetWorkersFromSession() {
		global $ListTrabajadores;
		$ListTrabajadores = json_decode($_SESSION['ListTrabajadores']);
	}
	//Testing
	//AddNewRandomWorkers(10);
	//SaveWorkersToSession();
	// AddNewWorker('Hilmer');
	// AddNewWorker('Rafael');
	//print_r($ListTrabajadores);
	// SaveWorkersToSession();
	 //print_r($_SESSION['ListTrabajadores']);	
?>