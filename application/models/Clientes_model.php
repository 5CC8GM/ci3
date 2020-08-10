<?php
	
	class Clientes_model extends CI_Model {
		
		public function mostrar() {
			$query = $this->db->get('cliente');
			if (count($query->result()) > 0) {
				return $query->result();
			}
		}

//		var $table         = "cliente";
//		var $select_column = array("ID_Cliente", "Nombre_Cliente", "Apellido_Cliente", "Telefono_Cliente");
//		var $order_column  = array(null, "Nombre_Cliente", "Apellido_Cliente", "Telefono_Cliente", null);
//
//		function make_query() {
//			$this->db->select($this->select_column);
//			$this->db->from($this->table);
//			if (isset($_POST["search"]["value"])) {
//				$this->db->like("Nombre_Cliente", $_POST["search"]["value"]);
//				$this->db->or_like("Apellido_Cliente", $_POST["search"]["value"]);
//				$this->db->or_like("Telefono_Cliente", $_POST["search"]["value"]);
//			}
//			if (isset($_POST["order"])) {
//				$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
//			} else {
//				$this->db->order_by('ID_Cliente', 'ASC');
//			}
//		}
//
//		function make_datatables() {
//			$this->make_query();
//			if ($_POST["length"] != -1) {
//				$this->db->limit($_POST['length'], $_POST['start']);
//			}
//			$query = $this->db->get();
//			return $query->result();
//		}
//
//		function get_filtered_data() {
//			$this->make_query();
//			$query = $this->db->get();
//			return $query->num_rows();
//		}
//
//		function get_all_data() {
//			$this->db->select("*");
//			$this->db->from($this->table);
//			return $this->db->count_all_results();
//		}
//
		
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
