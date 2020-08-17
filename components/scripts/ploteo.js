/* PLUGINS SELECT2 EN EL SELECTOR DE DOCUMENTO EN EL FORMULARIO DE GUARDAR ORDEN DE TRABAJO PLOTEO */
$('#tipoDocumentoPloteo').select2({
	placeholder: 'Seleccione un documento',
	allowClear: true,
	minimumResultsForSearch: Infinity,
})

/* FUNCION PARA EDITAR LOS PRECIOS EN EL FORMULARIO GUARDAR SERVICIO TECNICO EN BASE AL DOCUMENTO SELECCIONADO */
$('#tipoDocumentoPloteo').change(function () {
	
	/* PONER EN UNA VARIABLE EL CONTENIDO DEL SELECTOR */
	let idDocumentoPloteo = $(this).val();
	// alert(idDocumentoPloteo)
	$.ajax({
		url: 'http://localhost/ci3/ploteo/obtenerDocumentos',
		type: 'post',
		data: {
			id: idDocumentoPloteo
		},
		dataType: 'json',
		success: function (data) {
			// console.log(data)
			
		}
	})
})