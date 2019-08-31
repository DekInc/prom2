<?php
	session_start();
	class Salario {
		public $DiaStr = '';
		public $Salario = 0.0;
		public $Calificacion = 0;
		public function __construct($Dia_, $Salario_, $Calificacion_){
			$this->DiaStr = $Dia_;
			$this->Salario = $Salario_;
			$this->Calificacion = $Calificacion_;
		}
	}
	class Mes {
		public $x = 1;
		public $y = 0;
		public function __construct($Mes_, $Cantidad_){
			$this->x = $Mes_;
			$this->y = $Cantidad_;
		}
	}
	class Trabajos{		
		public $Dia = null;
		public $Calificacion = 0;
		public function __construct($Dia_, $Calificacion_){			
			$this->Dia = $Dia_;
			$this->Calificacion = $Calificacion_;
		}
	}
	$ListTrabajadores = [];
	$ListTrabajadoresXMes = [];
	$ListTrabajosXMes = [];
	class Trabajador{
		public $Nombre = '';
		public $Activo = true;
		public $Suspendido = false;
		public $Salario = 0.0;		
		public $ListTrabajos = null;
		public $ListSalarios = null;
		public function __construct($Nombre_){
			$this->Nombre = $Nombre_;
		}
		function CalcSalario(){
			global $ListTrabajos;			
			global $ListSalarios;
			$ListSalarios = [];
			for($i = 0; $i < count($ListTrabajos); $i++){
				$ListSalarios[] = new Salario($ListTrabajos[$i]->Dia.Dia, $_SESSION["Remuneracion"], $ListTrabajos[$i]->Calificacion);
			}
		}
	}	
	function AddNewWorker($Nombre_) {
		global $ListTrabajadores;
		$ListTrabajadores[] = new Trabajador($Nombre_);
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
	}
	function GetWorkersFromSession() {
		global $ListTrabajadores;
		$ListTrabajadores = json_decode($_SESSION['ListTrabajadores']);
	}
	function GetScore(){
		$Random = rand(1, 100);
		if ($Random > 0 && $Random < 3)
			return 1;
		if ($Random > 2 && $Random < 11)
			return rand(2, 3);
		if ($Random > 10 && $Random < 101)
			return rand(4, 5);
	}
	function AddTrabajadorXMes($Mes_, $NumTrab) {
		global $ListTrabajadoresXMes;
		$ListTrabajadoresXMes[] = new Mes($Mes_, $NumTrab);
	}
	function SaveTrabajadorXMes() {
		global $ListTrabajadoresXMes;
		$_SESSION['ListTrabajadoresXMes'] = json_encode($ListTrabajadoresXMes);		
	}
	function GetTrabajadorXMes() {
		global $ListTrabajadoresXMes;
		$ListTrabajadoresXMes = json_decode($_SESSION['ListTrabajadoresXMes']);
	}
	function ResetTrabajadorXMes() {
		$_SESSION['ListTrabajadoresXMes'] = [];
	}
	function AddTrabajosXMes($Mes_, $NumTrab) {
		global $ListTrabajosXMes;
		$ListTrabajosXMes[] = new Mes($Mes_, $NumTrab);
	}
	function SaveTrabajosXMes() {
		global $ListTrabajosXMes;
		$_SESSION['ListTrabajosXMes'] = json_encode($ListTrabajosXMes);		
	}
	function GetTrabajosXMes() {
		global $ListTrabajosXMes;
		$ListTrabajosXMes = json_decode($_SESSION['ListTrabajosXMes']);
	}
	function ResetTrabajosXMes() {
		$_SESSION['ListTrabajosXMes'] = [];
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