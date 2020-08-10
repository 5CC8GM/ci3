<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Backend_model extends CI_Model {
		
		public function contarColumnas($tabla) {
			
			$resultado = $this->db->get($tabla);
			
			
			return $resultado->num_rows();
			
		}
		
	}
