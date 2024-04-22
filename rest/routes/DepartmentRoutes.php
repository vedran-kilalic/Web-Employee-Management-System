<?php
Flight::route('GET /departments', function(){
    Flight::json(Flight::departmentService()->get_all_departments());
});

Flight::route('GET /departments/@id', function($id){
    Flight::json(Flight::departmentService()->get_department_by_id($id));
});



Flight::route('GET /departments/by_name/@name', function($name){
    Flight::json(Flight::departmentService()->get_department_by_name($name));
});


Flight::route('POST /departments', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::departmentService()->add($data));
    Flight::json(["message" => "created"]);
});


Flight::route('PUT /departments/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::departmentService()->update($id, $data);
    Flight::json(["message" => "updated"]);
});



Flight::route('DELETE /departments/@id', function($id){
    Flight::departmentService()->delete($id);
    Flight::json(["message" => "deleted"]);
});

?>
