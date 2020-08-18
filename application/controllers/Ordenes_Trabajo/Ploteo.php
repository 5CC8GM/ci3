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
			if ($this->input->is_ajax_request()) {
				
				if ($this->ploteo_model->crear($datosOtPloteo)) {
					
					/* ALAMCENAR EN UNA VARIABLE EL ULTIMO ID INGRESADO */
					$idOtPloteo = $this->ploteo_model->ultimoId();
					$this->actualizarDocumentos($idDocumento);
					
					
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
		
	}
