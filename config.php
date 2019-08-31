<?php
session_start();
if(!isset($_SESSION["newsession"])){
	$_SESSION["trabajos"] = 300;
    $_SESSION["CapacidadMax"] = 8;
    $_SESSION["DuracionTarea"] = 2;
    $_SESSION["Remuneracion"] = 10;
    $_SESSION["VelAnimacion"] = 1;
    $_SESSION["CapacidadMax"] = 8;
    $_SESSION["DuracionTarea"] = 2;
    $_SESSION["Trabajoefectivo"] = 100;
    $_SESSION["NumeroTrabajadores"] = 1;
    $_SESSION["ListTrabajadores"] = '';
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php' ?>
    <title>Configuración</title>
</head>
<body>
    <?php include 'menu.php' ?>    
    <div class="divMainExtern">
		<div class="container configContainer">
			<div class="card-deck cardMain">
				<div class="card box-shadow">
					<div class="card-header">
						<h4 class="my-0 font-weight-normal">Configuracion Principal</h4>
					</div>
					<div class="card-body">						
						<form id="formConfig" action="configSave.php" method="POST">								
							<div class="row padding-bottom">
								<div class="col-lg-2 offset-lg-1 padding">
									N de Trabajos:
								</div>
								<div class="col-lg-2"> 
									<input type="text" name="numerotrabajos" value="<?php echo $_SESSION['trabajos'];?>"required>
								</div>
								<div class="col-lg-2 offset-lg-1">
										Capacidad Max:
								</div>
								<div class="col-lg-2"> 
									<input type="text" name="CapacidadMaxdiaria" value="<?php echo $_SESSION['CapacidadMax'];?>" required>
								</div>
							</div>
							<div class="row padding-bottom">
								<div class="col-lg-2 offset-lg-1">
									Duracion Tarea:
								</div>
								<div class="col-lg-2"> 
									<input type="text" name="duraciontarea"  value="<?php echo $_SESSION['DuracionTarea'];?>"required>
								</div>
								<div class="col-lg-2 offset-lg-1">
									Remuneracion Trabajos:
								</div>
								<div class="col-lg-2"> 
									<input type="text" name="remuneracion" value="<?php echo $_SESSION['Remuneracion'];?>" required>
								</div>
							</div>
							<div class="row padding-bottom">
								<!-- <div class="col-lg-2 offset-lg-1">
									Capacidad Max:
								</div>
								<div class="col-lg-2"> 
									<input type="text" name="numerotrabajos" placeholder="Capacidad maxima diaria" value="<?php echo $_SESSION[''];?>" required>
								</div> -->
								<div class="col-lg-2 offset-lg-1">
										Trabajo efectivo
								</div>
								<div class="col-lg-2"> 
									<input type="text" name="trabajoefectivo" placeholder="%" value="<?php echo $_SESSION['Trabajoefectivo'];?>" required>
								</div>
								<div class="col-lg-2 offset-lg-1">
									Trabajadores iniciales:
								</div>
								<div class="col-lg-2"> 
									<input type="text" name="txtNumeroTrabajadores" value="<?php echo $_SESSION['NumeroTrabajadores'];?>" required>
								</div>
							</div>
							<div class="row padding-bottom">
								<div class="col-lg-2 offset-lg-1">
									Velocidad Animacion:
								</div>
								<div class="col-lg-2"> 
									<input type="text" name="VelAnimacion" placeholder="Velocidad en miliSegundos" value="<?php echo $_SESSION['VelAnimacion'];?>" required>									
								</div>
								<!-- <div class="col-lg-2 offset-lg-1">
										A definir:
									</div>
									<div class="col-lg-2"> 
										<input type="text" name="CapacidadMaxdiaria" placeholder="%" value="<?php echo $_SESSION[''];?>" required>
									</div>-->
							</div> 
							<div class="row padding-bottom">
								<div class="col-lg-4 offset-lg-4 text-center">
									<button class="btn btn-primary" type="submit" id="submit" name="submit">
										Guardar
										<span class="caret"></span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>		
		<div class="fixed-bottom footer2">
			<hr />
			<p>&copy; 2019 - UDB 2019</p>
		</div>
    </div>
	<script>				
		$('#formConfig').on('submit', function (e) {
			e.preventDefault();
			$.ajax({
				type: $('#formConfig').attr('method'),
				url: $('#formConfig').attr('action'),
				data: $('#formConfig').serialize(),
				success: function (data) {
					mensajeApp('Información', 'La información se guardo.');					
				},
				error: function (data) {
					mensajeApp(data);
				},
			});
		});
	
	</script>	
</body>
</html> 