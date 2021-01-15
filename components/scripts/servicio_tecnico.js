/* PLUGINS SELECT2 EN EL SELECTOR DE DOCUMENTO EN EL FORMULARIO DE GUARDAR ORDEN DE TRABAJO SERVICIO TECNICO */
$('#tipoDocumento').select2({
	placeholder: 'Seleccione un documento',
	allowClear: true,
	minimumResultsForSearch: Infinity,
})

/* PLUGINS SELECT2 EN EL SELECTOR DE EDITAR DOCUMENTO EN EL MODAL DE EDITAR ORDEN DE TRABAJO SERVICIO TECNICO */
$('#editarTipoDocumento').select2({
	placeholder: 'Seleccione un documento',
	minimumResultsForSearch: Infinity,
})

/* FUNCION PARA EDITAR LOS PRECIOS EN EL FORMULARIO GUARDAR SERVICIO TECNICO EN BASE AL DOCUMENTO SELECCIONADO */
$('#tipoDocumento').change(function () {
	let id = $(this).val();
	// console.log(id)
	$.ajax({
		url: 'http://localhost/ci3/servicio_tecnico/getFacturas',
		type: 'post',
		data: {
			id: id
		},
		dataType: 'json',
		success: function (data) {
			// console.log('data ' + data)
			$('#infoOculta').val(data)
			let opcion = $('#infoOculta').val();
			// console.log('opcion' + opcion)
			if (opcion != '') {
				
				let informacionComprobante = opcion.split('*');
				
				$('#idDocumento').val(informacionComprobante[0]);
				$('#impuestoDocumento').val(informacionComprobante[2]);
				$('#serieDocumento').val(informacionComprobante[3]);
				$('#numeroDocumento').val(generarNumero(informacionComprobante[1]));
				sumar()
			} else {
				$('#idDocumento').val(null);
				$('#impuestoDocumento').val(null);
				$('#serieDocumento').val(null);
				$('#numeroDocumento').val(null);
				sumar()
			}
		}
	})
});

/* INICIALIZAR EL EVENTO CON LA FUNCION DE SUMAR EN EL FORMULARIO GUARDAR SERVICIO TECNICO AL CAMBIAR LOS DATOS EN EL INPUT DE PRECIO */
$(document).on('keyup', '#precio', function () {
	sumar()
})

/* INICIALIZAR EL EVENTO CON LA FUNCION DE SUMAR EN EL MODAL EDITAR SERVICIO TECNICO AL CAMBIAR LOS DATOS EN EL INPUT DE PRECIO */
$(document).on('keyup', '#editarPrecio', function () {
	editarSumar()
})

