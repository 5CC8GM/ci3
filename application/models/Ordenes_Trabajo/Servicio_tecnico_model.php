<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Servicio_tecnico_model extends CI_Model {
		
		/* MOSTRAR ORDEN DE TRABAJO SERVICIO TECNICO */
		public function mostrar() {
			$this->db->select('*');
			$this->db->from('ot_servicio_tecnico');
			$this->db->join('cliente', 'cliente.ID_Cliente = ot_servicio_tecnico.ID_Cliente');
			$this->db->join('tipo_documento', 'tipo_documento.ID_Documento = ot_servicio_tecnico.ID_Documento');
			$this->db->order_by('ID_OTServicioTecnico', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
		}
		
		/* INSERTAR ORDER DE TRABAJO SERVICIO TECNICO */
		public function insertar($data) {
			
			return $this->db->insert('ot_servicio_tecnico', $data);
			
		}
		
		public function lastId() {
			return $this->db->insert_id();
		}
		
		public function getComprobantes() {
			
			$resultado = $this->db->get('tipo_documento');
			
			return $resultado->result();
			
		}
		
		public function getFacts($search) {
			
			$this->db->select('*');
			$this->db->from('tipo_documento');
			$this->db->like('Nombre_Documento', $search);
			
			return $this->db->get()->result_array();
			
		}
		
		public function getFacturas($id) {
			
			return $this->db->get_where('tipo_documento', ['ID_Documento' => $id])->result();
			
		}
		
		public function getComprobante($idDocumento) {
			
			$this->db->where('ID_Documento', $idDocumento);
			
			$resultado = $this->db->get('tipo_documento');
			return $resultado->row();
		}
		
		public function getVenta($id) {
			
			$this->db->select('*');
			$this->db->from('ot_servicio_tecnico');
			$this->db->join('cliente', 'cliente.ID_Cliente = ot_servicio_tecnico.ID_Cliente');
			$this->db->join('tipo_documento', 'tipo_documento.ID_Documento = ot_servicio_tecnico.ID_Documento');
			$this->db->where('ID_OTServicioTecnico', $id);
			
			$resultado = $this->db->get();
			
			return $resultado->row();
			
		}
		
		public function updateComprobante($idDocumento, $data) {
			
			$this->db->where('ID_Documento', $idDocumento);
			$this->db->update('tipo_documento', $data);
			
		}
		
		public function eliminar($id) {
			
			return $this->db->delete('ot_servicio_tecnico', array('ID_OTServicioTecnico' => $id));
			
		}
		
		public function editar($id) {
			
			$this->db->select('*');
			$this->db->from('ot_servicio_tecnico');
			$this->db->join('cliente', 'cliente.ID_Cliente = ot_servicio_tecnico.ID_Cliente');
			$this->db->join('tipo_documento', 'ot_servicio_tecnico.ID_Documento = tipo_documento.ID_Documento');
			$this->db->where('ot_servicio_tecnico.ID_OTServicioTecnico', $id);
			$this->db->order_by('ot_servicio_tecnico.ID_OTServicioTecnico', 'ASC');
			$consulta = $this->db->get();
			
			if (count($consulta->result()) > 0) {
				
				return $consulta->row();
				
			}
			
		}
		
		public function actualizar($data) {
			
			return $this->db->update('ot_servicio_tecnico', $data, array('ID_OTServicioTecnico' => $data['ID_OTServicioTecnico']));
			
		}
		
		public function years() {
		
//			$this->db->select('YEAR(Fecha_OTServicioTecnico) as year');
//			$this->db->from('ot_servicio_tecnico');
//			$this->db->group_by('year');
//			$this->db->order_by('year', 'desc');
			$sql = "SELECT year
					FROM (SELECT YEAR(Fecha_OTPloteo) year FROM ot_ploteo op group by 1) c1
							 LEFT JOIN (SELECT YEAR(Fecha_OTServicioTecnico) year FROM ot_servicio_tecnico ost group by 1) c2 using (year)
					UNION
					SELECT year
					FROM (
							 SELECT YEAR(Fecha_OTPloteo) year
							 FROM ot_ploteo op
							 group by 1
						 ) c1
							 RIGHT JOIN (
						SELECT YEAR(Fecha_OTServicioTecnico) year FROM ot_servicio_tecnico ost group by 1
					) c2 using (year) order by year desc ";
			$resultados = $this->db->query($sql);
			
			return $resultados->result();
			
			
			
		}
		
		public function montos($year) {
			$sql = "SELECT mes, totalPloteo, totalSt
					FROM (
							 SELECT MONTH(Fecha_OTPloteo) mes,
									SUM(Total_OTPloteo)   totalPloteo
							 FROM ot_ploteo
							 WHERE Fecha_OTPloteo BETWEEN '$year-01-01' AND '$year-12-31'
							 GROUP BY 1
						 ) c1
							 LEFT JOIN (
						SELECT MONTH(Fecha_OTServicioTecnico) mes,
							   SUM(Total_OTServicioTecnico)   totalSt
						FROM ot_servicio_tecnico
						WHERE Fecha_OTServicioTecnico BETWEEN '$year-01-01' AND '$year-12-31'
						GROUP BY 1
					) c2 USING (mes)
					UNION
					SELECT mes, totalPloteo, totalSt
					FROM (
							 SELECT MONTH(Fecha_OTPloteo) mes,
									SUM(Total_OTPloteo)   totalPloteo
							 FROM ot_ploteo
							 WHERE Fecha_OTPloteo BETWEEN '$year-01-01' AND '$year-12-31'
							 GROUP BY 1
						 ) c1
							 RIGHT JOIN (
						SELECT MONTH(Fecha_OTServicioTecnico) mes,
							   SUM(Total_OTServicioTecnico)   totalSt
						FROM ot_servicio_tecnico
						WHERE Fecha_OTServicioTecnico BETWEEN '$year-01-01' AND '$year-12-31'
						GROUP BY 1
					) c2 USING (mes)";
			
			$resultados = $this->db->query($sql);
			return $resultados->result();
//			echo $this->db->get_compiled_select($sql);
		}
		
	}
