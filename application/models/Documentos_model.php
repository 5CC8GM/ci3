<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Documentos_model extends CI_Model {
		
		public function getDocumentos() {
			
			$resultados = $this->db->get('tipo_documento');
			
			return $resultados->result();
			
		}
		
		
	}
