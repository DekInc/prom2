<?php
	error_reporting(0);
	session_start();
	if(isset($_GET["var"])){		
		if (isset($_SESSION[$_GET["var"]]))
			echo $_SESSION[$_GET["var"]];	
	}
?>