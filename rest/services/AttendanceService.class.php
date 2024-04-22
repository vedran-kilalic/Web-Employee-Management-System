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

}

?>
