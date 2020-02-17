<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'Index';

$route['check/list'] = 'CheckDomain/index';
$route['check/add'] = 'CheckDomain/add';
$route['check/update_process'] = 'CheckDomain/update_process';
$route['check/edit/(:any)'] = 'CheckDomain/edit/$1';
$route['check/update_status'] = 'CheckDomain/update_status';
$route['check/delete'] = 'CheckDomain/delete';

$route['analysis/list'] = 'BatchAnalysis/index';
$route['analysis/add'] = 'BatchAnalysis/add';
$route['analysis/update_process'] = 'BatchAnalysis/update_process';
$route['analysis/edit/(:any)'] = 'BatchAnalysis/edit/$1';
$route['analysis/update_status'] = 'BatchAnalysis/update_status';
$route['analysis/delete'] = 'BatchAnalysis/delete';
$route['analysis/proxy_test']='BatchAnalysis/proxy_test';

$route['export/list'] = 'ExportData/index';
$route['export/add'] = 'ExportData/add';
$route['export/update_process'] = 'ExportData/update_process';
$route['export/edit/(:any)'] = 'ExportData/edit/$1';
$route['export/update_status'] = 'ExportData/update_status';
$route['export/delete'] = 'ExportData/delete';

$route['settings'] = 'Settings';