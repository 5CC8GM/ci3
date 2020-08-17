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
		
		public function index() {
			
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
			$this->load->view('ordenes_trabajo/ploteo', $data);
			/* FOOTER */
			$this->load->view('layouts/footer');
			
		}
	}
