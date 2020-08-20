<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Ploteo_model extends CI_Model {
		
		/* FUNCION PARA OBTENER TODOS LOS DOCUMENTOS DE LA BASE DE DATOS */
		public function getComprobantes() {
			
			$resultado = $this->db->get('tipo_documento');
			
			return $resultado->result();
			
		}
		
		/* FUNCION PARA OBTENER EL DOCUMENTO POR EL ID */
		public function getDocumento($idDocumento) {
			
			$this->db->where('ID_Documento', $idDocumento);
			
			$resultado = $this->db->get('tipo_documento');
			return $resultado->row();
			
		}
		
		/* OBTENER DOCUMENTOS POR ID */
		public function getFacturas($id) {
			
			return $this->db->get_where('tipo_documento', ['ID_Documento' => $id])->result();
			
		}
		
		/* ACTUALIZAR LA CANTIDAD DE DOCUMENTOS POR ID */
		public function actualizarDocumento($idDocumento, $data) {
			
			$this->db->where('ID_Documento', $idDocumento);
			$this->db->update('tipo_documento', $data);
			
		}
		
		/* CREAR ORDEN DE TRABAJO PLOTEO */
		public function crear($datosOtPloteo) {
			return $this->db->insert('ot_ploteo', $datosOtPloteo);
		}
		
		/* GUARDAR EL DETALLE DE LA ORDEN DE PLOTEO */
		public function guardarDetalleOTPloteo($datos) {
			
			$this->db->insert('detalle_otploteo', $datos);
			
		}
		
		/* OBTENER EL ULTIMO ID */
		public function ultimoId() {
			return $this->db->insert_id();
		}
		
		/* MOSTRAR ORDENES DE TRABAJO */
		public function mostrar() {
			
			$this->db->select('*');
			$this->db->from('ot_ploteo');
			$this->db->join('cliente', 'cliente.ID_Cliente = ot_ploteo.ID_Cliente');
			$this->db->join('tipo_documento', 'tipo_documento.ID_Documento = ot_ploteo.ID_Documento');
			$this->db->order_by('ID_OTPloteo', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
			
		}
		
		/* ELIMINAR ORDEN DE TRABAJO PLOTEO */
		public function eliminar($idPloteo) {
			
			return $this->db->delete('ot_ploteo', array('ID_OTPloteo' => $idPloteo));
			
		}
		
	}
