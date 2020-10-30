/* VER ORDENES DE TRABAJO SERVICIO TECNICO */
$('#fechaInicio').pickadate({
	selectYears: true,
	selectMonths: true,
	formatSubmit: 'yyyy/mm/dd',
	hiddenName: true,
	close: 'cerrar'
});
$('#fechaFin').pickadate({
	selectYears: true,
	selectMonths: true,
	formatSubmit: 'yyyy/mm/dd',
	hiddenName: true,
	close: 'cerrar'
});
console.log($('fechaInicio').val())
var table;
const buscarReporteServicioTecnico = function(){
	table.ajax.reload();
}
$(document).ready(function () {
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
		$('#tablaReportePloteo').DataTable().responsive.recalc();
		$('#tablaReporteServicioTecnico').DataTable().responsive.recalc();
	})
	table = $('#tablaReporteServicioTecnico').DataTable({
		ajax: {
			"url": 'http://localhost/ci3/reportes/mostrarServicioTecnico',
			"type": "GET",
			"data": {
				fechaInicio: function() { return $('input[name="fechaInicio"]').val() },
				fechaFin: function() { return $('input[name="fechaFin"]').val() }
			},
		},
		dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
		order: [],
		responsive: true,
		autoWidth: false,
		processing: true,
		language: {
			"sProcessing": "Procesando...",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			},
			// Select2 for length menu styling
			
			// Initialize
			
			search: '<span>Filtro:</span> _INPUT_',
			searchPlaceholder: 'Escriba para buscar...',
			lengthMenu: '<span>Mostrar:</span> _MENU_',
			paginate: {
				'first': 'First',
				'last': 'Last',
				'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
				'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
			}
		},
		buttons: {
			dom: {
				button: {
					className: 'btn btn-light'
				}
			},
			buttons: [
				{
					extend: 'copy',
					text: 'Copiar'
				},
				{
					extend: 'csv',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7]
					}
				},
				{
					extend: 'excel',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7]
					}
				},
				{
					extend: 'pdf',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7]
					}
				},
				{
					extend: 'print', text: 'Imprimir',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7]
					}
				}
			]
		}
	})
	$('.dataTables_length select').select2({
		minimumResultsForSearch: Infinity,
		dropdownAutoWidth: true,
		width: 'auto'
	});
});

let tablaPloteo;
const buscarReportePloteo = function(){
	tablaPloteo.ajax.reload();
}
/* VER ORDENES DE TRABAJO PLOTEO */
$(document).ready(function () {
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
		$('#tablaReportePloteo').DataTable().responsive.recalc();
		$('#tablaReporteServicioTecnico').DataTable().responsive.recalc();
	})
	tablaPloteo = $('#tablaReportePloteo').DataTable({
		ajax: {
			"url": 'http://localhost/ci3/reportes/mostrarPloteo',
			"type": "GET",
			"data": {
				fechaInicioPloteo: function() { return $('#fechaInicioPloteo').val() },
				fechaFinPloteo: function() { return $('#fechaFinPloteo').val() }
			},
		},
		dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
		order: [],
		responsive: true,
		autoWidth: false,
		processing: true,
		language: {
			"sProcessing": "Procesando...",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			},
			// Select2 for length menu styling
			
			// Initialize
			
			search: '<span>Filtro:</span> _INPUT_',
			searchPlaceholder: 'Escriba para buscar...',
			lengthMenu: '<span>Mostrar:</span> _MENU_',
			paginate: {
				'first': 'First',
				'last': 'Last',
				'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
				'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
			}
		},
		buttons: {
			dom: {
				button: {
					className: 'btn btn-light'
				}
			},
			buttons: [
				{
					extend: 'copy',
					text: 'Copiar'
				},
				{
					extend: 'csv',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6]
					}
				},
				{
					extend: 'excel',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6]
					}
				},
				{
					extend: 'pdf',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6]
					}
				},
				{
					extend: 'print', text: 'Imprimir',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6]
					}
				}
			]
		}
	})
	$('.dataTables_length select').select2({
		minimumResultsForSearch: Infinity,
		dropdownAutoWidth: true,
		width: 'auto'
	});
});

