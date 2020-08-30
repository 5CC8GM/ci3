<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Ploteo extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->model('clientes_model');
			$this->load->model('ordenes_trabajo/ploteo_model');
		}
		
		/* FUNCION PARA PERMITIR MAS CARACTERES Y ESPACIOS */
		function alpha_dash_space($str) {
			return (!preg_match("/^([-a-z-ñ-Ñ_0-9, ])+$/i", $str)) ? FALSE : TRUE;
		}
		
		/* VISTA */
		public function index() {
			
			$data = array('clientePloteo'       => $this->clientes_model->mostrar(),
						  'tipoDocumentoPloteo' => $this->ploteo_model->getComprobantes());
			
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
			$this->load->view('ordenes_trabajo/ploteo', $data);
			/* FOOTER */
			$this->load->view('layouts/footer');
			
		}
		
		/* OBTENER DOCUMENTOS POR ID */
		public function obtenerDocumentos() {
			
			$id = $this->input->post('id');
			$data = $this->ploteo_model->getFacturas($id);
			$output = null;
			foreach ($data as $row) {
				
				$salida = $row->ID_Documento . '*' . $row->Cantidad_Documento . '*' . $row->Impuesto_Documento . '*' .
					$row->Serie_Documento;
				
				$output .= $salida;
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($output));
			
		}
		
		/* CREAR ORDEN DE TRABAJO PLOTEO */
		public function crear() {
			
			/* ALMACENAR EN UNA VARIABLE TODOS LOS DATOS OBTENIDOS POR POST */
			$datosOtPloteo = $this->input->post(array('ID_Documento', 'Serie_OTPloteo', 'NumeroDocumento_OTPloteo', 'ID_Cliente', 'Subtotal_OTPloteo', 'Impuesto_OTPloteo', 'Total_OTPloteo'), TRUE);
			$idDocumento = $this->input->post('ID_Documento');
			
			$precioPorMetroPloteo = $this->input->post('Precio_OTPloteo');
			$importePloteo = $this->input->post('Importe_OTPloteo');
			
			if ($this->input->is_ajax_request()) {
				
				if ($this->ploteo_model->crear($datosOtPloteo)) {
					
					/* ALAMCENAR EN UNA VARIABLE EL ULTIMO ID INGRESADO */
					$idOtPloteo = $this->ploteo_model->ultimoId();
					$this->actualizarDocumentos($idDocumento);
					$this->guardarDetalleOt($idOtPloteo, $precioPorMetroPloteo, $importePloteo);
					
					$data = array('respuesta' => 'success', 'mensaje' => 'La orden de trabajo de servicio técnico ha sido guardado exitosamente');
				} else {
					
					/* MENSAJE DE ERROR SI NO SE INSERTA CORRECTAMENTE */
					$data = array('respuesta' => 'error', 'mensaje' => 'La orden de trabajo de servicio técnico no ha sido guardado');
					
				}
				
				echo json_encode($data);
				
			} else {
				
				echo 'No se permite el acceso de scripts';
				
			}
			
		}
		
		/* ACTUALIZAR LOS DOCUMENTOS */
		protected function actualizarDocumentos($idDocumento) {
			
			$documentoActual = $this->ploteo_model->getDocumento($idDocumento);
			
			$data = array('Cantidad_Documento' => $documentoActual->Cantidad_Documento + 1);
			
			$this->ploteo_model->actualizarDocumento($idDocumento, $data);
			
		}
		
		/* GUARDAR LOS IMPORTES DE PLOTEO EN DETALLE DE PLOTEO */
		protected function guardarDetalleOt($idOrdenTrabajoPloteo, $metros, $importe) {
			
			for ($i = 0; $i < count($metros); $i++) {
				
				$datos = array('ID_OTPloteo'      => $idOrdenTrabajoPloteo,
							   'Precio_OTPloteo'  => $metros[$i],
							   'Importe_OTPloteo' => $importe[$i]);
				
				$this->ploteo_model->guardarDetalleOTPloteo($datos);
				
			}
			
		}
		
		/* MOSTRAR ORDENES DE TRABAJO PLOTEO */
		public function mostrar() {
			
			$resultadoDb = $this->ploteo_model->mostrar();
			$resultado = array();
			$i = 1;
			
			if (!empty($resultadoDb)) {
				
				foreach ($resultadoDb as $key => $value) {
					$fecha = $value['Fecha_OTPloteo'];
					setlocale(LC_ALL, 'spanish');
					$fechaNueva = strftime("%d de %B de %Y a las %H:%M:%S", strtotime($fecha));
					$nombreApellido = $value['Nombre_Cliente'] . ' ' . $value['Apellido_Cliente'];
					$acciones = '<div class="list-icons"><a href="#" id="verOtPloteo" value="' .
						$value['ID_OTPloteo'] . '" class="btn btn-primary btn-icon" type="button"><i class="icon-info22"></i></a><a href="#" id="editarOtPloteo" value="' .
						$value['ID_OTPloteo'] . '" class="btn btn-warning btn-icon" type="button"><i class="icon-pencil7"></i></a><a href="#" id="eliminarOtPloteo" value="' .
						$value['ID_OTPloteo'] . '"  class="btn btn-danger btn-icon" type="button"><i class="icon-trash"></i></a></div>';
					
					$resultado['data'][] = array(
						$i++,
						$nombreApellido,
						$value['Nombre_Documento'],
						$value['NumeroDocumento_OTPloteo'],
						$fechaNueva,
						$value['Total_OTPloteo'],
						$acciones
					);
					
				}
				
			} else {
				$resultado['data'] = array();
			}
			
			echo json_encode($resultado);
			
		}
		
		/* ELIMINAR ORDEN DE TRABAJO PLOTEO */
		public function eliminar() {
			
			if ($this->input->is_ajax_request()) {
				
				$idPloteo = $this->input->post('idPloteo');
				
				if ($this->ploteo_model->eliminar($idPloteo)) {
					
					$datos = array('respuesta' => 'success');
					
				} else {
					
					$datos = array('respuesta' => 'error');
				}
				
				echo json_encode($datos);
				
			} else {
				
				echo 'No se permite el acceso de scripts';
				
			}
			
		}
		
		/* EDITAR ORDEN DE TRABAJO PLOTEO */
		public function editar() {
			
			if ($this->input->is_ajax_request()) {
				
				$idEditarOtPloteo = $this->input->post('idEditarOtPloteo');
				if ($datos = $this->ploteo_model->editar($idEditarOtPloteo)) {
					$datosDetalleOtPloteo = $this->ploteo_model->editarOtDetallePloteo($idEditarOtPloteo);
					
					$data = array('respuesta' => 'success', 'post' => array($datos, $datosDetalleOtPloteo));
					
				} else {
					$data = array('respuesta' => 'error', 'mensaje' => 'Error al mostrar los datos');
				}
				
				echo json_encode($data);
				
			} else {
				echo 'No se permite el acceso de scripts';
			}
			
		}
		
		/* ACTUALIZAR ORDEN DE TRABAJO PLOTEO */
		public function actualizar() {
			
			if ($this->input->is_ajax_request()) {
				$dataOtPloteo['ID_OTPloteo'] = $this->input->post('editarIdOtPloteo');
				$dataOtPloteo['ID_Cliente'] = $this->input->post('editarIdCliente');
				$dataDetalleOtPloteo['Precio_OTPloteo'] = $this->input->post('metrosPloteo');
				$dataDetalleOtPloteo['Importe_OTPloteo'] = $this->input->post('importePloteo');
				$dataOtPloteo['Subtotal_OTPloteo'] = $this->input->post('editarSubtotal');
				$dataOtPloteo['Impuesto_OTPloteo'] = $this->input->post('editarIva');
				$dataOtPloteo['Total_OTPloteo'] = $this->input->post('editarTotal');
				$idAEliminar = $this->input->post('idAEliminar');
				$id = $this->input->post('editarIdDetalleOTPloteo');
				//				var_dump($idAEliminar);
				/* DATOS NUEVOS OBTENIDOS CUANDO SE CREA UN NUEVO METRAJE CON EL BOTON AGREGAR */
				$dataNuevosOtPloteo['Precio_OTPloteo'] = $this->input->post('nuevoMetroPloteo');
				$dataNuevosOtPloteo['Importe_OTPloteo'] = $this->input->post('nuevoImportePloteo');
				
				if ($this->ploteo_model->actualizar($dataOtPloteo)) {
					
					/* EDITAR EL DETALLE DE LA ORDEN DE TRABAJO PLOTEO */
					if ($id != null) {
						$this->ploteo_model->editarDetalleOtPloteo();
					} else {
						$data = array('respuesta' => 'error', 'mensaje' => 'Debe ingresar al metro un metro');
					}
					if ($idAEliminar != null) {
						$this->ploteo_model->idAEliminar($idAEliminar);
					}
					if ($dataNuevosOtPloteo['Precio_OTPloteo'] != null
						&& $dataNuevosOtPloteo['Importe_OTPloteo'] != null) {
						$idOrdenTrabajoPloteo = json_decode($this->input->post('editarIdOtPloteo'));
						
						$metros = $this->input->post('nuevoMetroPloteo');
						$importe = $this->input->post('nuevoImportePloteo');
						$this->guardarDetalleOt($idOrdenTrabajoPloteo, $metros, $importe);
						
					}
					
					$data = array('respuesta' => 'success', 'mensaje' => 'La orden de trabajo de ploteo ha sido actualizada exitosamente');
				} else {
					
					/* MENSAJE DE ERROR SI NO SE INSERTA CORRECTAMENTE */
					$data = array('respuesta' => 'error', 'mensaje' => 'La orden de trabajo de ploteo no ha sido actualizada');
				}
				echo json_encode($data);
			} else {
				echo 'No se permite el acceso de scripts';
			}
			
		}
		
		public function verOtPloteo() {
			
			$idPloteo = $this->input->post('id');
			
			$data = array('venta'   => $this->ploteo_model->getOtPloteo($idPloteo),
						  'detalle' => $this->ploteo_model->getDetalle($idPloteo));
			
			
			$this->load->view('ordenes_trabajo/invoice_ploteo', $data);
			
		}
		
	}
