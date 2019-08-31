<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php' ?>
	<title>Reporte de sueldo por empleado</title>
</head>
<body>
    <?php include 'menu.php' ?>    
    <div class="divMainExtern">
        <div class="container">
			<div class="card-deck cardMain">
				<div class="card box-shadow">
					<div class="card-header">
						<h4 class="my-0 font-weight-normal">Reporte de sueldo por empleado</h4>
					</div>
					<div class="card-body">						
						<div id="gridRep1" style="min-height: 460px; width: 100%;"></div>
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
		var gridRep1 = null;
		var arrayGrids = [];
		var foo = function () {
		};
		$.urlParam = function (name) {
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			if (results == null) {
				return null;
			}
			return decodeURI(results[1]) || 0;
		}		
		function refreshGrid(auto) {
			w2ui.grid.autoLoad = auto;
			w2ui.grid.skip(0);
		}
		async function crearGrid() {
			listTrabajadores = await getSessionVarAjaxPromise('ListTrabajadores');
			let contador = 0;
			let records = [];
			for(let i =0; i<listTrabajadores.length;i++){
				// for(let j =0; j<listTrabajadores[i].ListTrabajos.length;j++){

				// }
				listTrabajadores[i].Sueldo = listTrabajadores[i].ListTrabajos.length * <?php echo $_SESSION['Remuneracion'];?>;
				records.push({ recid: 1, empleado: listTrabajadores[i].Nombre, sueldo: listTrabajadores[i].Sueldo})
			}
			gridRep1 = $('#gridRep1').w2grid({
				name: 'grid',
				header: 'Reporte 1',
				show: {
					toolbar: true,
					footer: true
				},
				searches: [					
				],
				sortData: [{ field: 'recid', direction: 'ASC' }],
				columns: [
						{ field: 'recid', caption: 'recid', size: '50px', sortable: true, attr: 'align=center', hidden: true },
						{ field: 'empleado', caption: 'Empleado', sortable: true, hidden: false, size: '380px' },
						{ field: 'sueldo', caption: 'Sueldo', sortable: true, hidden: false, size: '80px' }
						// {
							// field: '', caption: '', sortable: true, render: function (record) {
								// return '<div class="w2ui-buttons"><a href="javascript:verDetalle(' + record.id + ')">Ver detalle</a>';
							// }
						// }
					],
					records: records
			});
			arrayGrids['gridRep1'] = gridRep1;
			gridRep1.refresh();
		}		
		$(document).ready(function () {
			if (gridRep1 == null)
				crearGrid();
			return;
			$('#gridRep2').w2grid({
				name: 'grid',
				header: 'List of Names',
				show: {
					toolbar: true,
					footer: true
				},
				searches: [
					{ field: 'lname', caption: 'Last Name', type: 'text' },
					{ field: 'fname', caption: 'First Name', type: 'text' },
					{ field: 'email', caption: 'Email', type: 'text' },
				],
				sortData: [{ field: 'recid', direction: 'ASC' }],
				columns: [
					{ field: 'recid', caption: 'ID', size: '50px', sortable: true, attr: 'align=center' },
					{ field: 'lname', caption: 'Last Name', size: '30%', sortable: true, resizable: true },
					{ field: 'fname', caption: 'First Name', size: '30%', sortable: true, resizable: true },
					{ field: 'email', caption: 'Email', size: '40%', sortable: true, resizable: true },
					{ field: 'sdate', caption: 'Start Date', size: '120px', sortable: true, resizable: true },
				],
				records: [
					{ recid: 1, fname: 'John', lname: 'doe', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 2, fname: 'Stuart', lname: 'Motzart', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 3, fname: 'Jin', lname: 'Franson', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 4, fname: 'Susan', lname: 'Ottie', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 5, fname: 'Kelly', lname: 'Silver', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 6, fname: 'Francis', lname: 'Gatos', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 7, fname: 'Mark', lname: 'Welldo', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 8, fname: 'Thomas', lname: 'Bahh', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 9, fname: 'Sergei', lname: 'Rachmaninov', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 20, fname: 'Jill', lname: 'Doe', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 21, fname: 'Frank', lname: 'Motzart', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 22, fname: 'Peter', lname: 'Franson', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 23, fname: 'Andrew', lname: 'Ottie', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 24, fname: 'Manny', lname: 'Silver', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 25, fname: 'Ben', lname: 'Gatos', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 26, fname: 'Doer', lname: 'Welldo', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 27, fname: 'Shashi', lname: 'bahh', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 28, fname: 'Av', lname: 'Rachmaninov', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 31, fname: 'John', lname: 'doe', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 32, fname: 'Stuart', lname: 'Motzart', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 33, fname: 'Jin', lname: 'Franson', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 34, fname: 'Susan', lname: 'Ottie', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 35, fname: 'Kelly', lname: 'Silver', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 36, fname: 'Francis', lname: 'Gatos', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 37, fname: 'Mark', lname: 'Welldo', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 38, fname: 'Thomas', lname: 'Bahh', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 39, fname: 'Sergei', lname: 'Rachmaninov', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 40, fname: 'Jill', lname: 'Doe', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 41, fname: 'Frank', lname: 'Motzart', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 42, fname: 'Peter', lname: 'Franson', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 43, fname: 'Andrew', lname: 'Ottie', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 44, fname: 'Manny', lname: 'Silver', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 45, fname: 'Ben', lname: 'Gatos', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 46, fname: 'Doer', lname: 'Welldo', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 47, fname: 'Shashi', lname: 'bahh', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 48, fname: 'Av', lname: 'Rachmaninov', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 51, fname: 'John', lname: 'doe', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 52, fname: 'Stuart', lname: 'Motzart', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 53, fname: 'Jin', lname: 'Franson', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 54, fname: 'Susan', lname: 'Ottie', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 55, fname: 'Kelly', lname: 'Silver', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 56, fname: 'Francis', lname: 'Gatos', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 57, fname: 'Mark', lname: 'Welldo', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 58, fname: 'Thomas', lname: 'Bahh', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 59, fname: 'Sergei', lname: 'Rachmaninov', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 60, fname: 'Jill', lname: 'Doe', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 61, fname: 'Frank', lname: 'Motzart', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 62, fname: 'Peter', lname: 'Franson', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 63, fname: 'Andrew', lname: 'Ottie', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 64, fname: 'Manny', lname: 'Silver', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 65, fname: 'Ben', lname: 'Gatos', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 66, fname: 'Doer', lname: 'Welldo', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 67, fname: 'Shashi', lname: 'bahh', email: 'jdoe@gmail.com', sdate: '4/3/2012' },
					{ recid: 68, fname: 'Av', lname: 'Rachmaninov', email: 'jdoe@gmail.com', sdate: '4/3/2012' }
				]
			});
		});
	</script>
</body>
</html>