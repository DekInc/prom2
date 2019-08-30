<nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
	<a class="navbar-brand">&nbsp;&nbsp;UDB2019</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="navbar-collapse collapse" id="navbar1">
		<ul class="navbar-nav mr-auto">			
			<a class="nav-link" href="main.php" role="button">
				Inicio
			</a>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Configuración
				</a>
				<div class="dropdown-menu mr-auto" aria-labelledby="navbarDropdown1">
					<a class="dropdown-item" href="config.php">Parámetros iniciales</a>
					<a class="dropdown-item" href="borrarSession.php">Borrar sesión</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBod" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Reportes
				</a>
				<div class="dropdown-menu mr-auto" aria-labelledby="navbarDropdownBod">
					<a class="dropdown-item" href="reportedespedidos.php">Despedidos, suspendidos y activos</a>
					<a class="dropdown-item" href="reportesueldos.php">Sueldo por empleado</a>
				</div>
			</li>			
		</ul>
	</div>
</nav>
<?php include 'popup.php' ?>