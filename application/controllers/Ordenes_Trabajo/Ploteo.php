<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Ploteo extends CI_Controller {
		
		/* FUNCION PARA PERMITIR MAS CARACTERES Y ESPACIOS */
		function alpha_dash_space($str) {
			return (!preg_match("/^([-a-z-ñ-Ñ_0-9, ])+$/i", $str)) ? FALSE : TRUE;
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
			$this->load->view('ordenes_trabajo/ploteo');
			/* FOOTER */
			$this->load->view('layouts/footer');
			
		}
	}
