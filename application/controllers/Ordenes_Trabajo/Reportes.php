<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Reportes extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('ordenes_trabajo/reportes_model');
		}
		/* VISTA */
		public function index() {
			
			/* CARGA DE ELEMENTOS DEL LAYOUT */
			/* HEADER */
			$this->load->view('layouts/header');
			/* NAVBAR */
			$this->load->view('layouts/navbar');
			/* SIDEBAR */
			$this->load->view('layouts/sidebar');
			/* BREADCRUMB */
			$this->load->view('layouts/breadcrumb');
			/* CONTENIDO PRINCIPAL */
			$this->load->view('ordenes_trabajo/reportes');
			/* FOOTER */
			$this->load->view('layouts/footer');
			
		}
		
		/* MOSTRAR ORDENES DE TRABAJO */
		public function mostrarServicioTecnico() {
			$fechaInicio= $_GET['fechaInicio'];
			$fechaFin = $_GET['fechaFin'];
			$resultadoList = $this->reportes_model->mostrarServicioTecnico();
			$resultado = array();
			$i = 1;
			
			if (!empty($resultadoList)) {
				
				foreach ($resultadoList as $key => $value) {
					
					$fecha = $value['Fecha_OTServicioTecnico'];
					setlocale(LC_ALL, 'spanish');
					$fechaNueva = strftime("%d de %B de %Y a las %H:%M:%S", strtotime($fecha));
					
					$nombreApellido = $value['Nombre_Cliente'] . ' ' . $value['Apellido_Cliente'];
				//	if ($value['Estado_OTServicioTecnico'] == '1') {
						$estado = '<span class="badge badge-primary">Vigente</span>';
				//	} else {
				//		$estado = '<span class="badge badge-danger">Anulada</span>';
				//	}
					
					/* CREACION DEL SELECTOR DENTRO DE LA TABLA PARA CAMBIAR SU ESTADO POSTERIORMENTE */
					$estadoDocumento = $estado;
					$acciones = '<div class="list-icons"><a href="#" id="verReporteOtServicioTecnico" value="' .
						$value['ID_OTServicioTecnico'] . '" class="btn btn-primary btn-icon" type="button"><i class="icon-info22"></i></a>';
					$total = '$' . $value['Total_OTServicioTecnico'];
					$resultado['data'][] = array(
						
						$i++,
						$nombreApellido,
						$value['Nombre_Documento'],
						$estado,
						$value['NumeroDocumento_OTServicioTecnico'],
						$value['Descripcion_OTServicioTecnico'],
						$fechaNueva,
						$total,
						$acciones
					
					);
				}
				
			} else {
				$resultado['data'] = array();
			}
			
			echo json_encode($resultado);
			
		}
		
		/* MOSTRAR ORDENES DE TRABAJO PLOTEO */
		public function mostrarPloteo() {
			
			$resultadoDb = $this->reportes_model->mostrarPloteo();
			$resultado = array();
			$i = 1;
			
			if (!empty($resultadoDb)) {
				
				foreach ($resultadoDb as $key => $value) {
					$fecha = $value['Fecha_OTPloteo'];
					setlocale(LC_ALL, 'spanish');
					$fechaNueva = strftime("%d de %B de %Y a las %H:%M:%S", strtotime($fecha));
					$nombreApellido = $value['Nombre_Cliente'] . ' ' . $value['Apellido_Cliente'];
					//if ($value['Estado_OTPloteo'] == '1') {
						$estado = '<span class="badge badge-primary">Vigente</span>';
					//} else {
					//	$estado = '<span class="badge badge-danger">Anulada</span>';
					//}
					
					/* CREACION DEL SELECTOR DENTRO DE LA TABLA PARA CAMBIAR SU ESTADO POSTERIORMENTE */
					$estadoDocumentPloteo = $estado;
					$acciones = '<div class="list-icons"><a href="#" id="verReporteOtPloteo" value="' .
						$value['ID_OTPloteo'] . '" class="btn btn-primary btn-icon" type="button"><i class="icon-info22"></i></a>';
					$total = '$' . $value['Total_OTPloteo'];
					$resultado['data'][] = array(
						$i++,
						$nombreApellido,
						$value['Nombre_Documento'],
						$estadoDocumentPloteo,
						$value['NumeroDocumento_OTPloteo'],
						$fechaNueva,
						$total,
						$acciones
					);
					
				}
				
			} else {
				$resultado['data'] = array();
			}
			
			echo json_encode($resultado);
			
		}
		
	}
