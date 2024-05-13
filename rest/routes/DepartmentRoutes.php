<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); 
}

/**
 * @OA\Get(
 *      path="/departments",
 *      tags={"departments"},
 *      summary="Get departments",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all departments in the databases"
 *      )
 * )
 */

Flight::route('GET /departments', function(){
    Flight::json(Flight::departmentService()->get_all_departments());
});

 /**
     * @OA\Get(
     *      path="/departments/{departments_id}",
     *      tags={"departments"},
     *      summary="Get department by id",
     *      @OA\Response(
     *           response=200,
     *           description="Department data, or false if employee does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="departments_id", example="1", description="Department ID")
     * )
     */

Flight::route('GET /departments/@id', function($id){
    Flight::json(Flight::departmentService()->get_department_by_id($id));
});



Flight::route('GET /departments/by_name/@name', function($name){
    Flight::json(Flight::departmentService()->get_department_by_name($name));
});


  /**
     * @OA\Post(
     *      path="/departments",
     *      tags={"departments"},
     *      summary="Add department data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Department data, or exception if patient is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Department data payload",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="string", example="1", description="Department ID"),
     *              @OA\Property(property="name", type="string", example="Some name", description="Department name"),
     *              @OA\Property(property="description", type="string", example="Some job title", description="Department description"),
     *              @OA\Property(property="manager", type="string", example="Some manager", description="Department manager")
     *      )
     * )
     * )
     */
Flight::route('POST /departments', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::departmentService()->add($data));
    Flight::json(["message" => "created"]);
});


   /**
 * @OA\Put(
 *      path="/departments/{department_id}",
 *      tags={"departments"},
 *      summary="Update existing department data in the database",
 *      @OA\Parameter(
 *          name="department_id",
 *          in="path",
 *          required=true,
 *          description="The ID of the department to update",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Success message and updated department data"
 *      ),
 *      @OA\Response(
 *           response=404,
 *           description="Not Found if no department found with the given ID"
 *      ),
 *      @OA\RequestBody(
 *          description="Department data payload to update",
 *          required=true,
     *          @OA\JsonContent(
 *              required={"name", "description"},
     *              @OA\Property(property="id", type="string", example="1", description="Department ID"),
     *              @OA\Property(property="name", type="string", example="Some name", description="Department name"),
     *              @OA\Property(property="description", type="string", example="Some job title", description="Department description"),
     *              @OA\Property(property="manager", type="string", example="Some manager", description="Department manager")
 *          )
 *      )
 * )
 */

Flight::route('PUT /departments/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::departmentService()->update($id, $data);
    Flight::json(["message" => "updated"]);
});



 /**
     * @OA\Delete(
     *      path="/departments/{departments_id}",
     *      tags={"departments"},
     *      summary="Delete department by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted department data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="departments_id", example="1", description="Department ID")
     * )
     */

Flight::route('DELETE /departments/@id', function($id){
    Flight::departmentService()->delete($id);
    Flight::json(["message" => "deleted"]);
});

?>
