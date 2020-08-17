<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Ploteo_model extends CI_Model {
		
		/* FUNCION PARA OBTENER TODOS LOS DOCUMENTOS DE LA BASE DE DATOS */
		public function getComprobantes() {
			
			$resultado = $this->db->get('tipo_documento');
			
			return $resultado->result();
			
		}
		
	}
