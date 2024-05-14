<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); 
}

/**
 * @OA\Get(
 *      path="/attendance",
 *      tags={"attendance"},
 *      summary="Get attendance",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all attendance in the databases"
 *      )
 * )
 */

Flight::route('GET /attendance', function(){
    Flight::json(Flight::attendanceService()->get_attendance());
});
 /**
     * @OA\Get(
     *      path="/attendance/{attendance_id}",
     *      tags={"attendance"},
     *      summary="Get attendance by id",
     *      @OA\Response(
     *           response=200,
     *           description="Attendance data, or false if employee does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="attendance_id", example="1", description="Atttendance ID")
     * )
     */
Flight::route('GET /attendance/@id', function($id){
    Flight::json(Flight::attendanceService()->get_attendance_by_id($id));
});


Flight::route('GET /attendance/by_status/@status', function($status){
    Flight::json(Flight::attendanceService()->get_attendance_by_status($status));
});


    /**
     * @OA\Post(
     *      path="/attendance",
     *      tags={"attendance"},
     *      summary="Add attendance data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Attendance data, or exception if patient is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Attendance data payload",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="string", example="1", description="Attendance ID"),
     *              @OA\Property(property="employee_id", type="string", example="Some id", description="Employee id"),
     *              @OA\Property(property="date", type="string", example="Some date", description="Attendance date"),
     *              @OA\Property(property="time_in", type="string", example="Some time_n", description="Attendance time in"),
     *              @OA\Property(property="time_out", type="string", example="some time out", description="Attendance time out"),
     *              @OA\Property(property="status", type="string",description="Attendance status")
     *          )
     *      )
     * )
     */

Flight::route('POST /attendance', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::attendanceService()->add($data));
    Flight::json(["message" => "created"]);
});

    /**
     * @OA\Post(
     *      path="/attendance",
     *      tags={"attendance"},
     *      summary="Add attendance data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Attendance data, or exception if patient is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Employee data payload",
     *          @OA\JsonContent(
     *                 @OA\Property(property="id", type="string", example="1", description="Attendance ID"),
     *              @OA\Property(property="employee_id", type="string", example="Some id", description="Employee id"),
     *              @OA\Property(property="date", type="string", example="Some date", description="Attendance date"),
     *              @OA\Property(property="time_in", type="string", example="Some time_n", description="Attendance time in"),
     *              @OA\Property(property="time_out", type="string", example="some time out", description="Attendance time out"),
     *              @OA\Property(property="status", type="string",description="Attendance status")
     *          )
     *      )
     * )
     */
    Flight::route('POST /employees', function(){
        $data = Flight::request()->data->getData();
        Flight::json(Flight::employeeService()->add($data));
        Flight::json(["message" => "created"]);
    });
    
   /**
 * @OA\Put(
 *      path="/attendance/{attendance_id}",
 *      tags={"attendance"},
 *      summary="Update existing employee data in the database",
 *      @OA\Parameter(
 *          name="attendance_id",
 *          in="path",
 *          required=true,
 *          description="The ID of the attendance to update",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Success message and updated attendance data"
 *      ),
 *      @OA\Response(
 *           response=404,
 *           description="Not Found if no attendance found with the given ID"
 *      ),
 *      @OA\RequestBody(
 *          description="Attendance data payload to update",
 *          required=true,
     *          @OA\JsonContent(
     *              required={"name", "email"},
     *              @OA\Property(property="name", type="string", example="John Doe", description="Full name of the employee"),
     *              @OA\Property(property="job_title", type="string", example="Developer", description="Job title of the employee"),
     *              @OA\Property(property="department_id", type="integer", example=2, description="Department ID"),
     *              @OA\Property(property="email", type="string", example="john.doe@example.com", description="Email address of the employee"),
     *              @OA\Property(property="phone_number", type="string", example="1234567890", description="Phone number of the employee"),
     *              @OA\Property(property="hire_date", type="string", format="date", example="2023-01-01", description="Hire date of the employee"),
     *              @OA\Property(property="salary", type="number", format="float", example=50000.50, description="Salary of the employee"),
     *              @OA\Property(property="admin", type="boolean", example=true, description="Whether the employee has admin rights")
     *          )
     *      )
     * )
     */

Flight::route('PUT /attendance/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::attendanceService()->update($id, $data);
    Flight::json(["message" => "updated"]);
});


 /**
     * @OA\Delete(
     *      path="/attendance/{attendance_id}",
     *      tags={"attendance"},
     *      summary="Delete attendance by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted attendance data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="attendance_id", example="1", description="Attendance ID")
     * )
     */
Flight::route('DELETE /attendance/@id', function($id){
    Flight::attendanceService()->delete($id);
    Flight::json(["message" => "deleted"]);
});

?>
