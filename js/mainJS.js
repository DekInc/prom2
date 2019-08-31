var modalPop1 = null;
var gridRepMain1 = null;
var gridRepMain2 = null;
var arrayGrids = [];
var foo = function () {
};
window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
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
function crearGridRepMain1() {
	gridRepMain1 = $('#gridRepMain1').w2grid({
		name: 'gridRepMain1',
		header: 'Resumen resultados por trabajador',
		show: {
			toolbar: false,
			footer: false
		},
		searches: [					
		],
		sortData: [{ field: 'recid', direction: 'ASC' }],
		columns: [
				{ field: 'recid', caption: 'recid', size: '50px', sortable: true, attr: 'align=center', hidden: true },
				{ field: 'tipo', caption: 'Tipo', sortable: true, hidden: false, size: '80px' },
				{ field: 'valor', caption: 'Cantidad', sortable: true, hidden: false, size: '80px' }
				// {
					// field: '', caption: '', sortable: true, render: function (record) {
						// return '<div class="w2ui-buttons"><a href="javascript:verDetalle(' + record.id + ')">Ver detalle</a>';
					// }
				// }
			],
		records: [
			{ recid: 1, tipo: 'Despedidos', valor: 1},
			{ recid: 2, tipo: 'Suspendidos', valor: 2},
			{ recid: 3, tipo: 'Activos', valor: 3}
		]
	});
	arrayGrids['gridRepMain1'] = gridRepMain1;
}
function crearGridRepMain2() {
	gridRepMain2 = $('#gridRepMain2').w2grid({
		name: 'gridRepMain2',
		header: 'Media por calificación',
		show: {
			toolbar: false,
			footer: false
		},
		searches: [					
		],
		sortData: [{ field: 'recid', direction: 'ASC' }],
		columns: [
				{ field: 'recid', caption: 'recid', size: '50px', sortable: true, attr: 'align=center', hidden: true },
				{ field: 'calificacion', caption: 'Calificación', sortable: true, hidden: false, size: '80px' },
				{ field: 'valor', caption: 'Dinero', sortable: true, hidden: false, size: '80px' }
				// {
					// field: '', caption: '', sortable: true, render: function (record) {
						// return '<div class="w2ui-buttons"><a href="javascript:verDetalle(' + record.id + ')">Ver detalle</a>';
					// }
				// }
			],
		records: [
			{ recid: 1, calificacion: 'Despedidos', valor: 10},
			{ recid: 2, calificacion: 'Suspendidos', valor: 22},
			{ recid: 3, calificacion: 'Activos', valor: 33}
		]
	});
	arrayGrids['gridRepMain2'] = gridRepMain2;
}
function mensajeApp(Titulo, MensajeO) {
    if (Titulo === undefined)
        Titulo = 'Mensaje del aplicativo';
    $('#divMensajePop1').html(MensajeO);
    $('#modalLabel1').html(Titulo);
    modalPop1 = $('#modalPop1').modal();    
    //$('#divMensajePop1').on('hide.bs.modal', function (e) {
    //    setTimeout(() => afterModalTransition(this), 200);
    //})
}
function getSessionVarAjax(varName, successFunc) {
    $.ajax({
        method: "GET",
        url: 'getSessionVar.php?var=' + varName,
        success: function(data){
			if (data === ''){
				mensajeApp('Error', 'No se han establecido los parámetros iniciales');
				return;
			} else {
				var jsonData = JSON.parse(data);
				if (typeof successFunc === 'function')
					successFunc(jsonData);
			}			
		},
        error: function (xhr, ajaxOptions, thrownError) {
            mensajeApp('Error throw in getSessionVarAjax', xhr.status);
            mensajeApp('Error throw in getSessionVarAjax', thrownError);
        }
    });
}
function getSessionVarAjaxPromise(varName) {
	return new Promise(resolve => {
		$.ajax({
			method: "GET",
			url: 'getSessionVar.php?var=' + varName,
			success: function(data){
				if (data === ''){
					mensajeApp('Error', 'No se han establecido los parámetros iniciales');
					return;
				} else {
					var jsonData = JSON.parse(data);					
					resolve(jsonData);
				}			
			},
			error: function (xhr, ajaxOptions, thrownError) {
				mensajeApp('Error throw in getSessionVarAjax', xhr.status);
				mensajeApp('Error throw in getSessionVarAjax', thrownError);
			}
		});
	});
}
function getFunctionAjax(functionName, successFunc) {
    $.ajax({
        method: "GET",
        url: 'functions.php?function=' + functionName,
        success: function(data){
			if (data === ''){
				mensajeApp('Error', 'No se han establecido los parámetros iniciales');
				return;
			} else {
				var jsonData = JSON.parse(data);
				if (typeof successFunc === 'function')
					successFunc(jsonData);
			}			
		},
        error: function (xhr, ajaxOptions, thrownError) {
            mensajeApp('Error throw in getFunctionAjax', xhr.status);
            mensajeApp('Error throw in getFunctionAjax', thrownError);
        }
    });
}
function getFunctionAjaxPromise(functionName, params = '') {
	return new Promise(resolve => {
		$.ajax({
			method: "GET",
			url: 'functions.php?function=' + functionName + params,
			success: function(data){
				if (data === ''){
					mensajeApp('Error', 'No se han establecido los parámetros iniciales');
					return;
				} else {
					var jsonData = JSON.parse(data);
					resolve(jsonData);
				}			
			},
			error: function (xhr, ajaxOptions, thrownError) {
				mensajeApp('Error throw in getFunctionAjax', xhr.status);
				mensajeApp('Error throw in getFunctionAjax', thrownError);
			}
		});
	});
}
function makeAjaxPost(serverUrl, successFunc) {
    $.ajax({
        method: "POST",
        url: serverUrl,
        success: successFunc,
        error: function (xhr, ajaxOptions, thrownError) {
            menErrorEdi(xhr.status, 'Error throw in js');
            menErrorEdi(thrownError, 'Error throw in js');
        }
    });
}