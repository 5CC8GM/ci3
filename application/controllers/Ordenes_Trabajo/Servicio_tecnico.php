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
			$data = array('cliente'                    => $this->clientes_model->mostrar(),
						  'tipoDocumento'              => $this->servicio_tecnico_model->getComprobantes(),
						  'informacionServicioTecnico' => $this->servicio_tecnico_model->mostrar());
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
			
			$ot = $this->input->post(
				
				array('ID_Documento',
					  'Serie_OTServicioTecnico',
					  'NumeroDocumento_OTServicioTecnico',
					  'ID_Cliente',
					  'Marca_OTServicioTecnico',
					  'Modelo_OTServicioTecnico',
					  'Descripcion_OTServicioTecnico',
					  'Impuesto_OTServicioTecnico',
					  'Subtotal_OTServicioTecnico',
					  'Total_OTServicioTecnico'), TRUE
			
			);
			/* COMPROBAR SI ES UNA SOLICITUD AJAX */
			if ($this->input->is_ajax_request()) {
				
				/* ENVIAR OBTENER LOS DATOS DE LOS INPUTS DESDE Y HACIA LA BASE DE DATOS */
				if ($this->servicio_tecnico_model->insertar($ot)) {
					
					$idOtServicoTecnico = $this->servicio_tecnico_model->lastId();
					
					$this->updateDocumento($idDocumento);
					
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
		
		public function mostrar() {
			
			$resultadoList = $this->servicio_tecnico_model->mostrar();
			$resultado = array();
			$i = 1;
			
			if (!empty($resultadoList)) {
				
				foreach ($resultadoList as $key => $value) {
					
					$fecha = $value['Fecha_OTServicioTecnico'];
					setlocale(LC_ALL, 'spanish');
					$fechaNueva = strftime("%d de %B de %Y a las %H:%M:%S", strtotime($fecha));
					
					$nombreApellido = $value['Nombre_Cliente'] . ' ' . $value['Apellido_Cliente'];
					
					if ($value['Estado_OTServicioTecnico'] == '1') {
						$estado = 'Vigente';
					} else {
						$estado = 'Anulada';
					}
					
					/* CREACION DEL SELECTOR DENTRO DE LA TABLA PARA CAMBIAR SU ESTADO POSTERIORMENTE */
					$estadoDocumento = '<select name="estadoDocumento" class="estadoDocumento form-control" data-fouc disabled="disabled">

                                            <option value="' . $value['Estado_OTServicioTecnico'] . '">
                                    
                                                ' . $estado . '
                                                
                                            </option>
                                        </select>';
					
					$acciones = '<div class="list-icons"><a href="#" id="verOtServicioTecnico" value="' .
						$value['ID_OTServicioTecnico'] . '" class="btn btn-primary btn-icon" type="button"><i class="icon-info22"></i></a><a href="#" id="editarOtServicioTecnico" value="' .
						$value['ID_OTServicioTecnico'] . '" class="btn btn-warning btn-icon" type="button"><i class="icon-pencil7"></i></a><a href="#" id="eliminarOtServicioTecnico" value="' .
						$value['ID_OTServicioTecnico'] . '"  class="btn btn-danger btn-icon" type="button"><i class="icon-trash"></i></a></div>';
					
					$resultado['data'][] = array(
						
						$i++,
						$nombreApellido,
						$value['Nombre_Documento'],
						$value['NumeroDocumento_OTServicioTecnico'],
						$estadoDocumento,
						$value['Descripcion_OTServicioTecnico'],
						$fechaNueva,
						$value['Total_OTServicioTecnico'],
						$acciones
					
					);
				}
				
			} else {
				$resultado['data'] = array();
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
		
		public function actualizar() {
			
			if ($this->input->is_ajax_request()) {
				
				/* ALMACENAR EN UNA VARIABLE LOS DATOS DE LOS INPUTS */
				$data['ID_OTServicioTecnico'] = $this->input->post('id');
				$data['ID_Cliente'] = $this->input->post('cliente');
				$data['Estado_OTServicioTecnico'] = $this->input->post('estadoDocumento');
				$data['Marca_OTServicioTecnico'] = $this->input->post('marca');
				$data['Modelo_OTServicioTecnico'] = $this->input->post('modelo');
				$data['Descripcion_OTServicioTecnico'] = $this->input->post('descripcion');
				$data['Impuesto_OTServicioTecnico'] = $this->input->post('iva');
				$data['Subtotal_OTServicioTecnico'] = $this->input->post('subtotal');
				$data['Total_OTServicioTecnico'] = $this->input->post('total');
				
				/* ENVIAR OBTENER LOS DATOS DE LOS INPUTS DESDE Y HACIA LA BASE DE DATOS */
				if ($this->servicio_tecnico_model->actualizar($data)) {
					
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
			
			$data = array('venta' => $this->servicio_tecnico_model->getVenta($idOtServicioTecnico));
			
			$this->load->view('ordenes_trabajo/invoice', $data);
			
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
