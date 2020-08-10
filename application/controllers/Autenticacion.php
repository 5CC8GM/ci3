<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Autenticacion extends CI_Controller {
		
		public function __construct() {
			
			parent::__construct();
			
			/* CARGA EL CONTENIDO DEL MODELO ADMIN_MODEL */
			$this->load->model('Admin_model');
		}
		
		public function index() {
			
			/* OBTENER EL VALOR DE LA VARIABLE DE SESION */
			if ($this->session->userdata('login')) {
				
				/* REDIRECCIONAR AL DASHBOARD */
				redirect(base_url() . 'dashboard');
				
			} else {
				
				/* SI NO EXISTE LA VARIABLE DE SESION REGRESA AL LOGIN */
				$this->load->view('admin/login');
				
			}
			
			
		}
		
		public function login() {
			
			/* ALMACENAR EN VARIABLES LOS DATOS OBTENIDOS EN EL INPUT */
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			/* ALMACENAR LOS DATOS DEL MODELO DEL EMAIL Y PASSWORD */
			$resultado = $this->Admin_model->login($email, sha1($password));
			
			/* SI LOS DATOS SON VERDADEROS CREAR VARIABLES DE SESION */
			if ($resultado) {
				
				/* VARIABLES DE SESION */
				$datos = array('id'       => $resultado->ID_Administrador,
							   'nombre'   => $resultado->Nombre_Administrador,
							   'apellido' => $resultado->Apellido_Administrador,
							   'login'    => true);
				
				/* ASIGNAR LOS DATOS A LA VARIABLE GLOBAL SESSION */
				$this->session->set_userdata($datos);
				
				/* REDIRECCIONAR AL DASHBOARD */
				redirect(base_url() . 'dashboard');
				
			} else {
				
				$this->session->set_flashdata('error', 'El email y/o constraseña son incorrectos');
				
				/* REDIRECCIONAR AL LOGIN */
				redirect(base_url());
				
			}
			
		}
		
		/* FUNCION PARA DESTRUIR LA SESION */
		public function cerrarSesion() {
			
			/* DESTRUIR LA SESION */
			$this->session->sess_destroy();
			
			/* REDIRECCIONAR AL LOGIN */
			redirect(base_url());
			
		}
		
	}
