<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Reportes_model extends CI_Model {
		/* MOSTRAR ORDEN DE TRABAJO SERVICIO TECNICO */
		public function mostrarServicioTecnico() {
			$this->db->select('*');
			$this->db->from('ot_servicio_tecnico');
			$this->db->join('cliente', 'cliente.ID_Cliente = ot_servicio_tecnico.ID_Cliente');
			$this->db->join('tipo_documento', 'tipo_documento.ID_Documento = ot_servicio_tecnico.ID_Documento');
			$this->db->order_by('ID_OTServicioTecnico', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
		}
	}
