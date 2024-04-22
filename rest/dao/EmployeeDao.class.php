<?php
require_once __DIR__. '/BaseDao.class.php';

class EmployeeDao extends BaseDao { 
    
  public function __construct(){
    parent::__construct("employees");
  }

   
   public function get_all_employees(){
    return $this->get_all();
}


public function get_employee_by_id($id){
    return $this->get_by_id($id);
}


  function get_employee_by_name($name)
  {
    return $this->query_unique("SELECT * FROM employees WHERE name = :name", ["name" =>$name]);
    
  }

}

?>