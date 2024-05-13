<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/services/DepartmentService.class.php';
require_once __DIR__.'/services/EmployeeService.class.php';
require_once __DIR__.'/services/PayrollService.class.php';
require_once __DIR__.'/services/AttendanceService.class.php';

Flight::register('attendanceService', 'AttendanceService');
Flight::register('payrollService', 'PayrollService');
Flight::register('departmentService', 'DepartmentService');
Flight::register('employeeService', 'EmployeeService');

Flight::route('GET /docs.json', function(){
  $openapi = \OpenApi\scan('routes');
  header('Content-Type: application/json');
  echo $openapi->toJson();
});

require_once __DIR__.'/routes/AttendanceRoutes.php';
require_once __DIR__.'/routes/DepartmentRoutes.php';
require_once __DIR__.'/routes/PayrollRoutes.php';
require_once __DIR__.'/routes/EmployeeRoutes.php';

Flight::start();
?>