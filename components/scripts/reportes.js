/* VER ORDENES DE TRABAJO SERVICIO TECNICO */
$(document).ready(function () {
	$('#tablaReporteServicioTecnico').DataTable({
		ajax: 'http://localhost/ci3/reportes/mostrarServicioTecnico',
		dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
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
	})
	$('.dataTables_length select').select2({
		minimumResultsForSearch: Infinity,
		dropdownAutoWidth: true,
		width: 'auto'
	});
});
