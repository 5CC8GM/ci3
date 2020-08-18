<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	/*
	| -------------------------------------------------------------------------
	| URI ROUTING
	| -------------------------------------------------------------------------
	| This file lets you re-map URI requests to specific controller functions.
	|
	| Typically there is a one-to-one relationship between a URL string
	| and its corresponding controller class/method. The segments in a
	| URL normally follow this pattern:
	|
	|	example.com/class/method/id/
	|
	| In some instances, however, you may want to remap this relationship
	| so that a different class/function is called than the one
	| corresponding to the URL.
	|
	| Please see the user guide for complete details:
	|
	|	https://codeigniter.com/user_guide/general/routing.html
	|
	| -------------------------------------------------------------------------
	| RESERVED ROUTES
	| -------------------------------------------------------------------------
	|
	| There are three reserved routes:
	|
	|	$route['default_controller'] = 'welcome';
	|
	| This route indicates which controller class should be loaded if the
	| URI contains no data. In the above example, the "welcome" class
	| would be loaded.
	|
	|	$route['404_override'] = 'errors/page_missing';
	|
	| This route will tell the Router which controller/method to use if those
	| provided in the URL cannot be matched to a valid route.
	|
	|	$route['translate_uri_dashes'] = FALSE;
	|
	| This is not exactly a route, but allows you to automatically route
	| controller and method names that contain dashes. '-' isn't a valid
	| class or method name character, so it requires translation.
	| When you set this option to TRUE, it will replace ALL dashes in the
	| controller and method URI segments.
	|
	| Examples:	my-controller/index	-> my_controller/index
	|		my-controller/my-method	-> my_controller/my_method
	*/
	$route['default_controller'] = 'autenticacion';
	$route['404_override'] = '';
	$route['translate_uri_dashes'] = FALSE;
	$route['/'] = 'clientes/index';
	$route['crear'] = 'clientes/crear';
	$route['mostrar'] = 'clientes/mostrar';
	$route['eliminar'] = 'clientes/eliminar';
	$route['editar'] = 'clientes/editar';
	$route['actualizar'] = 'clientes/actualizar';
	$route['/'] = 'dashboard/index';
	$route['getData'] = 'dashboard/getData';
	$route['servicio_tecnico'] = 'ordenes_trabajo/servicio_tecnico/index';
	$route['servicio_tecnico/crear'] = 'ordenes_trabajo/servicio_tecnico/crear';
	$route['servicio_tecnico/mostrar'] = 'ordenes_trabajo/servicio_tecnico/mostrar';
	$route['servicio_tecnico/eliminar'] = 'ordenes_trabajo/servicio_tecnico/eliminar';
	$route['servicio_tecnico/editar'] = 'ordenes_trabajo/servicio_tecnico/editar';
	$route['servicio_tecnico/actualizar'] = 'ordenes_trabajo/servicio_tecnico/actualizar';
	$route['servicio_tecnico/getFacturas'] = 'ordenes_trabajo/servicio_tecnico/getFacturas';
	$route['servicio_tecnico/invoice'] = 'ordenes_trabajo/servicio_tecnico/verOtServicioTecnico';
	$route['ploteo'] = 'ordenes_trabajo/ploteo/index';
	$route['ploteo/obtenerDocumentos'] = 'ordenes_trabajo/ploteo/obtenerDocumentos';
	$route['ploteo/crear'] = 'ordenes_trabajo/ploteo/crear';
	
