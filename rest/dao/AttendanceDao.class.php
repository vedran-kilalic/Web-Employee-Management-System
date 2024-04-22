<?php
require_once __DIR__. '/BaseDao.class.php';

class AttendanceDao extends BaseDao { 
    
  public function __construct(){
    parent::__construct("attendance");
  }

  
     // Get attendance
     public function get_attendance(){
      return $this->get_all();
  }

  // Get attendance by ID
  public function get_attendance_by_id($id){
      return $this->get_by_id($id);
  }

  // Get Attendance By status
  function get_attendance_by_status($status)
  {
    return $this->query_unique("SELECT * FROM attendance WHERE status = :status", ["status" =>$status]);
    
  }

}

?>