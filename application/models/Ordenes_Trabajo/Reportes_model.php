<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes_model extends CI_Model
{
	/* MOSTRAR ORDEN DE TRABAJO SERVICIO TECNICO */
	public function mostrarServicioTecnico($fechaInicio, $fechaFin)
	{
		$this->db->select('*');
		$this->db->from('ot_servicio_tecnico');
		$this->db->join('cliente', 'cliente.ID_Cliente = ot_servicio_tecnico.ID_Cliente');
		$this->db->join('tipo_documento', 'tipo_documento.ID_Documento = ot_servicio_tecnico.ID_Documento');
		if ($fechaInicio != "" && $fechaFin != "") {
			$query = "Fecha_OTServicioTecnico >= '".$fechaInicio."' AND Fecha_OTServicioTecnico <= '".$fechaFin."'";
			$this->db->where($query);
		}
		$this->db->order_by('ID_OTServicioTecnico', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	/* MOSTRAR ORDENES DE TRABAJO PLOTEO */
	public function mostrarPloteo()
	{

		$this->db->select('*');
		$this->db->from('ot_ploteo');
		$this->db->join('cliente', 'cliente.ID_Cliente = ot_ploteo.ID_Cliente');
		$this->db->join('tipo_documento', 'tipo_documento.ID_Documento = ot_ploteo.ID_Documento');
		$this->db->order_by('ID_OTPloteo', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
}
