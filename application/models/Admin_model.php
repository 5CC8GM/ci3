<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Admin_model extends CI_Model {
		
		public function login($email, $password) {
			
			/* COMPARACION DE LOS DATOS OBTENIDOS DEL CONTROLADOR CON LOS DE LA BDD */
			$this->db->where('Email_Administrador', $email);
			$this->db->where('Password_Administrador', $password);
			
			/* ALMACENAR EN UNA VARIABLE LOS DATOS OBTENIDOS DE LA TABLA ADMINISTRADOR */
			$resultados = $this->db->get('administrador');
			
			/* SI EXISTEN COLUMNAS */
			if ($resultados->num_rows() > 0) {
				
				/* RETORNAR LA COLUMNA COMPARADA (EMAIL Y PASSWORD) */
				return $resultados->row();
				
			}
			
			/* SI NO EXISTEN COLUMNAS O COINCIDENCIAS RETORNA FALSO */
			return false;
			
		}
		
	}
