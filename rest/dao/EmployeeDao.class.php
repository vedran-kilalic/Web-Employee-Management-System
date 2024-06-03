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
  
  public function get_employee_by_email($email) {
    $query = "SELECT *
              FROM employees
              WHERE email = :email";
    return $this->query_unique($query, ['email' => $email]);
}

  public function check_password($employee_id, $password){
    $query = "SELECT *
              FROM employees
              WHERE id = :id
              AND password=:password";
    $result = $this->query_unique($query, ['id' => $employee_id, 'password' => $password]);
    if ($result){
      return true;
    } else{
      return false;
    }
  }
  public function get_employee_id($employee_id) {
    $query = "SELECT * FROM employees WHERE id = :id";
    return $this->query_unique($query, ['id' => $employee_id]);
}

}

?>