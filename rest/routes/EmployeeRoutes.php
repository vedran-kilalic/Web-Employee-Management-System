<?php
   

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 86400");


    require_once __DIR__ . '/../services/EmployeeService.class.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set('employee_service', new EmployeeService());
/**
 * @OA\Get(
 *      path="/employees",
 *      tags={"employees"},
 *      summary="Get all employees",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all employees in the databases"
 *      )
 * )
 */
Flight::route('GET /employees', function(){
    Flight::json(Flight::employeeService()->get_all_employees());
});

   /**
     * @OA\Get(
     *      path="/employees/{employee_id}",
     *      tags={"employees"},
     *      summary="Get employee by id",
     *      @OA\Response(
     *           response=200,
     *           description="Employee data, or false if employee does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="employee_id", example="1", description="EMPLOYEE ID")
     * )
     */
Flight::route('GET /employees/@id', function($id){
    Flight::json(Flight::employeeService()->get_employee_by_id($id));
});


Flight::route('GET /employees/by_name/@name', function($name){
    Flight::json(Flight::employeeService()->get_employee_by_name($name));
});

    /**
     * @OA\Post(
     *      path="/employees",
     *      tags={"employees"},
     *      summary="Add employee data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Employee data, or exception if patient is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Employee data payload",
     *          @OA\JsonContent(
     *              required={"first_name","email"},
     *              @OA\Property(property="id", type="string", example="1", description="Patient ID"),
     *              @OA\Property(property="name", type="string", example="Some name", description="Employee name"),
     *              @OA\Property(property="job_title", type="string", example="Some job title", description="Employee job title"),
     *              @OA\Property(property="department_id", type="string", example="Some name", description="department id"),
     *              @OA\Property(property="email", type="string", example="example@example.com", description="Patient email address"),
     *              @OA\Property(property="phone_number", type="string",description="Employee Phone number"),
     *              @OA\Property(property="hire_date", type="string", format ="date", example="Some hire date", description="Employee hire date"),
     *              @OA\Property(property="salary", type="string", example="Some salary", description="Employee salary"),
     *              @OA\Property(property="admin", type="string", example="Some admin", description="Admin")
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
 *      path="/employees/{employee_id}",
 *      tags={"employees"},
 *      summary="Update existing employee data in the database",
 *      @OA\Parameter(
 *          name="employee_id",
 *          in="path",
 *          required=true,
 *          description="The ID of the employee to update",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Success message and updated employee data"
 *      ),
 *      @OA\Response(
 *           response=404,
 *           description="Not Found if no employee found with the given ID"
 *      ),
 *      @OA\RequestBody(
 *          description="Employee data payload to update",
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
 *              @OA\Property(property="admin", type="boolean", example=true, description="Whether the employee has admin rights"),
 *              @OA\Property(property="password", type="string", example="some_secret_password", description="Some Secret Password")
 *          )
 *      )
 * )
 */

Flight::route('PUT /employees/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::employeeService()->update($id, $data);  
    Flight::json(["message" => "updated"]);
});


 /**
     * @OA\Delete(
     *      path="/employees/{employee_id}",
     *      tags={"employees"},
     *      summary="Delete employee by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted employee data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="employee_id", example="1", description="Employee ID")
     * )
     */

Flight::route('DELETE /employees/@id', function($id){
    Flight::employeeService()->delete($id);
    Flight::json(["message" => "deleted"]);
});

?>
