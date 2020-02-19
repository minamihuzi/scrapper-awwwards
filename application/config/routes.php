<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'Index';

$route['export/list'] = 'ExportData/index';
$route['export/add'] = 'ExportData/add';
$route['export/mark'] = 'ExportData/mark';
$route['export/update_process'] = 'ExportData/update_process';
$route['export/update_mark'] = 'ExportData/update_mark';
$route['export/edit/(:any)'] = 'ExportData/edit/$1';
$route['export/update_status'] = 'ExportData/update_status';
$route['export/delete'] = 'ExportData/delete';

$route['settings'] = 'Settings';