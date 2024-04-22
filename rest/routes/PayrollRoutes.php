<?php
Flight::route('GET /payroll', function(){
    Flight::json(Flight::payrollService()->get_all_payrolls());
});

Flight::route('GET /payrollById/@id', function($id){
    Flight::json(Flight::payrollService()->get_payroll_by_id($id));
});


Flight::route('GET /payroll/by_employee_id/@employee_id', function($employee_id){
    Flight::json(Flight::payrollService()->get_payroll_by_name($name));
});

Flight::route('POST /payroll', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::payrollService()->add($data));
    Flight::json(["message" => "created"]);
});

Flight::route('PUT /payroll/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::payrollService()->update($id, $data);
    Flight::json(["message" => "updated"]);
});


Flight::route('DELETE /payroll/@id', function($id){
    Flight::payrollService()->delete($id);
    Flight::json(["message" => "deleted"]);
});

?>
