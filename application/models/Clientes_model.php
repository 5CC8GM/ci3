<?php
	
	class Clientes_model extends CI_Model {
		
		public function mostrar() {
			$query = $this->db->get('cliente');
			if (count($query->result()) > 0) {
				return $query->result_array();
			}
		}

		public function insertar($data) {
			
			return $this->db->insert('cliente', $data);
			
		}
		
		public function editar($id) {
			
			$this->db->select('*');
			$this->db->from('cliente');
			$this->db->where('ID_Cliente', $id);
			
			$consulta = $this->db->get();
			
			if (count($consulta->result()) > 0) {
				
				return $consulta->row();
				
			}
			
			
		}
		
		public function eliminar($id) {
			
			return $this->db->delete('cliente', array('ID_Cliente' => $id));
			
		}
		
		public function actualizar($data) {
			
			return $this->db->update('cliente', $data, array('ID_Cliente' => $data['ID_Cliente']));
		}
		
	}
