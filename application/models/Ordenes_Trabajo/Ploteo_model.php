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
		
		/* EDITAR ORDEN DE TRABAJO PLOTEO */
		public function editar($idEditarOtPloteo) {
			
			$this->db->select('*');
			$this->db->from('ot_ploteo');
			$this->db->join('cliente', 'cliente.ID_Cliente = ot_ploteo.ID_Cliente');
			$this->db->join('tipo_documento', 'ot_ploteo.ID_Documento = tipo_documento.ID_Documento');
			$this->db->join('detalle_otploteo', 'detalle_otploteo.ID_OTPloteo = ot_ploteo.ID_OTPloteo');
			$this->db->where('ot_ploteo.ID_OTPloteo', $idEditarOtPloteo);
			$this->db->order_by('ot_ploteo.ID_OTPloteo', 'ASC');
			
			$respuesta = $this->db->get();
			
			if (count($respuesta->result()) > 0) {
				
				return $respuesta->row();
				
			}
			
		}
		
		public function editarOtDetallePloteo($idEditarOtPloteo) {
			
			$this->db->select('*');
			$this->db->from('detalle_otploteo');
			$this->db->where('detalle_otploteo.ID_OTPloteo', $idEditarOtPloteo);
			
			$respuesta = $this->db->get();
			
			if (count($respuesta->result()) > 0) {
				
				return $respuesta->result();
				
			}
			
		}
		
		public function actualizar($datos) {
			
			return $this->db->update('ot_ploteo', $datos, array('ID_OTPloteo' => $datos['ID_OTPloteo']));
			
		}
		
		public function editarDetalleOtPloteo() {
			$id = $this->input->post('editarIdDetalleOTPloteo');
			$precio = $this->input->post('metrosPloteo');
			$importe = $this->input->post('importePloteo');
			
			$actualizarArray = array();
			
			for ($i = 0; $i < sizeof($id); $i++) {
				
				$actualizarArray[] = array(
					'ID_DetalleOTPloteo' => $id[$i],
					'Precio_OTPloteo'    => $precio[$i],
					'Importe_OTPloteo'   => $importe[$i],
				);
				
			}
			
			return $this->db->update_batch('detalle_otploteo', $actualizarArray, 'ID_DetalleOTPloteo');
			
			
		}
		
		public function idAEliminar($ids) {
			$this->db->where_in('ID_DetalleOTPloteo', $ids);
			return $this->db->delete('detalle_otploteo');
			
			
		}
		
		public function yearsPloteo() {
			$this->db->select('YEAR(Fecha_OTPloteo) as yearPloteo');
			$this->db->from('ot_ploteo');
			$this->db->group_by('yearPloteo');
			$this->db->order_by('yearPloteo', 'desc');
			
			$resultados = $this->db->get();
			
			return $resultados->result();
		}
		
		public function montos($year) {
			
			$this->db->select('MONTH(Fecha_OTPloteo) as mesPloteo, SUM(Total_OTPloteo) as montoPloteo');
			$this->db->from('ot_ploteo');
			$this->db->where('Fecha_OTPloteo >=', $year . '-01-01');
			$this->db->where('Fecha_OTPloteo <=', $year . '-12-31');
			$this->db->group_by('mesPloteo');
			$this->db->order_by('mesPloteo');
			
			$resultados = $this->db->get();
			
			return $resultados->result();
		}

		public function getOtPloteo($id)
		{

			$this->db->select('*');
			$this->db->from('ot_ploteo');
			$this->db->join('cliente', 'cliente.ID_Cliente = ot_ploteo.ID_Cliente');
			$this->db->join('tipo_documento', 'tipo_documento.ID_Documento = ot_ploteo.ID_Documento');
			$this->db->where('ID_OTPloteo', $id);

			$resultado = $this->db->get();

			return $resultado->row();

		}

		public function getDetalle($id) {

			$this->db->select('*');
			$this->db->from('detalle_otploteo');
			$this->db->where('ID_OTPloteo', $id);

			$resultado = $this->db->get();

			return $resultado->result();

		}

	}
