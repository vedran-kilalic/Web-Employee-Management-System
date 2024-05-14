<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); 
}

/**
 * @OA\Get(
 *      path="/payroll",
 *      tags={"payroll"},
 *      summary="Get payrolls",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all payrolls in the databases"
 *      )
 * )
 */

Flight::route('GET /payroll', function(){
    Flight::json(Flight::payrollService()->get_all_payrolls());
});

 /**
     * @OA\Get(
     *      path="/payrollById/{payroll_id}",
     *      tags={"payroll"},
     *      summary="Get payroll by id",
     *      @OA\Response(
     *           response=200,
     *           description="payroll data, or false if employee does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="payroll_id", example="1", description="Payroll ID")
     * )
     */

Flight::route('GET /payrollById/@id', function($id){
    Flight::json(Flight::payrollService()->get_payroll_by_id($id));
});


Flight::route('GET /payroll/by_employee_id/@employee_id', function($employee_id){
    Flight::json(Flight::payrollService()->get_payroll_by_name($name));
});

  /**
     * @OA\Post(
     *      path="/payroll",
     *      tags={"payroll"},
     *      summary="Add payroll data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Payroll data, or exception if patient is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Payroll data payload",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="string", example="1", description="Payroll ID"),
     *              @OA\Property(property="employee_id", type="string", example="Some employee_id", description="Department employee_i"),
     *              @OA\Property(property="month", type="string", example="Some month", description="Payroll month"),
     *              @OA\Property(property="year", type="string", example="Some year", description="Payroll year"),
     *              @OA\Property(property="salary", type="string", example="Some salary", description="Payroll salary"),
     *              @OA\Property(property="taxes", type="string", example="Some taxes", description="Payroll taxes")
     *      )
     * )
     * )
     */

Flight::route('POST /payroll', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::payrollService()->add($data));
    Flight::json(["message" => "created"]);
});



   /**
 * @OA\Put(
 *      path="/payroll/{payroll_id}",
 *      tags={"payroll"},
 *      summary="Update existing payroll data in the database",
 *      @OA\Parameter(
 *          name="payroll_id",
 *          in="path",
 *          required=true,
 *          description="The ID of the payroll to update",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Success message and updated payroll data"
 *      ),
 *      @OA\Response(
 *           response=404,
 *           description="Not Found if no payroll found with the given ID"
 *      ),
 *      @OA\RequestBody(
 *          description="Payroll data payload to update",
 *          required=true,
     *          @OA\JsonContent(
 *              required={"month", "year"},
     *              @OA\Property(property="id", type="string", example="1", description="Payroll ID"),
     *              @OA\Property(property="employee_id", type="string", example="Some employee_id", description="Department employee_i"),
     *              @OA\Property(property="month", type="string", example="Some month", description="Payroll month"),
     *              @OA\Property(property="year", type="string", example="Some year", description="Payroll year"),
     *              @OA\Property(property="salary", type="string", example="Some salary", description="Payroll salary"),
     *              @OA\Property(property="taxes", type="string", example="Some taxes", description="Payroll taxes")
 *          )
 *      )
 * )
 */
Flight::route('PUT /payroll/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::payrollService()->update($id, $data);
    Flight::json(["message" => "updated"]);
});




 /**
     * @OA\Delete(
     *      path="/payroll/{payroll_id}",
     *      tags={"payroll"},
     *      summary="Delete payroll by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted payroll data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="payroll_id", example="1", description="Payroll ID")
     * )
     */
Flight::route('DELETE /payroll/@id', function($id){
    Flight::payrollService()->delete($id);
    Flight::json(["message" => "deleted"]);
});

?>
