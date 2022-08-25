<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
// $route['default_controller'] = 'welcome';
$route['default_controller'] = 'Controller_crud';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['salir'] = 'Controller_crud/salir';
$route['index'] = 'Controller_crud/index';
$route['login'] = 'Controller_crud/login';
$route['adminInicio'] = 'Controller_crud/adminInicio';

$route['adminUsuario'] = 'Controller_crud/adminUsuario';
$route['nuevoUsuario'] = 'Controller_crud/nuevoUsuario';
$route['buscar_persona'] = 'Controller_crud/buscar_persona';
$route['guardar_datos_usuario_nuevo'] = 'Controller_crud/guardar_datos_usuario_nuevo';
$route['buscar_usuario'] = 'Controller_crud/buscar_usuario';
$route['cambiar_estado'] = 'Controller_crud/cambiar_estado';
$route['cambiar_eliminar'] = 'Controller_crud/cambiar_eliminar';
$route['editarUsuario/(:any)'] = 'Controller_crud/editarUsuario/$1';
$route['guardar_datos_usuario_editar'] = 'Controller_crud/guardar_datos_usuario_editar';


$route['grafico'] = 'Controller_crud/grafico';
$route['graficos_valor'] = 'Controller_crud/graficos_valor';

$route['reportePdf'] = 'Controller_reportes_pdf/reportePdf';
$route['reporteExcel'] = 'Controller_reportes_pdf/reporteExcel';
