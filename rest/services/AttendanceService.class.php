<?php

require_once __DIR__ . '/BaseService.class.php';
require_once __DIR__ . '/../dao/AttendanceDao.class.php';

class AttendanceService extends BaseService {

    public function __construct(){
        parent::__construct(new AttendanceDao);
    }

    public function get_attendance(){
        return $this->get_all();
    }

    public function get_attendance_by_id($id){
        return $this->get_by_id($id);
    }

    public function get_attendance_by_status($status){
        return $this->dao->get_attendance_by_status($status);
    }

    public function find_by_employee_id($employeeId) {
        return $this->dao->find_by_employee_id($employeeId);
    }

    public function update_status($attendanceId, $newStatus) {
        return $this->dao->update_status($attendanceId, $newStatus);
    }

    public function update_attendance_time_out($employeeId) {
        $attendance_list = $this->dao->find_by_employee_id($employeeId);
        $last_index = count($attendance_list) - 1;

        if ($last_index >= 0) {
            $last_attendance = $attendance_list[$last_index];
            $current_time = new DateTime();
            $time_out = $current_time->format('H:i:s');
            $this->dao->update_time_out($last_attendance['id'], $time_out);
            return ["message" => "Time Out updated successfully"];
        } else {
            return ["message" => "No attendance records found for the given employee", "status" => 404];
        }
    }
}

?>
