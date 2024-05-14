<?php
require_once __DIR__. '/BaseDao.class.php';

class PayrollDao extends BaseDao { 
    
  public function __construct(){
    parent::__construct("payroll");
  }

   
   public function get_all_payrolls(){
    return $this->get_all();
}


public function get_payroll_by_id($id){
    return $this->get_by_id($id);
}



  function get_payroll_by_employee_id($name)
  {
    return $this->query_unique("SELECT * FROM payroll WHERE name = :name", ["name" =>$name]);
    
  }

}

?>