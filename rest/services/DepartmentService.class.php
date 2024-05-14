<?php

require_once __DIR__ . '/BaseService.class.php';
require_once __DIR__ . '/../dao/DepartmentDao.class.php';

class DepartmentService extends BaseService {

    public function __construct(){
        parent::__construct(new DepartmentDao);
    }

    public function get_all_departments(){
        return $this->get_all();
    }
    public function get_department_by_id($id){
        return $this->get_by_id($id);
    }


    public function get_department_by_name($name){
        return $this->dao->get_department_by_name($name);
    }

}

?>
