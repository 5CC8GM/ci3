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
			/* LLENAR EL INPUT HIDDEN CON LA INFORMACION OBTENIDA */
			$('#dataDocumentoPloteo').val(data)
			/* ALMACENAR EN UNA VARIABLE LOS VALORES DEL INPUT HIDDEN */
			let opcion = $('#dataDocumentoPloteo').val();
			// console.log('opcion ' + opcion)
			if (opcion != '') {
				
				let informacionDocumento = opcion.split('*');
				
				$('#idDocumentoPloteo').val(informacionDocumento[0])
				$('#impuestoDocumentoPloteo').val(informacionDocumento[2])
				$('#serieDocumentoPloteo').val(informacionDocumento[3])
				$('#numeroDocumentoPloteo').val(informacionDocumento[1])
				
			}
		}
	})
})

/* FUNCION PARA GENERAR EL NUMERO DE LA FACTURA O RECIBO */
function generarNumeroDocumentoPloteo(numero) {
	if (numero >= 99999 && numero < 99999) {
		return Number(numero) + 1
	}
	if (numero >= 9999 && numero < 99999) {
		
		return '0' + (Number(numero) + 1)
		
	}
	if (numero >= 999 && numero < 9999) {
		
		return '00' + (Number(numero) + 1)
		
	}
	if (numero >= 99 && numero < 999) {
		
		return '000' + (Number(numero) + 1)
		
	}
	if (numero >= 9 && numero < 99) {
		
		return '0000' + (Number(numero) + 1)
		
	}
	if (numero < 9) {
		
		return '00000' + (Number(numero) + 1)
		
	}
}