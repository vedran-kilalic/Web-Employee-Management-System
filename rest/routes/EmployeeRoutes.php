<?php

Flight::route('GET /employees', function(){
    Flight::json(Flight::employeeService()->get_all_employees());
});

Flight::route('GET /employees/@id', function($id){
    Flight::json(Flight::employeeService()->get_employee_by_id($id));
});


Flight::route('GET /employees/by_name/@name', function($name){
    Flight::json(Flight::employeeService()->get_employee_by_name($name));
});

Flight::route('POST /employees', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::employeeService()->add($data));
    Flight::json(["message" => "created"]);
});

Flight::route('PUT /employees/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::employeeService()->update($id, $data);
    Flight::json(["message" => "updated"]);
});


Flight::route('DELETE /employees/@id', function($id){
    Flight::employeeService()->delete($id);
    Flight::json(["message" => "deleted"]);
});

?>
