<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Ploteo_model extends CI_Model {
		
		/* FUNCION PARA OBTENER TODOS LOS DOCUMENTOS DE LA BASE DE DATOS */
		public function getComprobantes() {
			
			$resultado = $this->db->get('tipo_documento');
			
			return $resultado->result();
			
		}
		
		/* OBTENER DOCUMENTOS POR ID */
		public function getFacturas($id) {
			
			return $this->db->get_where('tipo_documento', ['ID_Documento' => $id])->result();
			
		}
		
		/* CREAR ORDEN DE TRABAJO SERVICIO TECNICO */
		public function crear($datosOtPloteo) {
			return $this->db->insert('ot_ploteo', $datosOtPloteo);
		}
		
		/* OBTENER EL ULTIMO ID */
		public function ultimoId() {
			return $this->db->insert_id();
		}
		
	}
