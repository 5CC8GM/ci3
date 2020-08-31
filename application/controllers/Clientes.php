<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Clientes extends CI_Controller {
		
		public function __construct() {
			
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->model('clientes_model');
			
		}
		
		function alpha_dash_space($str) {
			return (!preg_match("/^([-a-z-ñ-Ñ_ ])+$/i", $str)) ? FALSE : TRUE;
		}
		
		public function index() {
			
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
			$this->load->view('admin/clientes');
			/* FOOTER */
			$this->load->view('layouts/footer');
			
		}
		
		public function crear() {
			
			/* COMPROBAR SI ES UNA SOLICITUD AJAX */
			if ($this->input->is_ajax_request()) {
				
				/* IMPRESION SI ES UNA SOLICITUD AJAX */
				//				echo 'yes';
				
				/* REGLAS PARA LA VALIDACION DE LOS INPUTS */
				$this->form_validation->set_rules('Nombre_Cliente', 'Nombre del Cliente', 'required|callback_alpha_dash_space|trim', array('required' => 'El nombre del cliente es obligatorio', 'alpha_dash_space' => 'El nombre del cliente debe tener solo caracteres alfabéticos'));
				$this->form_validation->set_rules('Apellido_Cliente', 'Apellido del Cliente', 'required|callback_alpha_dash_space|trim', array
				('required' => '<br>' . 'El apellido del cliente es obligatorio', 'alpha_dash_space' => '<br>' . 'El apellido del cliente debe tener solo caracteres alfabéticos'));
				$this->form_validation->set_rules('Telefono_Cliente', 'Telefono del Cliente', 'required|numeric', array
				('required' => '<br>' . 'El teléfono del cliente es obligatorio', 'numeric' => '<br>' . 'El teléfono del cliente debe tener solo numeros'));
				
				/* CONDICION SI NO SE EJECUTA LA VALIDACION */
				if ($this->form_validation->run() == FALSE) {
					
					/* MENSAJE CON EL ERROR SI NO SE EJECUTA LA VALIDACION */
					$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
					
				} else {
					
					/* ALMACENAR EN UNA VARIABLE LOS DATOS DE LOS INPUTS */
					$ajax_data = $this->input->post();
					
					/* ENVIAR OBTENER LOS DATOS DE LOS INPUTS DESDE Y HACIA LA BASE DE DATOS */
					if ($this->clientes_model->insertar($ajax_data)) {
						
						/* MENSAJE AL INSERTAR CORRECTAMENTE */
						$data = array('respuesta' => 'success', 'mensaje' => 'El cliente ha sido guardado exitosamente');
						
					} else {
						
						/* MENSAJE DE ERROR SI NO SE INSERTA CORRECTAMENTE */
						$data = array('respuesta' => 'error', 'mensaje' => 'El cliente no ha sido guardado');
					}
					
				}
				echo json_encode($data);
			} else {
				echo 'No se permite el acceso de scripts';
			}
			
			
		}
		
		public function mostrar() {
			
			if ($this->input->is_ajax_request()) {
				
				if ($datos = $this->clientes_model->mostrar()) {
					$respuesta = array('respuesta' => 'success', 'datos' => $datos);
				} else {
					$respuesta = array('respuesta' => 'error', 'mensaje' => 'No hay datos para mostrar');
				}
				echo json_encode($respuesta);
			} else {
				echo 'No se permite el acceso de scripts';
			}
			
		}
		
		public function eliminar() {
			
			if ($this->input->is_ajax_request()) {
				
				$eliminarId = $this->input->post('eliminarId');
				
				//				$datos = array('eliminarId' => $eliminarId);
				if ($this->clientes_model->eliminar($eliminarId)) {
					
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
			if ($this->input->is_ajax_request()) {
				
				$editarId = $this->input->post('editarId');
				if ($datos = $this->clientes_model->editar($editarId)) {
					
					$data = array('respuesta' => 'success', 'post' => $datos);
					
				} else {
					$data = array('respuesta' => 'error', 'mensaje' => 'Error al mostrar los datos');
				}
				
				echo json_encode($data);
				
				
			} else {
				echo 'No se permite el acceso de scripts';
			}
			
		}
		
		public function actualizar() {
			if ($this->input->is_ajax_request()) {
				
				/* REGLAS PARA LA VALIDACION DE LOS INPUTS */
				$this->form_validation->set_rules('editarNombreCliente', 'Nombre del Cliente', 'required|callback_alpha_dash_space|trim', array('required' => 'El nombre del cliente es obligatorio', 'alpha_dash_space' => 'El nombre del cliente debe tener solo caracteres alfabéticos'));
				$this->form_validation->set_rules('editarApellidoCliente', 'Apellido del Cliente', 'required|callback_alpha_dash_space|trim', array
				('required' => '<br>' . 'El apellido del cliente es obligatorio', 'alpha_dash_space' => '<br>' . 'El apellido del cliente debe tener solo caracteres alfabéticos'));
				$this->form_validation->set_rules('editarTelefonoCliente', 'Telefono del Cliente', 'required|numeric', array
				('required' => '<br>' . 'El teléfono del cliente es obligatorio', 'numeric' => '<br>' . 'El teléfono del cliente debe tener solo numeros'));
				
				/* CONDICION SI NO SE EJECUTA LA VALIDACION */
				if ($this->form_validation->run() == FALSE) {
					
					/* MENSAJE CON EL ERROR SI NO SE EJECUTA LA VALIDACION */
					$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
					
				} else {
					
					/* ALMACENAR EN UNA VARIABLE LOS DATOS DE LOS INPUTS */
					
					$data['ID_Cliente'] = $this->input->post('editarIdCliente');
					$data['Nombre_Cliente'] = $this->input->post('editarNombreCliente');
					$data['Apellido_Cliente'] = $this->input->post('editarApellidoCliente');
					$data['Telefono_Cliente'] = $this->input->post('editarTelefonoCliente');
					
					
					/* ENVIAR OBTENER LOS DATOS DE LOS INPUTS DESDE Y HACIA LA BASE DE DATOS */
					if ($this->clientes_model->actualizar($data)) {
						
						/* MENSAJE AL INSERTAR CORRECTAMENTE */
						$data = array('respuesta' => 'success', 'mensaje' => 'El cliente ha sido editado exitosamente');
						
					} else {
						
						/* MENSAJE DE ERROR SI NO SE INSERTA CORRECTAMENTE */
						$data = array('respuesta' => 'error', 'mensaje' => 'El cliente no ha sido editado');
					}
					
				}
				echo json_encode($data);
			} else {
				echo 'No se permite el acceso de scripts';
			}
		}
	}
