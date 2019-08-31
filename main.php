<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php' ?>
	<title>Principal</title>
</head>
<body>
    <?php include 'menu.php' ?>
    <div class="divMainExtern">		
		<div class="container">
			<div class="text-center">
				<div class="row">
					<div class="col-2">
						<button class="btn btn-success" type="button" id="btnIniciar">Iniciar simulación</button>
					</div>
					<div class="col-2">
						<button class="btn btn-success" type="button" id="btnParar">Parar simulación</button>
					</div>					
					<div class="col-1 normalText">
						Día:<br /><span id="spanDia" class="spanDia">0</span>
					</div>
					<div class="col-1 normalText">
						Vuelta:<br /><span id="spanVuelta" class="spanDia">0</span>
					</div>
					<div class="col-1 normalText">
						Trabajos:<br /><span id="spanTrabajos" class="spanDia">0</span>
					</div>
					<div class="col-1 normalText">
						Total días:<br /><span id="spanTotDias" class="spanDia">0</span>
					</div>
				</div>
			</div>
			<div class="card-deck cardMain">
				<div class="container">
					<div class="row">
						<div class="col-9">
							<div class="card box-shadow">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal">Trabajos vs Tiempo</h4>
								</div>
								<div class="card-body">			
									<canvas id="chartTrabajos"></canvas>
								</div>
							</div>
						</div>
						<div class="col-3">						
							<div class="card box-shadow tableMain1">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal">Media por calificación</h4>
								</div>
								<div class="card-body">
									<div id="gridRepMain2" style="min-height: 160px; min-width: 180px;"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-9">
							<div class="card box-shadow">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal">Trabajadores vs Tiempo</h4>
								</div>
								<div class="card-body">
									<canvas id="chartTrabajadores"></canvas>
								</div>
							</div>
						</div>
						<div class="col-3">							
							<div class="card box-shadow tableMain1">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal">Resultados por trabajador</h4>
								</div>
								<div class="card-body">
									<div id="gridRepMain1" style="min-height: 160px; min-width: 180px;"></div>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>		
        <div class="fixed-bottom footer2">
            <hr />
            <p>&copy; 2019 - UDB 2019</p>
        </div>        
    </div>    
	<script type="text/javascript">
		var res = 0;
		var capacidadMax = 0;
		var duracionTarea = 0;
		var maxTareasXDia = 0;
		var diaActual = null;
		var trabajos = 0;
		var diasPasados = 0;
		var numeroTrabajadores = 0;
		var continuar = true;
		var listTrabajadoresXMes = [];
		var listTrabajadoresXMesActivos = [];
		var listTrabajosXMes = [];
		async function drawTrabajadores() {
			if (!continuar) return;
			var ctx = document.getElementById('chartTrabajadores').getContext('2d');
			var months = [];			
			//var months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];			
			//listTrabajadoresXMes.length
			listTrabajadoresXMes = await getSessionVarAjaxPromise('ListTrabajadoresXMes');
			// for(var i = 0; i < listTrabajadoresXMes.length; i++) {
				// if (listTrabajadoresXMes[i].Activo)
					// listTrabajosXMes.push(listTrabajadoresXMes[i]);
			// }				
			// listTrabajadoresXMesActivos
			for(var i = 1; i < 37; i++)
				months.push(i);
			Chart.defaults.global.defaultFontColor = 'black';
			Chart.defaults.global.defaultFontFamily = 'Arial';
			//Chart.defaults.global.defaultFontSize = '26';
			Chart.defaults.global.defaultFontStyle = 'normal';
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: months,
					datasets: [{
						label: 'Trabajadores',
						backgroundColor: window.chartColors.red,
						borderColor: window.chartColors.red,
						data: listTrabajadoresXMes,
						fill: false,
					}]
				},
				options: {
					responsive: true,
					animation: {
						duration: 0
					},
					scales: {
						xAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: 'Meses'
							}
						}],
						yAxes: [{
							display: true,
							ticks: {
								beginAtZero: true
							},
							scaleLabel: {
								display: true,
								labelString: 'Trabajadores'
							}
						}]
					},
					legend: {
						labels: {							
							fontColor: 'black'
						}
					}
				}
			});
		}
		async function drawTrabajos() {
			if (!continuar) return;
			var ctx = document.getElementById('chartTrabajos').getContext('2d');
			var months = [];			
			//var months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];			
			//listTrabajosXMes.length
			listTrabajosXMes = await getSessionVarAjaxPromise('ListTrabajosXMes');
			for(var i = 1; i < 37; i++)
				months.push(i);
			Chart.defaults.global.defaultFontColor = 'black';
			Chart.defaults.global.defaultFontFamily = 'Arial';
			//Chart.defaults.global.defaultFontSize = '26';
			Chart.defaults.global.defaultFontStyle = 'normal';
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: months,
					datasets: [{
						label: 'Trabajos',
						backgroundColor: window.chartColors.blue,
						borderColor: window.chartColors.blue,
						data: listTrabajosXMes,
						fill: false,
					}]
				},
				options: {
					responsive: true,
					animation: {
						duration: 0
					},
					scales: {
						xAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: 'Meses'
							}
						}],
						yAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: 'Trabajos'
							}
						}]
					},
					legend: {
						labels: {							
							fontColor: 'black'
						}
					}
				}
			});
		}
		async function mainLoop(){			
			capacidadMax = await getSessionVarAjaxPromise('CapacidadMax');
			duracionTarea = await getSessionVarAjaxPromise('DuracionTarea');
			diasPasados = await getSessionVarAjaxPromise('DiasPasados');
			diaActual = await getFunctionAjaxPromise('GetActualDay');
			trabajos = await getFunctionAjaxPromise('GetNewTrabajos');
			numeroTrabajadores = await getSessionVarAjaxPromise('NumeroTrabajadores');			
			maxTareasXDia = capacidadMax / duracionTarea;
			$('#spanDia').html(diaActual.Dia);
			$('#spanVuelta').html(diaActual.Vuelta);
			$('#spanTrabajos').html(trabajos);
			$('#spanTotDias').html(diasPasados);
			
			if (numeroTrabajadores > trabajos){
				mensajeApp('Información', 'Ya no hay más trabajos, fin de la simulación.');
				continuar = false;
				return;
			}			
			if (diaActual.Vuelta < maxTareasXDia){
				res = await getFunctionAjaxPromise('AddVueltaActualDay', '&vuelta=' + (parseInt(diaActual.Vuelta) + 1));				
			} else {
				res = await getFunctionAjaxPromise('AddVueltaActualDay', '&vuelta=1');
				res = await getFunctionAjaxPromise('AddDayActualDay');				
			}
			////Control de velocidad
			velAnimacion = await getSessionVarAjaxPromise('VelAnimacion');
			if (continuar)
				setTimeout(mainLoop, velAnimacion);
		}		
		
		$(document).ready(function () {			
			if (gridRepMain1 == null)
				crearGridRepMain1();
			if (gridRepMain2 == null)
				crearGridRepMain2();
			$('#btnIniciar').on('click', function(Event){
				getSessionVarAjax('trabajos', function(data){ 
					if (data === ''){
						mensajeApp('Error', 'No se han establecido los parámetros iniciales de trabajos');
						return;
					} else {
						mensajeApp('Información', 'La configuración inicial es válida, se procede a la simulación');
						continuar = true;
						//getFunctionAjaxPromise('Reset');
						setInterval(drawTrabajadores, 233);
						setInterval(drawTrabajos, 233);
						mainLoop();
					}
				});
			});
			$('#btnParar').on('click', function(Event){
				continuar = false;
			});					
		});
	</script>
</body>
</html>