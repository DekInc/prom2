<?php
session_start();
echo  $_SESSION["trabajos"] . "<br>";
echo $p1 = rand(1,$_SESSION["trabajos"]);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Grafico</title>
    <script type="text/javascript" src="clases.js"></script>
    <script type="text/javascript">

    let operador = new operarios('uno');
    console.log(operador);
    let operadores = [];
    var trabajos = "<?php echo $_SESSION["trabajos"] ?>";
    var CapacidadMax = "<?php echo $_SESSION["CapacidadMax"] ?>";
    var DuracionTarea = "<?php echo $_SESSION["DuracionTarea"] ?>";
    var Remuneracion = "<?php echo $_SESSION["Remuneracion"] ?>";
    var VelAnimacion = "<?php echo $_SESSION["VelAnimacion"] ?>";
    var Trabajoefectivo = "<?php echo $_SESSION["Trabajoefectivo"] ?>";
    var meses = [];
    var tmptrabajospendientes = trabajos;
    var trabajadores;
    var tmptrabajosdiario = Math.ceil((trabajos/3)/(12*30));
    var tmptrabajosmensual = Math.ceil((trabajos/3)/(12));
    var trabajosdiarios = CapacidadMax/DuracionTarea;
    var mes1 = tmptrabajosmensual - (Math.floor(tmptrabajosmensual*0.1)*6);
    var tmpempleados = mes1 / trabajosdiarios;
    meses.push({"trabajosmes": mes1, "trabajadoresmes":tmpempleados});
    for(let i =0;i<tmpempleados;i++){
      operadores.push(crearOperadores(strval(i)));
    }
    for(let i =0;i<trabajos;i++){
      for(let j = 0; j<36;j++){
        let indice = 0;
        do{
          if(operadores[indice].estado.estadoEmp===1){
          if(operadores[indice].sansiones>0){
            operadores[indice].sansiones--;
          } else{
            operadores[indice].SetCal();
            mes1--;
            }

          if(indice===tmpempleados-1){
            indice = 0;
          } else{
            indice++;
          }
        }
        } while (mes1>0);
        if(j===12){
          mes1 = tmptrabajosmensual - (Math.floor(tmptrabajosmensual*0.1)*6);
        } else {
          mes1 = mes1 + Math.ceil((Math.floor(tmptrabajosmensual*0.1)*(j+1)));
        }
        meses.push({"trabajosmes": mes1, "trabajadoresmes":tmpempleados});
        // falta calcular el nuevo numero de empleados
        // hacer el push a la row del grafico
        // pintar el grafico dependiendo de un timer
       
      }
      
    }
    console.log(tmpempleados);
    </script>
</head>
<body>
    <h1>Grafico</h1>
    <a href="index.php">Configurar</a>
</body>
</html>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBackgroundColor);
function drawBackgroundColor() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Demanda');
      var p1 = <?php echo $p1; ?>;
      data.addRows([
        [0, 0],   [1, p1],  [2, 2],  [3, 3],  [4, 8],  [5, 13],
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
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    function crearOperadores(nombre){
      return new operador(nombre);
    }
    </script>
  </head>
  <body>
    
    <div id="chart_div"></div>
  </body>
</html>