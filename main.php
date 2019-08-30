<?php
	session_start();
	if (isset($_SESSION["trabajos"]))
		$tottrabajo = $_SESSION["trabajos"];
	else
		$tottrabajo = 100;
	// echo $_SESSION["VelAnimacion"];
	 
	//AÑO 1 ############################################
	(int)$c1 = (($tottrabajo/12)*(1));
	(int)$c2 = (($tottrabajo/12)*(2));
	(int)$c3 = (($tottrabajo/12)*(3));
	(int)$c4 = (($tottrabajo/12)*(4));
	(int)$c5 = (($tottrabajo/12)*(5));
	(int)$c6 = (($tottrabajo/12)*(6));
	(int)$c7 = (($tottrabajo/12)*(7));
	(int)$c8 = (($tottrabajo/12)*(8));
	(int)$c9 = (($tottrabajo/12)*(9));
	(int)$c10 = (($tottrabajo/12)*(10));
	(int)$c11 = (($tottrabajo/12)*(11));

	//AÑO 2 ############################################
	(int)$bajo1 = $tottrabajo * (0.30);
	(int)$bajo = $tottrabajo * (0.55);
	(int)$p1 = $bajo1;
	(int)$p2 = rand($bajo,$tottrabajo*(0.75));
	(int)$p3 = rand($bajo,$tottrabajo*(0.75));
	(int)$p4 = rand($bajo,$tottrabajo*(0.75));
	(int)$p5 = rand($bajo,$tottrabajo*(0.75));
	(int)$p6 = rand($bajo,$tottrabajo*(0.75));
	(int)$p7 = rand($bajo,$tottrabajo*(0.75));
	(int)$p8 = rand($bajo,$tottrabajo*(0.75));
	(int)$p8 = rand($bajo,$tottrabajo*(0.75));
	(int)$p9 = rand($bajo,$tottrabajo*(0.75));
	(int)$p10 = rand($bajo,$tottrabajo*(0.75));
	(int)$p11 = rand($bajo,$tottrabajo*(0.75));

	//AÑO 3 ############################################
	(int)$t2 = rand($bajo,$tottrabajo*(0.75));
	(int)$t3 = rand($bajo,$tottrabajo*(0.75));
	(int)$t4 = rand($bajo,$tottrabajo*(0.75));
	(int)$t5 = rand($bajo,$tottrabajo*(0.75));
	(int)$t6 = rand($bajo,$tottrabajo*(0.75));
	(int)$t7 = rand($bajo,$tottrabajo*(0.75));
	(int)$t8 = rand($bajo,$tottrabajo*(0.75));
	(int)$t8 = rand($bajo,$tottrabajo*(0.75));
	(int)$t9 = rand($bajo,$tottrabajo*(0.75));
	(int)$t10 = rand($bajo,$tottrabajo*(0.75));
	(int)$t11 = rand($bajo,$tottrabajo*(0.75));

	
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
						<button class="btn btn-success" type="button" id="btnTest1">Mostrar trabajadores</button>
					</div>
					<div class="col-1 normalText">
						Día:<br /><span id="spanDia" class="spanDia">0</span>
					</div>
					<div class="col-1 normalText">
						Vuelta:<br /><span id="spanVuelta" class="spanDia">0</span>
					</div>
				</div>
			</div>
			<div class="card-deck cardMain">
				<div class="container">
					<div class="row">
						<div class="col-9">
							<div class="card box-shadow">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal">N Trabajos vs Tiempo</h4>
								</div>
								<div class="card-body">
									<div id="chart1" class="chartMain1"></div>
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
					<div class="row">
						<div class="col-9">
							<div class="card box-shadow">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal">Trabajadores vs Tiempo</h4>
								</div>
								<div class="card-body">						
									<div id="chart2"></div>
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
				</div>
			</div>
		</div>		
        <div class="fixed-bottom footer2">
            <hr />
            <p>&copy; 2019 - 2019</p>
        </div>        
    </div>    
	<script type="text/javascript">
		var res = 0;
		var capacidadMax = 0;
		var duracionTarea = 0;
		var maxTareasXDia = 0;
		var diaActual = null;
		var trabajos = 0;
		var numeroTrabajadores = 0;
		//FUNCION GRAFICO TRABAJOS X TIEMPO ######################################################################
		function draw1() {
			var data = new google.visualization.DataTable();
			data.addColumn('number', 'X');
			data.addColumn('number', 'Demanda');

			var p0 = <?php echo $tottrabajo; ?>;
			//AÑO 1
			c1 = <?php echo $c1; ?>;
			c2 = <?php echo $c2; ?>;
			c3 = <?php echo $c3; ?>;
			c4 = <?php echo $c4; ?>;
			c5 = <?php echo $c5; ?>;
			c6 = <?php echo $c6; ?>;
			c7 = <?php echo $c7; ?>;
			c8 = <?php echo $c8; ?>;
			c9 = <?php echo $c9; ?>;
			c10 = <?php echo $c10; ?>;
			c11 = <?php echo $c11; ?>;

			//AÑO 2
			p1 = <?php echo $p1; ?>;
			p2 = <?php echo $p2; ?>;
			p3 = <?php echo $p3; ?>;
			p4 = <?php echo $p4; ?>;
			p5 = <?php echo $p5; ?>;
			p6 = <?php echo $p6; ?>;
			p7 = <?php echo $p7; ?>;
			p8 = <?php echo $p8; ?>;
			p9 = <?php echo $p9; ?>;
			p10 = <?php echo $p10; ?>;
			p11 = <?php echo $p11; ?>;

			//AÑO 3
			t2 = <?php echo $t2; ?>;
			t3 = <?php echo $t3; ?>;
			t4 = <?php echo $t4; ?>;
			t5 = <?php echo $t5; ?>;
			t6 = <?php echo $t6; ?>;
			t7 = <?php echo $t7; ?>;
			t8 = <?php echo $t8; ?>;
			t9 = <?php echo $t9; ?>;
			t10 = <?php echo $t10; ?>;
			t11 = <?php echo $t11; ?>;


			data.addRows([
			[0, 0],   [1, c1],  [2, c2],  [3, c3],  [4, c4],  [5, c5],
			[6, c6],  [7, c7],  [8, c8],  [9, c9],  [10, c10], [11, c11],
			[12, p0], [13, p1], [14, p2], [15, p3], [16, p4], [17, p5],
			[18, p6], [19, p7], [20, p8], [21, p9], [22, p10], [23, p11],
			[24, p0], [25, p1], [26, t2], [27, t3], [28, t4], [29, t5],
			[30, t6], [31, t7], [32, t8], [33, t9], [34, t10], [35, t11],
			[36, p0]
			]);
			var options = {
				hAxis: {
				  title: 'Meses'
				},
				vAxis: {
				  title: 'N° Trabajadores'
				},
				backgroundColor: '#f1f8e9'
			};
			var chart = new google.visualization.LineChart(document.getElementById('chart1'));
			chart.draw(data, options);
		}
		function draw2() {
			var data = new google.visualization.DataTable();
			data.addColumn('number', 'X');
			data.addColumn('number', 'Demanda');
			 
			data.addRows([
			[0, 0],   [1, 23],  [2, 2],  [3, 3],  [4, 8],  [5, 13],
			[6, 20],  [7, 40],  [8, 100],  [9, 20],  [10, 32], [11, 35],
			[12, 80], [13, 40], [14, 42], [15, 47], [16, 44], [17, 48],
			[18, 52], [19, 54], [20, 42], [21, 55], [22, 56], [23, 57],
			[24, 90], [25, 50], [26, 52], [27, 51], [28, 49], [29, 53],
			[30, 55], [31, 50], [32, 61], [33, 59], [34, 62], [35, 65],
			[36, 99]
			]);
			var options = {
				hAxis: {
				  title: 'Meses'
				},
				vAxis: {
				  title: 'N° Trabajos'
				},
				backgroundColor: '#f1f8e9'
			};
			var chart = new google.visualization.LineChart(document.getElementById('chart2'));
			chart.draw(data, options);
		}
		google.charts.load('current', {packages: ['corechart', 'line']});
		google.charts.setOnLoadCallback(draw1);
		google.charts.setOnLoadCallback(draw2);		
		async function mainLoop(){			
			capacidadMax = await getSessionVarAjaxPromise('CapacidadMax');
			duracionTarea = await getSessionVarAjaxPromise('DuracionTarea');
			diaActual = await getFunctionAjaxPromise('GetActualDay');
			trabajos = await getFunctionAjaxPromise('GetNewTrabajos');
			numeroTrabajadores = await getSessionVarAjaxPromise('NumeroTrabajadores');
			if (numeroTrabajadores > trabajos){
				mensajeApp('Información', 'Ya no hay más trabajos, fin de la simulación.');
				return;
			}
			maxTareasXDia = capacidadMax / duracionTarea;
			$('#spanDia').html(diaActual.Dia);
			$('#spanVuelta').html(diaActual.Vuelta);
			
			if (diaActual.Vuelta < maxTareasXDia){
				res = await getFunctionAjaxPromise('AddVueltaActualDay', '&vuelta=' + (parseInt(diaActual.Vuelta) + 1));				
			} else {
				res = await getFunctionAjaxPromise('AddVueltaActualDay', '&vuelta=1');
				res = await getFunctionAjaxPromise('AddDayActualDay');				
			}
			////Control de velocidad
			velAnimacion = await getSessionVarAjaxPromise('VelAnimacion');
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
						mensajeApp('Error', 'No se han establecido los parámetros iniciales');
						return;
					} else {
						mensajeApp('Información', 'La configuración inicial es válida, se procede a la simulación');
						mainLoop();
					}
				});
			});
			$('#btnTest1').on('click', function(Event){
				getSessionVarAjax('ListTrabajadores', function(data){ 
					if (data === ''){
						mensajeApp('Error', 'No se han establecido los parámetros iniciales');
						return;
					} else {
						console.log(data);
						var Json1 = JSON.parse(data);
						mensajeApp('Información', 'La configuración inicial es válida, se procede a la simulación. Data: ' + data + ' .... primer nombre: ' + Json1[0].Nombre);
						console.log(Json1);
					}
				});
			});			
		});
	</script>
</body>
</html>