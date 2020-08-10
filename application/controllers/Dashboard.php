<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Dashboard extends CI_Controller {
		
		public function __construct() {
			
			parent::__construct();
			/* CARGA EL CONTENIDO DEL MODELO ADMIN_MODEL */
			$this->load->model('Backend_model');
			$this->load->model('Ordenes_Trabajo/Servicio_tecnico_model');
			
			/* COMPROBAR LA VARIABLE DE SESION LOGIN */
			if (!$this->session->userdata('login')) {
				
				/* SI ES FALSA REDIRECCIONAR AL LOGIN */
				redirect(base_url());
				
			}
			
		}
		
		public function index() {
			
			$data = array('cantidadVentasServicioTecnico' => $this->Backend_model->contarColumnas('ot_servicio_tecnico'),
						  'cantidadClientes'              => $this->Backend_model->contarColumnas('cliente'),
						  'years'                         => $this->Servicio_tecnico_model->years());
			
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
			$this->load->view('admin/dashboard', $data);
			/* FOOTER */
			$this->load->view('layouts/footer');
			
		}
		
		public function getData() {
			
			$year = $this->input->post('year');
			$resultados = $this->Servicio_tecnico_model->montos($year);
			
			echo json_encode($resultados);
			
		}
	}