/* FUNCION PARA GENERAR EL NUMERO DE LA FACTURA O RECIBO */
function generarNumero(numero) {
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

/* TAMAÑO AUTOMATICO TEXTAREA */
autosize($('.elastic'));

/* FUNCION PARA SUMAR LOS INPUTS DEL FORMULARIO PARA GUARDAR LA ORDEN DE TRABAJO SERVICIO TECNICO */
function sumar() {
	// let precio = document.getElementById('precio').value
	// precio = parseFloat(precio);
	// let subtotal = document.getElementById('subtotal').value
	// subtotal = parseFloat(subtotal)
	let subtotal = (Number($('#precio').val()))
	$('input[name=subtotal]').val(subtotal.toFixed(2));
	
	let porcentaje = $('#impuestoDocumento').val();
	
	let iva = Number((subtotal * (porcentaje / 100)).toFixed(3));
	$('input[name=iva]').val(iva.toFixed(2))
	
	let total = (Number(subtotal + iva))
	$('input[name=total]').val(total.toFixed(2))
}

/* FUNCION PARA SUMAR LOS INPUTS DEL MODAL PARA EDITAR LA ORDEN DE TRABAJO SERVICIO TECNICO */
function editarSumar() {
	
	let subtotal = (Number($('#editarPrecio').val()))
	$('input[name=editarSubtotal]').val(subtotal.toFixed(2));
	
	let porcentaje = $('#editarImpuestoDocumento').val();
	
	let iva = Number((subtotal * (porcentaje / 100)).toFixed(3));
	$('input[name=editarIva]').val(iva.toFixed(2))
	
	let total = (Number(subtotal + iva))
	$('input[name=editarTotal]').val(total.toFixed(2))
}

/* AGREGAR ORDEN DE TRABAJO SERVICIO TECNICO */
$(document).on('click', '#crearOrdenTrabajoServicioTecnico', function (event) {
	
	event.preventDefault();
	
	let documento = $('#idDocumento').val()
	let serieDocumento = $("#serieDocumento").val();
	let numeroDocumento = $("#numeroDocumento").val();
	let cliente = $("#cliente").val();
	let marca = $("#marca").val();
	let modelo = $("#modelo").val();
	let descripcion = $("#descripcion").val();
	let precio = $("#precio").val();
	let impuestoDocumento = $("#iva").val();
	let subtotal = $("#subtotal").val();
	let total = $("#total").val();
	
	// alert(total)
	$.ajax({
		url: "http://localhost/ci3/servicio_tecnico/crear",
		type: "post",
		dataType: "json",
		data: {
			/* POST | VARIABLE CON LA INFORMACION */
			ID_Documento: documento,
			Serie_OTServicioTecnico: serieDocumento,
			NumeroDocumento_OTServicioTecnico: numeroDocumento,
			ID_Cliente: cliente,
			Marca_OTServicioTecnico: marca,
			Modelo_OTServicioTecnico: modelo,
			Descripcion_OTServicioTecnico: descripcion,
			Precio_DetalleOTServicioTecnico: precio,
			Impuesto_OTServicioTecnico: impuestoDocumento,
			Subtotal_OTServicioTecnico: subtotal,
			Total_DetalleOTServicioTecnico: total,
			Total_OTServicioTecnico: total,
			
		},
		success: function (data) {
			// console.log(data)
			if (data.respuesta == 'success') {
				$('#tablaServicioTecnico').DataTable().ajax.reload()
				// location.reload();
				/* ESTETICA AL MOSTRAR EL MENSAJE DE EXITO */
				new Noty({
					layout: 'topRight',
					theme: 'limitless',
					type: 'success',
					text: data.mensaje,
					timeout: 3000,
				}).show();
			} else {
				
				/* ESTETICA AL MOSTRAR EL MENSAJE DE ERROR */
				new Noty({
					layout: 'topRight',
					theme: 'limitless',
					type: 'error',
					text: data.mensaje,
					timeout: 5000,
				}).show();
				
			}
		}
	})
	$('#formularioServicioTecnico')[0].reset()
	$('#tipoDocumento').val(null).trigger('change');
	$('#cliente').val(null).trigger('change');
});

/* MOSTRAR ORDENES DE TRABAJO SERVICIO TECNICO EN EL DATATABLE */
$(document).ready(function () {
	$('#tablaServicioTecnico').DataTable({
		
		'ajax': "http://localhost/ci3/servicio_tecnico/mostrar",
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
		drawCallback: (settings) => {
			// Aplicar select2 con las opciones deseadas
			$('.estadoDocumento').select2();
		}
	})
	$('.dataTables_length select').select2({
		minimumResultsForSearch: Infinity,
		dropdownAutoWidth: true,
		width: 'auto'
	});
})

/* ELIMINAR ORDEN DE TRABAJO SERVICIO TECNICO */
$(document).on('click', '#eliminarOtServicioTecnico', function (event) {
	
	event.preventDefault()
	// alert('click')
	
	let eliminarIdOtServicioTecnico = $(this).attr('value')
	// alert(eliminarIdOtServicioTecnico);
	
	const swalInit = swal.mixin({
		buttonsStyling: false,
		confirmButtonClass: 'btn btn-success',
		cancelButtonClass: 'btn btn-danger'
	});
	swalInit.fire({
		title: '¿Está seguro de eliminar la orden de trabajo?',
		text: "¡Si no lo está puede cancelar esta acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: '¡Sí, eliminar!',
		cancelButtonText: '¡No, cancelar!',
		confirmButtonClass: 'btn btn-success',
		cancelButtonClass: 'btn btn-danger',
		buttonsStyling: false
	}).then(function (result) {
		if (result.value) {
			
			$.ajax({
				url: "http://localhost/ci3/servicio_tecnico/eliminar",
				type: "post",
				dataType: "json",
				data: {
					eliminarIdOtServicioTecnico: eliminarIdOtServicioTecnico
				},
				
				success: function (data) {
					
					// console.log(data)
					if (data.respuesta == 'success') {
						$('#tablaServicioTecnico').DataTable().ajax.reload()
						swalInit.fire(
							'Eliminado!',
							'La orden de trabajo ha sido eliminado',
							'success'
						);
						
					}
				}
			});
		} else {
			swalInit.fire(
				'Cancelado',
				'La eliminación de la orden de trabajo ha sido cancelada',
				'error'
			);
		}
	});
})

/* VER ORDEN DE TRABAJO SERVICIO TECNICO (INVOICE) */
$(document).on('click', '#verOtServicioTecnico', function (event) {
	$('#modalVerOtServicioTecnico').modal('show')
	event.preventDefault()
	let verIdOtServicioTecnico = $(this).attr('value');
	$.ajax({
		url: 'http://localhost/ci3/servicio_tecnico/invoice',
		type: 'post',
		dataType: 'html',
		data: {
			id: verIdOtServicioTecnico,
		},
		success: function (data) {
			// console.log(data)
			$('#modalVerOtServicioTecnico').modal('show')
			$('#modalVerOtServicioTecnico .modal-body').html(data)
		}
	})
	
})

/* EDITAR ORDEN DE TRABAJO SERVICIO TECNICO */
$(document).on('click', '#editarOtServicioTecnico', function (event) {
	
	event.preventDefault()
	
	let editarIdOtServicioTecnico = $(this).attr('value');
	/* OBTENER EL ID DEL BOTON AL DAR CLICK */
	// alert(editarIdOtServicioTecnico)
	
	$.ajax({
		
		url: 'http://localhost/ci3/servicio_tecnico/editar',
		type: 'post',
		dataType: 'json',
		data: {
			
			editarIdOtServicioTecnico: editarIdOtServicioTecnico,
			
		},
		success: function (data) {
			$('#editarEstadoDocumento').select2({
				minimumResultsForSearch: Infinity,
			})
			// console.log(data)
			$('#editarImpuestoDocumento').val(data.post.Impuesto_Documento)
			$('#editarIdOtServicioTecnico').val(data.post.ID_OTServicioTecnico);
			$('#editarIdDocumento').val(data.post.ID_Documento);
			$('#editarTipoDocumento').val(data.post.ID_Documento).trigger('change');
			$('#editarSerieDocumento').val(data.post.Serie_OTServicioTecnico);
			$('#editarNumeroDocumento').val(data.post.NumeroDocumento_OTServicioTecnico);
			$('#editarCliente').val(data.post.ID_Cliente).trigger('change');
			$('#editarEstadoDocumento').val(data.post.Estado_OTServicioTecnico).trigger('change');
			$('#editarMarca').val(data.post.Marca_OTServicioTecnico);
			$('#editarModelo').val(data.post.Modelo_OTServicioTecnico);
			$('#editarDescripcion').val(data.post.Descripcion_OTServicioTecnico);
			$('#editarPrecio').val(data.post.Subtotal_OTServicioTecnico);
			$('#editarIva').val(data.post.Impuesto_OTServicioTecnico);
			$('#editarSubtotal').val(data.post.Subtotal_OTServicioTecnico);
			$('#editarTotal').val(data.post.Total_OTServicioTecnico);
			$('#modalEditarOtServicioTecnico').modal('show');
			
		}
		
	})
})

/* ACTUALIZAR ORDEN DE TRABAJO SERVICIO TECNICO */
$(document).on('click', '#actualizarOtServicioTecnico', function (event) {
	
	event.preventDefault();
	
	let editarIdOtServicioTecnico = $('#editarIdOtServicioTecnico').val()
	// alert(editarIdOtServicioTecnico)
	let editarCliente = $('#editarCliente').val()
	// alert(editarCliente)
	let editarEstadoDocumento = $('#editarEstadoDocumento').val()
	// alert(editarEstadoDocumento)
	let editarMarca = $('#editarMarca').val();
	// alert(editarMarca)
	let editarModelo = $('#editarModelo').val();
	// alert(editarModelo)
	let editarDescripcion = $('#editarDescripcion').val();
	// alert(editarDescripcion)
	let editarIva = $('#editarIva').val();
	// alert(editarIva)
	let editarSubtotal = $('#editarSubtotal').val()
	// alert(editarSubtotal)
	let editarTotal = $('#editarTotal').val();
	// alert(editarTotal)
	
	if (editarIdOtServicioTecnico == '' ||
		editarCliente == '' ||
		editarMarca == '' ||
		editarModelo == '' ||
		editarDescripcion == '' ||
		editarIva == '' ||
		editarSubtotal == '' ||
		editarTotal == '') {
		
		new Noty({
			layout: 'topRight',
			theme: 'limitless',
			type: 'error',
			text: 'Los campos no deben estar vacios',
			timeout: 3000,
		}).show();
		
	} else {
		$.ajax({
			url: 'http://localhost/ci3/servicio_tecnico/actualizar',
			type: 'post',
			dataType: 'json',
			data: {
				
				id: editarIdOtServicioTecnico,
				cliente: editarCliente,
				estadoDocumento: editarEstadoDocumento,
				marca: editarMarca,
				modelo: editarModelo,
				descripcion: editarDescripcion,
				iva: editarIva,
				subtotal: editarSubtotal,
				total: editarTotal,
				
			},
			success: function (data) {
				
				// console.log(data)
				if (data.respuesta == 'success') {
					$('#tablaServicioTecnico').DataTable().ajax.reload()
					$('#modalEditarOtServicioTecnico').modal('hide');
					/* ESTETICA AL MOSTRAR EL MENSAJE DE EXITO */
					new Noty({
						layout: 'topRight',
						theme: 'limitless',
						type: 'success',
						text: data.mensaje,
						timeout: 3000,
					}).show();
					
				} else {
					
					/* ESTETICA AL MOSTRAR EL MENSAJE DE ERROR */
					new Noty({
						layout: 'topRight',
						theme: 'limitless',
						type: 'error',
						text: data.mensaje,
						timeout: 3000,
					}).show();
					
				}
				
			}
		})
	}
	
})

/* IMPRIMIR ORDEN DE TRABAJO SERVICIO TECNICO */
$(document).on('click', '#crearOrdenTrabajoServicioTecnico', function (event) {
	event.preventDefault
	
	$('#modalVerOtServicioTecnico .modal-body').print({
		title: null,
	});
})
