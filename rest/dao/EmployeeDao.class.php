<?php
require_once __DIR__. '/BaseDao.class.php';

class EmployeeDao extends BaseDao { 
    
  public function __construct(){
    parent::__construct("employees");
  }

   // Get all employees
   public function get_all_employees(){
    return $this->get_all();
}

// Get employee by ID
public function get_employee_by_id($id){
    return $this->get_by_id($id);
}

// Get employee by name
  function get_employee_by_name($name)
  {
    return $this->query_unique("SELECT * FROM employees WHERE name = :name", ["name" =>$name]);
    
  }

}

?>