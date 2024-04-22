<?php
require_once __DIR__. '/BaseDao.class.php';

class AttendanceDao extends BaseDao { 
    
  public function __construct(){
    parent::__construct("attendance");
  }

  
     
     public function get_attendance(){
      return $this->get_all();
  }

 
  public function get_attendance_by_id($id){
      return $this->get_by_id($id);
  }


  function get_attendance_by_status($status)
  {
    return $this->query_unique("SELECT * FROM attendance WHERE status = :status", ["status" =>$status]);
    
  }

}

?>