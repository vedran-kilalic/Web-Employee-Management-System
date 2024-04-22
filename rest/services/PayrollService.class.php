<?php
require_once __DIR__. '/BaseService.class.php';
require_once __DIR__ . '/../dao/PayrollDao.class.php';

class PayrollService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new PayrollDao);
    }

    public function get_all_payrolls(){
            return $this->get_all();
        }
    
    public function get_payroll_by_id($id){
            return $this->get_by_id($id);
        }

    function get_payroll_by_employee_id($employee_id)
    {
        return $this->dao->get_payroll_by_employee_id($employee_id);
    }
}

?>