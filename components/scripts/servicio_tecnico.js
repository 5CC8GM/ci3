/* SELECT CON BUSCADOR */
// $('#tipoDocumento').on('change', function () {
//
// 	let opcion = $(this).val();
//
// 	if (opcion != '') {
//
// 		let informacionComprobante = opcion.split('*');
//
// 		$('#idDocumento').val(informacionComprobante[0]);
// 		$('#impuestoDocumento').val(informacionComprobante[2]);
// 		$('#serieDocumento').val(informacionComprobante[3]);
// 		$('#numeroDocumento').val(generarNumero(informacionComprobante[1]));
// 		sumar()
// 	} else {
// 		$('#idDocumento').val(null);
// 		$('#impuestoDocumento').val(null);
// 		$('#serieDocumento').val(null);
// 		$('#numeroDocumento').val(null);
// 		sumar()
// 	}
//
// })

$('#tipoDocumento').select2({
	placeholder: 'Seleccione un documento',
	allowClear: true,
	minimumResultsForSearch: Infinity,
	// ajax: {
	// 	url: 'http://localhost/ci3/ordenes_trabajo/servicio_tecnico/getFacts',
	// 	dataType: 'json',
	// 	type: 'post',
	// 	processResults: function (data) {
	// 		return {
	// 			results: data
	// 		}
	// 	},
	//
	// 	cache: true
	//
	// },
})
$('#editarTipoDocumento').select2({
	placeholder: 'Seleccione un documento',
	allowClear: true,
	minimumResultsForSearch: Infinity,
	// ajax: {
	// 	url: 'http://localhost/ci3/ordenes_trabajo/servicio_tecnico/getFacts',
	// 	dataType: 'json',
	// 	type: 'post',
	// 	processResults: function (data) {
	// 		return {
	// 			results: data
	// 		}
	// 	},
	//
	// 	cache: true
	//
	// },
})
$('#tipoDocumento').change(function () {
	let id = $(this).val();
	// console.log(id)
	$.ajax({
		url: 'http://localhost/ci3/ordenes_trabajo/servicio_tecnico/getFacturas',
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

$(document).on('keyup', '#precio', function () {
	sumar()
})

$(document).on('keyup', '#editarPrecio', function () {
	sumar()
})

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

/* CALCULOS DE LOS INPUTS */
// $('.input').on('input', function () {
// 	let precio = document.getElementById('precio').value
// 	precio = parseFloat(precio);
//
// 	let impuesto = document.getElementById('impuesto').value
// 	impuesto = parseFloat(impuesto)
//
// 	let subtotal = document.getElementById('subtotal').value
// 	subtotal = parseFloat(subtotal)
//
// 	let total = document.getElementById('total').value
// 	total = parseFloat(total)
//
// 	if (Number.isNaN(precio)) {
// 		precio = 0
// 	} else if (Number.isNaN(impuesto)) {
// 		impuesto = 0
// 	}
//
// 	document.getElementById('subtotal').value = precio;
// 	document.getElementById('total').value = (precio * (impuesto / 100) + precio).toFixed(2);
//
// })

/* AGREGAR ORDEN DE TRABAJO SERVICIO TECNICO */
$(document).on('click', '#crearOrdenTrabajoServicioTecnico', function (event) {
	
	event.preventDefault();
	
	// let idCliente = $("#cliente").val();
	// let marca = $("#marca").val();
	// let modelo = $("#modelo").val();
	// let descripcion = $("#descripcion").val();
	// let precio = $("#precio").val();
	// let impuesto = $("#impuesto").val();
	// let subtotal = $("#subtotal").val();
	// let total = $("#total").val();
	
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
		url: "http://localhost/ci3/ordenes_trabajo/servicio_tecnico/crear",
		type: "post",
		dataType: "json",
		data: {
			/* NOMBRE DE LOS CAMPOS DE LA BASE DE DATOS | VARIABLE CON LA INFORMACION */
			// ID_Cliente: idCliente,
			// Marca_OTServicioTecnico: marca,
			// Modelo_OTServicioTecnico: modelo,
			// Descripcion_OTServicioTecnico: descripcion,
			// Precio_OTServicio_Tecnico: precio,
			// Impuesto_OTServicioTecnico: impuesto,
			// Subtotal_OTServicioTecnico: subtotal,
			// Total_OTServicioTecnico: total,
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
				$('#tablaServicioTecnico').DataTable().destroy();
				mostrarTablaServicioTecnico()
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

/* MOSTRAR ORDENES DE TRABAJO EN LA TABLA */
function mostrarTablaServicioTecnico() {
	
	$.ajax({
		url: "http://localhost/ci3/ordenes_trabajo/servicio_tecnico/mostrar",
		type: "post",
		dataType: "json",
		success: function (data) {
			if (data.respuesta == 'success') {
				let i = "1";
				// console.log(data)
				
				$('#tablaServicioTecnico').DataTable({
					autoWidth: false,
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
					
					dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
					'data': data.datos,
					'responsive': true,
					'columns': [
						{
							"render": function () {
								return accionesBotones = i++;
							}
						},
						{
							"render": function (data, type, row, meta) {
								return `${row.Nombre_Cliente} ${row.Apellido_Cliente}`
								
							}
						},
						{"data": 'Nombre_Documento'},
						{"data": "NumeroDocumento_OTServicioTecnico"},
						{"data": "Descripcion_OTServicioTecnico"},
						{"data": "Fecha_OTServicioTecnico"},
						{
							"render": function (data, type, row, meta) {
								return `<strong class="text-primary">$${row.Total_OTServicioTecnico}</strong>`
							}
						},
						{
							"render": function (data, type, row, meta) {
								
								let accionesBotones = `<div class="list-icons"><a href="#" id="verOtServicioTecnico" value="${row.ID_OTServicioTecnico}" class="btn btn-primary btn-icon" type="button"><i class="icon-info22"></i></a><a href="#" id="editarOtServicioTecnico" value="${row.ID_OTServicioTecnico}" class="btn btn-warning btn-icon" type="button"><i class="icon-pencil7"></i></a><a href="#" id="eliminarOtServicioTecnico" value="${row.ID_OTServicioTecnico}"  class="btn btn-danger btn-icon" type="button"><i class="icon-trash"></i></a></div>`
								
								return accionesBotones
								
							}
						},
					]
					
				});
				$('.dataTables_length select').select2({
					minimumResultsForSearch: Infinity,
					dropdownAutoWidth: true,
					width: 'auto'
				});
			} else {
				$('#tablaServicioTecnico').DataTable().destroy()
				/* ESTETICA AL MOSTRAR EL MENSAJE DE ERROR */
				$('#tablaServicioTecnico').DataTable({
					autoWidth: false,
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
					
					dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
					'data': [],
					'responsive': true,
				})
				$('.dataTables_length select').select2({
					minimumResultsForSearch: Infinity,
					dropdownAutoWidth: true,
					width: 'auto'
				});
			}
			
		}
	})
	
}

mostrarTablaServicioTecnico()

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
				url: "http://localhost/ci3/ordenes_trabajo/servicio_tecnico/eliminar",
				type: "post",
				dataType: "json",
				data: {
					eliminarIdOtServicioTecnico: eliminarIdOtServicioTecnico
				},
				
				success: function (data) {
					
					// console.log(data)
					if (data.respuesta == 'success') {
						
						$('#tablaServicioTecnico').DataTable().destroy()
						mostrarTablaServicioTecnico()
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

$(document).on('click', '#verOtServicioTecnico', function (event) {
	// $('#modalVerOtServicioTecnico').modal('show')
	event.preventDefault()
	let verIdOtServicioTecnico = $(this).attr('value');
	$.ajax({
		url: 'http://localhost/ci3/ordenes_trabajo/servicio_tecnico/verOtServicioTecnico',
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
// $(document).on('click', '#editarOtServicioTecnico', function (event) {
//
// 	event.preventDefault();
//
// 	let editarIdOtServicioTecnico = $(this).attr('value');
//
// 	// alert(editarIdOtServicioTecnico)
//
// 	$.ajax({
// 		url: 'http://localhost/ci3/ordenes_trabajo/servicio_tecnico/editar',
// 		type: 'post',
// 		dataType: 'json',
// 		data: {
// 			editarIdOtServicioTecnico: editarIdOtServicioTecnico
// 		},
// 		success: function (data) {
// 			/* VERIFICAR LO QUE SE OBTIENE EN LA RESPUESTA DEL CONTROLADOR */
// 			// console.log(data)
//
// 			if (data.respuesta == 'success') {
// 				$('#editarIdOtServicioTecnico').val(data.post.ID_OTServicioTecnico);
// 				$('#editarClienteOtServicioTecnico').val(data.post.ID_Cliente);
// 				$('#editarMarcaOtServicioTecnico').val(data.post.Marca_OTServicioTecnico);
// 				$('#editarModeloOtServicioTecnico').val(data.post.Modelo_OTServicioTecnico);
// 				$('#editarDescripcionOtServicioTecnico').val(data.post.Descripcion_OTServicioTecnico);
// 				$('#editarPrecioOtServicioTecnico').val(data.post.Precio_OTServicio_Tecnico);
// 				$('#editarImpuestoOtServicioTecnico').val(data.post.Impuesto_OTServicioTecnico);
// 				$('#editarSubtotalOtServicioTecnico').val(data.post.Subtotal_OTServicioTecnico);
// 				$('#editarTotalOtServicioTecnico').val(data.post.Total_OTServicioTecnico);
// 				$('#modalEditarOtServicioTecnico').modal('show');
// 				$('.editarInput').on('input', function () {
// 					let editarPrecio = document.getElementById('editarPrecioOtServicioTecnico').value
// 					editarPrecio = parseFloat(editarPrecio);
//
// 					let editarImpuesto = document.getElementById('editarImpuestoOtServicioTecnico').value
// 					editarImpuesto = parseFloat(editarImpuesto)
//
// 					let editarSubtotal = document.getElementById('editarSubtotalOtServicioTecnico').value
// 					editarSubtotal = parseFloat(editarSubtotal)
//
// 					let editarTotal = document.getElementById('editarTotalOtServicioTecnico').value
// 					editarTotal = parseFloat(editarTotal)
// 					if (Number.isNaN(editarPrecio)) {
// 						editarPrecio = 0
// 					} else if (Number.isNaN(editarImpuesto)) {
// 						editarImpuesto = 0
// 					}
//
// 					document.getElementById('editarSubtotalOtServicioTecnico').value = editarPrecio;
// 					document.getElementById('editarTotalOtServicioTecnico').value = (editarPrecio * (editarImpuesto / 100) + editarPrecio).toFixed(2);
// 				});
// 			} else {
// 				new Noty({
// 					layout: 'topRight',
// 					theme: 'limitless',
// 					type: 'error',
// 					text: data.mensaje,
// 					timeout: 3000,
// 				}).show();
// 			}
//
//
// 		}
// 	})
// });

/* EDITAR ORDEN DE TRABAJO SERVICIO TECNICO */
$(document).on('click', '#editarOtServicioTecnico', function (event) {
	
	event.preventDefault()
	
	let editarIdOtServicioTecnico = $(this).attr('value');
	/* OBTENER EL ID DEL BOTON AL DAR CLICK */
	// alert(editarIdOtServicioTecnico)
	
	$.ajax({
		
		url: 'http://localhost/ci3/ordenes_trabajo/servicio_tecnico/editar',
		type: 'post',
		dataType: 'json',
		data: {
			
			editarIdOtServicioTecnico: editarIdOtServicioTecnico,
			
		},
		success: function (data) {
			// console.log(data)
			
			$('#editarIdOtServicioTecnico').val(data.post.ID_OTServicioTecnico);
			$('#editarIdDocumento').val(data.post.ID_Documento);
			$('#editarTipoDocumento').val(data.post.ID_Documento).trigger('change');
			$('#editarSerieDocumento').val(data.post.Serie_OTServicioTecnico);
			$('#editarNumeroDocumento').val(data.post.NumeroDocumento_OTServicioTecnico);
			$('#editarCliente').val(data.post.ID_Cliente).trigger('change');
			$('#editarMarca').val(data.post.Marca_OTServicioTecnico);
			$('#editarModelo').val(data.post.Modelo_OTServicioTecnico);
			$('#editarDescripcion').val(data.post.Descripcion_OTServicioTecnico);
			$('#editarPrecio').val(data.post.Precio_DetalleOTServicioTecnico);
			$('#editarIva').val(data.post.Impuesto_OTServicioTecnico);
			$('#editarSubtotal').val(data.post.Subtotal_OTServicioTecnico);
			$('#editarTotal').val(data.post.Total_OTServicioTecnico);
			$('#modalEditarOtServicioTecnico').modal('show');
			
		}
		
	})
})

$(document).on('click', '#actualizarOtServicioTecnico', function (event) {
	
	event.preventDefault();
	
	let editarIdOtServicioTecnico = $('#editarIdOtServicioTecnico').val()
	// alert(editarIdOtServicioTecnico)
	let editarSerie = $('#editarSerieDocumento').val()
	// alert(editarSerie)
	let editarNumero = $('#editarNumeroDocumento').val()
	// alert(editarNumero)
	let editarCliente = $('#editarCliente').val()
	// alert(editarCliente)
	let editarMarca = $('#editarMarca').val();
	// alert(editarMarca)
	let editarModelo = $('#editarModelo').val();
	// alert(editarModelo)
	let editarDescripcion = $('#editarDescripcion').val();
	// alert(editarDescripcion)
	let editarPrecio = $('#editarPrecio').val()
	// alert(editarPrecio)
	let editarIva = $('#editarIva').val();
	// alert(editarIva)
	let editarSubtotal = $('#editarSubtotal').val()
	// alert(editarSubtotal)
	let editarTotal = $('#editarTotal').val();
	// alert(editarTotal)
	let editarIdDocumento = $('#editarTipoDocumento').val()
	// alert(editarIdDocumento)
})

/* ACTUALIZAR ORDEN DE TRABAJO SERVICIO TECNICO */
// $(document).on('click', '#actualizarOtServicioTecnico', function (event) {
//
// 	event.preventDefault()
//
// 	let editarIdOtServicioTecnico = $('#editarIdOtServicioTecnico').val();
// 	let editarClienteOtServicioTecnico = $('#editarClienteOtServicioTecnico').val();
// 	let editarMarcaOtServicioTecnico = $('#editarMarcaOtServicioTecnico').val();
// 	let editarModeloOtServicioTecnico = $('#editarModeloOtServicioTecnico').val();
// 	let editarDescripcionOtServicioTecnico = $('#editarDescripcionOtServicioTecnico').val();
// 	let editarPrecioOtServicioTecnico = $('#editarPrecioOtServicioTecnico').val();
// 	let editarImpuestoOtServicioTecnico = $('#editarImpuestoOtServicioTecnico').val();
// 	let editarSubtotalOtServicioTecnico = $('#editarSubtotalOtServicioTecnico').val();
// 	let editarTotalOtServicioTecnico = $('#editarTotalOtServicioTecnico').val();
//
// 	if (editarIdOtServicioTecnico == '' ||
// 		editarClienteOtServicioTecnico == '' ||
// 		editarMarcaOtServicioTecnico == '' ||
// 		editarModeloOtServicioTecnico == '' ||
// 		editarDescripcionOtServicioTecnico == '' ||
// 		editarPrecioOtServicioTecnico == '' ||
// 		editarImpuestoOtServicioTecnico == '' ||
// 		editarSubtotalOtServicioTecnico == '' ||
// 		editarTotalOtServicioTecnico == '') {
//
// 		new Noty({
// 			layout: 'topRight',
// 			theme: 'limitless',
// 			type: 'error',
// 			text: 'Campos requeridos',
// 			timeout: 3000,
// 		}).show();
//
// 	} else {
// 		$.ajax({
// 			url: 'http://localhost/ci3/ordenes_trabajo/servicio_tecnico/actualizar',
// 			type: 'post',
// 			dataType: 'json',
// 			data: {
// 				editarIdOtServicioTecnico: editarIdOtServicioTecnico,
// 				editarClienteOtServicioTecnico: editarClienteOtServicioTecnico,
// 				editarMarcaOtServicioTecnico: editarMarcaOtServicioTecnico,
// 				editarModeloOtServicioTecnico: editarModeloOtServicioTecnico,
// 				editarDescripcionOtServicioTecnico: editarDescripcionOtServicioTecnico,
// 				editarPrecioOtServicioTecnico: editarPrecioOtServicioTecnico,
// 				editarImpuestoOtServicioTecnico: editarImpuestoOtServicioTecnico,
// 				editarSubtotalOtServicioTecnico: editarSubtotalOtServicioTecnico,
// 				editarTotalOtServicioTecnico: editarTotalOtServicioTecnico,
// 			},
// 			success: function (data) {
//
// 				// console.log(data)
// 				if (data.respuesta == 'success') {
// 					$('#tablaServicioTecnico').DataTable().destroy()
// 					mostrarTablaServicioTecnico()
// 					$('#modalEditarOtServicioTecnico').modal('hide');
// 					/* ESTETICA AL MOSTRAR EL MENSAJE DE EXITO */
// 					new Noty({
// 						layout: 'topRight',
// 						theme: 'limitless',
// 						type: 'success',
// 						text: data.mensaje,
// 						timeout: 3000,
// 					}).show();
//
// 				} else {
//
// 					/* ESTETICA AL MOSTRAR EL MENSAJE DE ERROR */
// 					new Noty({
// 						layout: 'topRight',
// 						theme: 'limitless',
// 						type: 'error',
// 						text: data.mensaje,
// 						timeout: 3000,
// 					}).show();
//
// 				}
//
// 			}
// 		})
// 	}
//
// })

/* IMPRIMIR ORDEN DE TRABAJO SERVICIO TECNICO */

$(document).on('click', '.btn-print', function (event) {
	event.preventDefault
	
	$('#modalVerOtServicioTecnico .modal-body').print({
		title: null,
	});
})
