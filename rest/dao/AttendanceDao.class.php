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
  public function find_by_employee_id($employeeId) {
    $query = "SELECT * FROM attendance WHERE employee_id = :employee_id";
    return $this->query($query, ['employee_id' => $employeeId]);
}

public function update_status($attendanceId, $newStatus) {
    $query = "UPDATE attendance SET status = :status WHERE id = :id";
    return $this->query($query, ['status' => $newStatus, 'id' => $attendanceId]);
}


public function update_time_out($id, $time_out) {
  $query = "UPDATE attendance SET time_out = :time_out WHERE id = :id";
  return $this->query($query, ['id' => $id, 'time_out' => $time_out]);
}

}

?>