$('.select-search').select2({
	allowClear: true,
});
/* CREAR CLIENTE */

$(document).on('click', '#crearCliente', function (event) {
	/* PREVENIR EL EVENTO POR DEFECTO DEL BOTON */
	event.preventDefault()
	
	/* OBTENCION DE LOS VALORES DEL INPUT */
	let nombreCliente = $('#nombreCliente').val()
	let apellidoCliente = $('#apellidoCliente').val()
	let telefonoCliente = $('#telefonoCliente').val()
	
	/* COMPROBAR QUE SE OBTENGA EL VALOR DEL INPUT */
	// alert(nombreCliente);
	
	$.ajax({
		url: "http://localhost/ci3/crear",
		type: "post",
		dataType: "json",
		data: {
			/* NOMBRE DE LOS CAMPOS DE LA BASE DE DATOS | VARIABLE CON LA INFORMACION */
			Nombre_Cliente: nombreCliente,
			Apellido_Cliente: apellidoCliente,
			Telefono_Cliente: telefonoCliente,
		},
		success: function (respuesta) {
			/* COMPROBAR LA INFORMACION OBTENIDA DESDE EL CONTROLADOR */
			// console.log(respuesta)
			
			if (respuesta.respuesta == 'success') {
				$('#tablaClientes').DataTable().ajax.reload()
				/* ESTETICA AL MOSTRAR EL MENSAJE DE EXITO */
				new Noty({
					layout: 'topRight',
					theme: 'limitless',
					type: 'success',
					text: respuesta.mensaje,
					timeout: 3000,
				}).show();
				
			} else {
				
				/* ESTETICA AL MOSTRAR EL MENSAJE DE ERROR */
				new Noty({
					layout: 'topRight',
					theme: 'limitless',
					type: 'error',
					text: respuesta.mensaje,
					timeout: 3000,
				}).show();
				
			}
			
		}
	})
	/* RESETEAR EL FORMULARIO */
	$('#formularioClientes')[0].reset()
})

/* MOSTRAR CLIENTE */

$(document).ready(function () {
	
	$('#tablaClientes').DataTable({
		ajax: 'http://localhost/ci3/mostrar',
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
	
})

/* ELIMINAR CLIENTE */
$(document).on('click', '#eliminar', function (event) {
	event.preventDefault()
	
	/* COMPROBAR QUE SI SE DA CLICK */
	// alert('click');
	
	/* OBTENER EL ID DEL REGISTRO AL QUE SE LE DA CLICK */
	let eliminarId = $(this).attr('value');
	/* COMPROBAR QUE SE MUESTRA EL ID */
	// alert(eliminarId);
	
	const swalInit = swal.mixin({
		buttonsStyling: false,
		confirmButtonClass: 'btn btn-success',
		cancelButtonClass: 'btn btn-danger'
	});
	swalInit.fire({
		title: '¿Está seguro de eliminar el cliente?',
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
				url: "http://localhost/ci3/eliminar",
				type: "post",
				dataType: "json",
				data: {
					eliminarId: eliminarId
				},
				
				success: function (respuesta) {
					
					// console.log(respuesta)
					if (respuesta.respuesta == 'success') {
						
						$('#tablaClientes').DataTable().ajax.reload()
						swalInit.fire(
							'Eliminado!',
							'El cliente ha sido eliminado',
							'success'
						);
						
					}
				}
			});
		} else {
			swalInit.fire(
				'Cancelado',
				'La eliminación del usuario ha sido cancelada',
				'error'
			);
		}
	});
	
})

/* EDITAR */
$(document).on('click', '#editar', function (event) {
	
	event.preventDefault();
	
	let editarId = $(this).attr('value');
	// alert(editarId)
	$.ajax({
		url: 'http://localhost/ci3/editar',
		type: 'post',
		dataType: 'json',
		data: {
			editarId: editarId
		},
		success: function (data) {
			if (data.respuesta == 'success') {
				$('#editarIdCliente').val(data.post.ID_Cliente);
				$('#editarNombreCliente').val(data.post.Nombre_Cliente);
				$('#editarApellidoCliente').val(data.post.Apellido_Cliente);
				$('#editarTelefonoCliente').val(data.post.Telefono_Cliente);
				$('#modalEditarCliente').modal('show');
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
			// console.log(data)
			
		}
	})
});
/* ACTUALIZAR */

$(document).on('click', '#actualizar', function (event) {
	event.preventDefault
	
	let editarIdCliente = $('#editarIdCliente').val();
	let editarNombreCliente = $('#editarNombreCliente').val();
	let editarApellidoCliente = $('#editarApellidoCliente').val();
	let editarTelefonoCliente = $('#editarTelefonoCliente').val();
	
	if (editarIdCliente == '' ||
		editarNombreCliente == '' ||
		editarApellidoCliente == '' ||
		editarTelefonoCliente == '') {
		
		new Noty({
			layout: 'topRight',
			theme: 'limitless',
			type: 'error',
			text: 'Campos requeridos',
			timeout: 3000,
		}).show();
		
	} else {
		$.ajax({
			url: 'http://localhost/ci3/actualizar',
			type: 'post',
			dataType: 'json',
			data: {
				editarIdCliente: editarIdCliente,
				editarNombreCliente: editarNombreCliente,
				editarApellidoCliente: editarApellidoCliente,
				editarTelefonoCliente: editarTelefonoCliente,
			},
			success: function (data) {
				// console.log(data)
				if (data.respuesta == 'success') {
					$('#tablaClientes').DataTable().ajax.reload()
					$('#modalEditarCliente').modal('hide');
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
	
});
