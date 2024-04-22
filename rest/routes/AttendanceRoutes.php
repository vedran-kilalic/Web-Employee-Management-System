<?php
Flight::route('GET /attendance', function(){
    Flight::json(Flight::attendanceService()->get_attendance());
});

Flight::route('GET /attendance/@id', function($id){
    Flight::json(Flight::attendanceService()->get_attendance_by_id($id));
});


Flight::route('GET /attendance/by_status/@status', function($status){
    Flight::json(Flight::attendanceService()->get_attendance_by_status($status));
});

Flight::route('POST /attendance', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::attendanceService()->add($data));
    Flight::json(["message" => "created"]);
});

Flight::route('PUT /attendance/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::attendanceService()->update($id, $data);
    Flight::json(["message" => "updated"]);
});

Flight::route('DELETE /attendance/@id', function($id){
    Flight::attendanceService()->delete($id);
    Flight::json(["message" => "deleted"]);
});

?>
