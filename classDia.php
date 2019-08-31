<?php
	session_start();
	$ListDias = [];
	class Dia {
		public $Dia = '29/08/2019';
		public $Vuelta = 1;
		public function __construct($Dia_, $Vuelta_){
			$Dia = $Dia_;
			$Vuelta = $Vuelta_;
		}
	}
	function AddNewDay($Dia){
		global $ListDias;
		$ListDias[] = $Dia;
	}
	function SaveDaysToSession() {
		global $ListDias;
		$_SESSION['ListDias'] = json_encode($ListDias);
	}
	function GetDaysFromSession() {
		global $ListDias;
		$ListDias = json_decode($_SESSION['ListDias']);
	}
	function ResetDaysFromSession() {
		$_SESSION['ListDias'] = 0;
	}
?>