<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Servicio_tecnico extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->model('clientes_model');
			$this->load->model('ordenes_trabajo/servicio_tecnico_model');
		}
		
		/* FUNCION PARA PERMITIR MAS CARACTERES Y ESPACIOS */
		function alpha_dash_space($str) {
			return (!preg_match("/^([-a-z-ñ-Ñ_0-9, ])+$/i", $str)) ? FALSE : TRUE;
		}
		
		public function index() {
			/* CARGA LOS DATOS DEL METODO MOSTRAR DEL MODELO Y LOS ADJUNTA EN UN ARRAY PARA PASARLO A LA VISTA */
			$data = array('cliente'       => $this->clientes_model->mostrar(),
						  'tipoDocumento' => $this->servicio_tecnico_model->getComprobantes());
			/* CARGA DE ELEMENTOS DEL LAYOUT */
			/* HEADER */
			$this->load->view('layouts/header');
			/* NAVBAR */
			$this->load->view('layouts/navbar');
			/* SIDEBAR */
			$this->load->view('layouts/sidebar');
			/* BREADCRUMB */
			$this->load->view('layouts/breadcrumb');
			/* CONTENIDO PRINCIPAL */
			$this->load->view('ordenes_trabajo/servicio_tecnico', $data);
			/* FOOTER */
			$this->load->view('layouts/footer');
			
		}
		
		
		public function crear() {
			
			$idDocumento = $this->input->post('ID_Documento');
			$precio = $this->input->post('Precio_DetalleOTServicioTecnico');
			$importe = $this->input->post('Total_DetalleOTServicioTecnico');
			
			$ot = $this->input->post(array('ID_Documento', 'Serie_OTServicioTecnico', 'NumeroDocumento_OTServicioTecnico', 'ID_Cliente', 'Marca_OTServicioTecnico', 'Modelo_OTServicioTecnico', 'Descripcion_OTServicioTecnico', 'Impuesto_OTServicioTecnico', 'Subtotal_OTServicioTecnico', 'Total_OTServicioTecnico'), TRUE);
			/* COMPROBAR SI ES UNA SOLICITUD AJAX */
			if ($this->input->is_ajax_request()) {
				
				/* IMPRESION SI ES UNA SOLICITUD AJAX */
				//				echo 'yes';
				
				/* REGLAS PARA LA VALIDACION DE LOS INPUTS */
				/*$this->form_validation->set_rules('ID_Cliente', 'Nombre del Cliente', 'required|numeric|trim', array('required' => 'El cliente es obligatorio', 'numeric' => 'El cliente es obligatorio'));
				$this->form_validation->set_rules('Marca_OTServicioTecnico', 'Marca', 'required|callback_alpha_dash_space|trim', array('required' => '<br>' . 'La marca es obligatoria', 'alpha_dash_space' => '<br>' . 'La marca debe tener solo caracteres alfabéticos o numéricos'));
				$this->form_validation->set_rules('Modelo_OTServicioTecnico', 'Modelo', 'required|callback_alpha_dash_space|trim', array('required' => '<br>' . 'El modelo es obligatorio', 'alpha_dash_space' => '<br>' . 'El modelo debe tener solo caracteres alfabéticos o numéricos'));
				$this->form_validation->set_rules('Descripcion_OTServicioTecnico', 'Descripcion', 'required|callback_alpha_dash_space|trim', array('required' => '<br>' . 'La descripcion es obligatorio', 'alpha_dash_space' => '<br>' . 'La descripción debe tener solo caracteres alfabéticos'));
				$this->form_validation->set_rules('Precio_OTServicioTecnico', 'Precio', 'required|numeric|trim', array('required' => '<br>' . 'El precio es obligatorio', 'numeric' => '<br>' . 'El precio debe tener solo números'));
				$this->form_validation->set_rules('Impuesto_OTServicioTecnico', 'Impuesto', 'required|numeric|trim', array('required' => '<br>' . 'El impuesto es obligatorio', 'numeric' => '<br>' . 'El impuesto debe tener solo números'));
				$this->form_validation->set_rules('Subtotal_OTServicioTecnico', 'Subtotal', 'required|numeric|trim', array('required' => '<br>' . 'El subtotal es obligatorio', 'numeric' => '<br>' . 'El subtotal debe tener solo números'));
				$this->form_validation->set_rules('Total_OTServicioTecnico', 'Total', 'required|numeric|trim', array('required' => '<br>' . 'El total es obligatorio', 'numeric' => '<br>' . 'El total debe tener solo números'));*/
				
				/* CONDICION SI NO SE EJECUTA LA VALIDACION */
				//				if ($this->form_validation->run() == FALSE) {
				//
				//					/* MENSAJE CON EL ERROR SI NO SE EJECUTA LA VALIDACION */
				//					$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
				//
				//				} else {
				
				/* ALMACENAR EN UNA VARIABLE LOS DATOS DE LOS INPUTS */
				//				$ajax_data = $this->input->post();
				
				/* ENVIAR OBTENER LOS DATOS DE LOS INPUTS DESDE Y HACIA LA BASE DE DATOS */
				if ($this->servicio_tecnico_model->insertar($ot)) {
					$idOtServicoTecnico = $this->servicio_tecnico_model->lastId();
					$this->updateDocumento($idDocumento);
					
					$this->saveDetalle($idOtServicoTecnico, $precio, $importe);
					/* MENSAJE AL INSERTAR CORRECTAMENTE */
					$data = array('respuesta' => 'success', 'mensaje' => 'La orden de trabajo de servicio técnico ha sido guardado exitosamente');
					
				} else {
					
					/* MENSAJE DE ERROR SI NO SE INSERTA CORRECTAMENTE */
					$data = array('respuesta' => 'error', 'mensaje' => 'La orden de trabajo de servicio técnico no ha sido guardado');
				}
				
				//				}
				echo json_encode($data);
			} else {
				echo 'No se permite el acceso de scripts';
			}
			
			
		}
		
		protected function updateDocumento($idDocumento) {
			
			$documentoActual = $this->servicio_tecnico_model->getComprobante($idDocumento);
			
			$data = array('Cantidad_Documento' => $documentoActual->Cantidad_Documento + 1);
			
			$this->servicio_tecnico_model->updateComprobante($idDocumento, $data);
			
		}
		
		protected function saveDetalle($idOtServicoTecnico, $precio, $importe) {
			$data = array('ID_OTServicioTecnico'            => $idOtServicoTecnico,
						  'Precio_DetalleOTServicioTecnico' => $precio,
						  'Total_DetalleOTServicioTecnico'  => $importe);
			
			$this->servicio_tecnico_model->saveDetalle($data);
			
		}
		
		public function editarSaveDetalle() {
			
			$data = array('ID_OTServicioTecnico'            => $data2['ID_OTServicioTecnico'] = $this->input->post('id'),
						  'Precio_DetalleOTServicioTecnico' => $data2['Precio_DetalleOTServicioTecnico'] = $this->input->post('precio'),
						  'Total_DetalleOTServicioTecnico'  => $data2['Total_DetalleOTServicioTecnico'] = $this->input->post('totalDetalle'));
			
			$this->servicio_tecnico_model->editarSaveDetalle($data);
			
		}
		
		public function mostrar() {
			
			$resultadoList = $this->servicio_tecnico_model->mostrar();
			$resultado = array();
			$i = 1;
			foreach ($resultadoList as $key => $value) {
				$nombreApellido = $value['Nombre_Cliente'] . ' ' . $value['Apellido_Cliente'];
				$acciones = '<div class="list-icons"><a href="#" id="verOtServicioTecnico" value="' .
					$value['ID_OTServicioTecnico'] . '" class="btn btn-primary btn-icon" type="button"><i class="icon-info22"></i></a><a href="#" id="editarOtServicioTecnico" value="' .
					$value['ID_OTServicioTecnico'] . '" class="btn btn-warning btn-icon" type="button"><i class="icon-pencil7"></i></a><a href="#" id="eliminarOtServicioTecnico" value="' .
					$value['ID_OTServicioTecnico'] . '"  class="btn btn-danger btn-icon" type="button"><i class="icon-trash"></i></a></div>';
				
				$resultado['data'][] = array(
					$i++,
					$nombreApellido,
					$value['Nombre_Documento'],
					$value['NumeroDocumento_OTServicioTecnico'],
					$value['Descripcion_OTServicioTecnico'],
					$value['Fecha_OTServicioTecnico'],
					$value['Total_OTServicioTecnico'],
					$acciones
				);
			}
			echo json_encode($resultado);
			
			
		}
		
		public function eliminar() {
			
			if ($this->input->is_ajax_request()) {
				
				$eliminarIdOtServicioTecnico = $this->input->post('eliminarIdOtServicioTecnico');
				
				//				$datos = array('eliminarId' => $eliminarId);
				if ($this->servicio_tecnico_model->eliminar($eliminarIdOtServicioTecnico)) {
					
					$datos = array('respuesta' => 'success');
					
				} else {
					
					$datos = array('respuesta' => 'error');
				}
				echo json_encode($datos);
				
			} else {
				echo 'No se permite el acceso de scripts';
			}
			
		}
		
		//		public function editar() {
		//			/* COMPROBAR SI ES UNA SOLICITUD AJAX */
		//			if ($this->input->is_ajax_request()) {
		//
		//				$editarIdOtServicioTecnico = $this->input->post('editarIdOtServicioTecnico');
		//				if ($datos = $this->servicio_tecnico_model->editar($editarIdOtServicioTecnico)) {
		//
		//					$data = array('respuesta' => 'success', 'post' => $datos);
		//
		//				} else {
		//					$data = array('respuesta' => 'error', 'mensaje' => 'Error al mostrar los datos');
		//				}
		//
		//				/* RESPUESTA EN FORMATO JSON */
		//				echo json_encode($data);
		//
		//
		//			} else {
		//				echo 'No se permite el acceso de scripts';
		//			}
		//		}
		
		public function editar() {
			/* COMPROBAR SI ES UNA SOLICITUD AJAX */
			if ($this->input->is_ajax_request()) {
				
				$editarIdOtServicioTecnico = $this->input->post('editarIdOtServicioTecnico');
				if ($datos = $this->servicio_tecnico_model->editar($editarIdOtServicioTecnico)) {
					
					$data = array('respuesta' => 'success', 'post' => $datos);
					
				} else {
					$data = array('respuesta' => 'error', 'mensaje' => 'Error al mostrar los datos');
				}
				
				/* RESPUESTA EN FORMATO JSON */
				echo json_encode($data);
				
				
			} else {
				echo 'No se permite el acceso de scripts';
			}
		}
		
		//		public function actualizar() {
		//
		//			if ($this->input->is_ajax_request()) {
		//
		//				/* REGLAS PARA LA VALIDACION DE LOS INPUTS */
		//				$this->form_validation->set_rules('editarClienteOtServicioTecnico', 'Nombre del Cliente', 'required|numeric|trim', array('required' => 'El cliente es obligatorio', 'numeric' => 'El cliente es obligatorio'));
		//				$this->form_validation->set_rules('editarMarcaOtServicioTecnico', 'Marca', 'required|callback_alpha_dash_space|trim', array('required' => '<br>' . 'La marca es obligatoria', 'alpha_dash_space' => '<br>' . 'La marca debe tener solo caracteres alfabéticos o numéricos'));
		//				$this->form_validation->set_rules('editarModeloOtServicioTecnico', 'Modelo', 'required|callback_alpha_dash_space|trim', array('required' => '<br>' . 'El modelo es obligatorio', 'alpha_dash_space' => '<br>' . 'El modelo debe tener solo caracteres alfabéticos o numéricos'));
		//				$this->form_validation->set_rules('editarDescripcionOtServicioTecnico', 'Descripcion', 'required|callback_alpha_dash_space|trim', array('required' => '<br>' . 'La descripcion es obligatorio', 'alpha_dash_space' => '<br>' . 'La descripción debe tener solo caracteres alfabéticos o numéricos'));
		//				$this->form_validation->set_rules('editarPrecioOtServicioTecnico', 'Precio', 'required|numeric|trim', array('required' => '<br>' . 'El precio es obligatorio', 'numeric' => '<br>' . 'El precio debe tener solo números'));
		//				$this->form_validation->set_rules('editarImpuestoOtServicioTecnico', 'Impuesto', 'required|numeric|trim', array('required' => '<br>' . 'El impuesto es obligatorio', 'numeric' => '<br>' . 'El impuesto debe tener solo números'));
		//				$this->form_validation->set_rules('editarSubtotalOtServicioTecnico', 'Subtotal', 'required|numeric|trim', array('required' => '<br>' . 'El subtotal es obligatorio', 'numeric' => '<br>' . 'El subtotal debe tener solo números'));
		//				$this->form_validation->set_rules('editarTotalOtServicioTecnico', 'Total', 'required|numeric|trim', array('required' => '<br>' . 'El total es obligatorio', 'numeric' => '<br>' . 'El total debe tener solo números'));
		//
		//				/* CONDICION SI NO SE EJECUTA LA VALIDACION */
		//				if ($this->form_validation->run() == FALSE) {
		//
		//					/* MENSAJE CON EL ERROR SI NO SE EJECUTA LA VALIDACION */
		//					$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
		//
		//				} else {
		//
		//					/* ALMACENAR EN UNA VARIABLE LOS DATOS DE LOS INPUTS */
		//					$data['ID_OTServicioTecnico'] = $this->input->post('editarIdOtServicioTecnico');
		//					$data['ID_Cliente'] = $this->input->post('editarClienteOtServicioTecnico');
		//					$data['Marca_OTServicioTecnico'] = $this->input->post('editarMarcaOtServicioTecnico');
		//					$data['Modelo_OTServicioTecnico'] = $this->input->post('editarModeloOtServicioTecnico');
		//					$data['Descripcion_OTServicioTecnico'] = $this->input->post('editarDescripcionOtServicioTecnico');
		//					$data['Precio_OTServicio_Tecnico'] = $this->input->post('editarPrecioOtServicioTecnico');
		//					$data['Impuesto_OTServicioTecnico'] = $this->input->post('editarImpuestoOtServicioTecnico');
		//					$data['Subtotal_OTServicioTecnico'] = $this->input->post('editarSubtotalOtServicioTecnico');
		//					$data['Total_OTServicioTecnico'] = $this->input->post('editarTotalOtServicioTecnico');
		//
		//					/* ENVIAR OBTENER LOS DATOS DE LOS INPUTS DESDE Y HACIA LA BASE DE DATOS */
		//					if ($this->servicio_tecnico_model->actualizar($data)) {
		//
		//						/* MENSAJE AL INSERTAR CORRECTAMENTE */
		//						$data = array('respuesta' => 'success', 'mensaje' => 'La orden de trabajo de servicio técnico ha sido editada exitosamente');
		//
		//					} else {
		//
		//						/* MENSAJE DE ERROR SI NO SE INSERTA CORRECTAMENTE */
		//						$data = array('respuesta' => 'error', 'mensaje' => 'La orden de trabajo de servicio técnico no ha sido editada');
		//					}
		//
		//				}
		//				echo json_encode($data);
		//
		//			} else {
		//				echo 'No se permite el acceso de scripts';
		//			}
		//
		//		}
		
		public function actualizar() {
			
			if ($this->input->is_ajax_request()) {
				
				/* ALMACENAR EN UNA VARIABLE LOS DATOS DE LOS INPUTS */
				$data['ID_OTServicioTecnico'] = $this->input->post('id');
				$data['ID_Cliente'] = $this->input->post('cliente');
				$data['Marca_OTServicioTecnico'] = $this->input->post('marca');
				$data['Modelo_OTServicioTecnico'] = $this->input->post('modelo');
				$data['Descripcion_OTServicioTecnico'] = $this->input->post('descripcion');
				$data['Impuesto_OTServicioTecnico'] = $this->input->post('iva');
				$data['Subtotal_OTServicioTecnico'] = $this->input->post('subtotal');
				$data['Total_OTServicioTecnico'] = $this->input->post('total');
				
				$data2['Precio_DetalleOTServicioTecnico'] = $this->input->post('precio');
				$data2['Total_DetalleOTServicioTecnico'] = $this->input->post('totalDetalle');
				
				/* ENVIAR OBTENER LOS DATOS DE LOS INPUTS DESDE Y HACIA LA BASE DE DATOS */
				if ($this->servicio_tecnico_model->actualizar($data)) {
					
					$this->editarSaveDetalle();
					
					/* MENSAJE AL INSERTAR CORRECTAMENTE */
					$data = array('respuesta' => 'success', 'mensaje' => 'La orden de trabajo de servicio técnico ha sido actualizada exitosamente');
					
				} else {
					
					/* MENSAJE DE ERROR SI NO SE INSERTA CORRECTAMENTE */
					$data = array('respuesta' => 'error', 'mensaje' => 'La orden de trabajo de servicio técnico no ha sido actualizada');
				}
				
				
				echo json_encode($data);
				
			} else {
				echo 'No se permite el acceso de scripts';
			}
			
		}
		
		public function verOtServicioTecnico() {
			
			$idOtServicioTecnico = $this->input->post('id');
			
			$data = array('venta'   => $this->servicio_tecnico_model->getVenta($idOtServicioTecnico),
						  'detalle' => $this->servicio_tecnico_model->getDetalle($idOtServicioTecnico));
			
			$this->load->view('ordenes_trabajo/invoice', $data);
			
		}
		
		public function getFacts() {
			
			$search = $this->input->post('search');
			//			var_dump($search);
			$resultados = $this->servicio_tecnico_model->getFacts($search);
			
			foreach ($resultados as $row) {
				
				$selectAjax[] = array(
					'id'       => $row['ID_Documento'],
					'text'     => $row['Nombre_Documento'],
					'impuesto' => $row['Impuesto_Documento'],
					'cantidad' => $row['Cantidad_Documento'],
					'serie'    => $row['Serie_Documento'],
				);
				$this->output->set_content_type('application / json')->set_output(json_encode($selectAjax));
			}
		}
		
		public function getFacturas() {
			
			$id = $this->input->post('id');
			$data = $this->servicio_tecnico_model->getFacturas($id);
			$output = null;
			foreach ($data as $row) {
				
				$salida = $row->ID_Documento . '*' . $row->Cantidad_Documento . '*' . $row->Impuesto_Documento . '*' .
					$row->Serie_Documento;
				
				$output .= $salida;
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
	}
