<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Reportes extends CI_Controller {
		
		/* VISTA */
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
			$this->load->view('ordenes_trabajo/reportes');
			/* FOOTER */
			$this->load->view('layouts/footer');
			
		}
		
	}
