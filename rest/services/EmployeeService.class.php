<?php
require_once __DIR__. '/BaseService.class.php';
require_once __DIR__ . '/../dao/EmployeeDao.class.php';

class EmployeeService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new EmployeeDao);
    }

     public function get_all_employees(){
        return $this->get_all();
    }

    public function get_employee_by_id($id){
        return $this->get_by_id($id);
    }

    public function get_employee_by_name($name){
        return $this->dao->get_employee_by_name($name);
    }
}

?>