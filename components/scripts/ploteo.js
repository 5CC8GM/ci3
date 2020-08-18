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
				$('#numeroDocumentoPloteo').val(generarNumeroDocumentoPloteo(informacionDocumento[1]))
				
			} else {
				$('#idDocumentoPloteo').val(null)
				$('#impuestoDocumentoPloteo').val(null)
				$('#serieDocumentoPloteo').val(null)
				$('#numeroDocumentoPloteo').val(null)
			}
			calculosMetrosPloteo()
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

/* PROCEDIMIENTO CUANDO SE HACE CLICK EN AGREGAR PLOTEO */
$('#agregarPloteo').on('click', function () {
	
	/* OBTENCION DEL VALOR DEL INPUT */
	let datos = $('#metrosPloteo').val()
	
	if (datos != '') {
		
		/* PROCESO PARA AUMENTAR LAS FILAS EN LA TABLA PARA AGREGAR METROS */
		html = `<tr>`;
		html += `<td><input type="text" name="metrosTotalPloteo[]" class="metrosTotalPloteo form-control" value="${datos}"></td>`;
		html += `<td><input type="text" class="form-control importeMetrosPloteo" name="importeMetrosPloteo[]" value="${(datos * 1.25).toFixed(2)}" readonly></td>`;
		html += `<td><a href="#" id="eliminarMetros" value="" class="btn btn-danger btn-icon" type="button"><i class="icon-trash"></i></a></td>`;
		html += `</tr>`;
		
		/* DIBUJAR LA TABLA EN LA TABLA RESPECTIVA EN EL HTML */
		$('.tablaAgregarPloteo').append(html);
		
		/* FUNCION PARA HACER LOS CALCULOS */
		calculosMetrosPloteo()
		$('#agregarPloteo').val(null);
	} else {
		
		/* NOTIFICACION EN CASO DE QUE EL INPUT ESTE VACIO Y SE TRATE DE AGREGAR UN VALOR */
		new Noty({
			layout: 'topRight',
			theme: 'limitless',
			type: 'error',
			text: 'Ingrese la cantidad de metros',
			timeout: 5000,
		}).show();
	}
	
	
	/* LIMPIEZA DEL INPUT DESPUES DE AGREGAR LOS METROS */
	$('input[name=metrosPloteo]').val('');
	
	/* ELIMINACION INDIVIDUAL DE LOS METROS CUANDO LA TABLA YA ESTA CREADA */
	$(document).on('click', '#eliminarMetros', function () {
		$(this).closest('tr').remove()
		calculosMetrosPloteo()
	})
	
	/* CALCULO INDIVIDUAL EN LOS INPUTS YA CREADOS EN LA TABLA */
	$(document).on('keyup', '.tablaAgregarPloteo input.metrosTotalPloteo', function () {
		
		/* OBTENER EL VALOR DEL INPUT */
		let metros = $(this).val();
		// alert(metros)
		
		/* CALCULOS */
		let importe = (metros * 1.25).toFixed(2)
		
		/* IMPRESION EN EL INPUT READONLY DE LA COLUMNA DE IMPORTES */
		$(this).closest('tr').find('td:eq(1)').children('input').val(importe)
		calculosMetrosPloteo()
	})
});

/* CALCULOS DE LOS INPUTS */
function calculosMetrosPloteo() {
	
	let subtotal = 0;
	
	/* OBTENER EL IMPORTE DE LA MINITABLA DONDE SE INGRESAN LOS NUEVOS METROS O SE EDITAN */
	$('.tablaAgregarPloteo tbody tr').each(function () {
		subtotal = subtotal + Number($(this).find('td:eq(1)').children('input').val())
		// alert(subtotal)
	})
	
	/* IMPRESION DE LOS CALCULOS EN LOS INPUTS */
	$('input[name=subtotalPloteo]').val(subtotal.toFixed(2))
	let porcentaje = $('#impuestoDocumentoPloteo').val()
	// alert(porcentaje)
	let iva = subtotal * (porcentaje / 100);
	// alert(iva)
	$('input[name=ivaPloteo]').val(iva.toFixed(2))
	let total = subtotal + iva
	// alert(total)
	$('#totalPloteo').val(total.toFixed(2))
	
}