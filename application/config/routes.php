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
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['positions'] = 'positions/Department';
$route['secretariat'] = 'AdminInfra/ajax_list';

/* Admin Module */


$route['district_admin'] = 'Governance/district';
$route['officers'] = 'Governance/secretariat';
$route['infra_secretariat'] = 'AdminInfra/infra';
$route['infra_directorate'] = 'AdminInfra/directorate';
$route['infra_district'] = 'AdminInfra/district';
$route['report_eoffice'] = 'Report/report_eoffice';
$route['file_pendency'] = 'Report/filependency';
$route['receipt_pendency'] = 'Report/receiptpendency';
$route['courses'] = 'Trainings/course1';
$route['trainings'] = 'Trainings/trainings';
$route['programmes'] = 'Add/filter';
$route['users'] = 'Governance/user';
$route['department'] = 'Trainings/dept1';
$route['directorate'] = 'Organization/directorate1';
$route['district'] = 'Trainings/district';
$route['spoffice'] = 'Trainings/spoffice';
$route['designation'] = 'Trainings/designation';
$route['venue'] = 'Trainings/venue';
$route['profile'] = 'Dashboard/profile';
$route['emdreport'] = 'Report/emdreport';
$route['dept_home'] = 'Dashboard/dept_home';
$route['report_eoffice_departmental'] = 'Report/report_eoffice';
$route['report_eoffice_directorate'] = 'Report/report_directorate';
$route['report_directorate'] = 'Report/report_directorate';
$route['report_district'] = 'Report/report_district';
$route['participants_add'] = 'Trainings/participants';
$route['infra_office'] = 'AdminInfra/office';
$route['infra_spoffice'] = 'AdminInfra/spoffice';
$route['overall'] = 'AdminInfra/overall';
$route['programmes1'] = 'Add/filter1';






/* User Module */

$route['home'] = 'Organization/home';
$route['officials'] = 'Organization/secretariat';
$route['directorates'] = 'Organization/directorate';
$route['districts'] = 'Organization/district';
$route['login'] = 'Login/login';
$route['training'] = 'Trainings/home';
$route['upcomingtrainings'] = 'Training_filter/upcoming';
$route['participants'] = 'Training_filter/participants';
$route['calendar'] = 'Calendar/calendar';
$route['report'] = 'Report/filter';
$route['file'] = 'Report/filter1';

$route['receipt'] = 'Report/filter2';
$route['admin_home'] = 'dashboard/home';
$route['admin'] = 'dashboard/admin';
$route['course'] = 'trainings/course';
$route['dept'] = 'trainings/dept';
$route['infrasecretariat'] = 'Infra/filterinfra';
$route['infradirectorate'] = 'Infra/filterDirectorate';
$route['infradistrict'] = 'Infra/filterDistrict';



