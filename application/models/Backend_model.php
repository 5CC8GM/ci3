<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Backend_model extends CI_Model {
		
		public function contarColumnas($tabla) {
			
			$resultado = $this->db->get($tabla);
			
			
			return $resultado->num_rows();
			
		}
		
		public function ingresosTotales() {
			$total = $this->db->select_sum('Total_OTPloteo')->where('Estado_OTPloteo', 1)->get('ot_ploteo')->row('Total_OTPloteo');
			$total2 = $this->db->select_sum('Total_OTServicioTecnico')->where('Estado_OTServicioTecnico', 1)->get('ot_servicio_tecnico')->row('Total_OTServicioTecnico');
			return number_format($total + $total2, 2);
		}
		
	}
