<?php

require_once __DIR__. '/BaseDao.class.php';

class DepartmentDao extends BaseDao {

    public function __construct(){
        parent::__construct("departments");
    }

   
    public function get_all_departments(){
        return $this->get_all();
    }

    
    public function get_department_by_id($id){
        return $this->get_by_id($id);
    }

    
   function get_department_by_name($name)
    {
      return $this->query_unique("SELECT * FROM departments WHERE name = :name", ["name" =>$name]);
      
    }

}

