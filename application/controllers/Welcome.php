<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Welcome extends CI_Controller {
		
		public function index() {
			
			/* HEADER */
			$this->load->view('layouts/header');
			/* NAVBAR */
			$this->load->view('layouts/navbar');
			/* SIDEBAR */
			$this->load->view('layouts/sidebar');
			/* BREADCRUMB */
			$this->load->view('layouts/breadcrumb');
			/* CONTENIDO PRINCIPAL */
			$this->load->view('admin/dashboard');
			/* FOOTER */
			$this->load->view('layouts/footer');
			
		}
	}
