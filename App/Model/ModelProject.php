<?php

namespace App\Model;

use Core\BaseModel;
use Core\Session;


class ModelProject extends BaseModel{
    public function createProject($data){
        // var_dump($data);
       
        extract($data);

        if (!$customer_id || $customer_id == null || is_string($customer_id)) {
            $customer_id = 0;
        }
        $start_date = !$start_date ? date('Y-m-d'): $start_date;
        $end_date = !$end_date ? date('Y-m-d'): $end_date;
        
        // echo is_string($customer_id) ? 'evet':$customer_id;
        
        $user = $this->db->connect->prepare("INSERT INTO projects SET
                            projects.customer_id =?,
                            projects.title =?,
                            projects.description =?,
                            projects.start_date =?,
                            projects.end_date =?,
                            projects.added_id=?,
                            projects.progress =?,
                            projects.status =?");

        $update = $user->execute([
            $customer_id,
            $title,
            $description ?? '',
            $start_date,
            $end_date,
            intval(Session::getSession('id')),
            $progress ?? 1,
            $status ?? 'a'
        ]);
        
        if ($update) {
            return true;
        }else{
            return false;
        }
    }
    public function getProjects(){
      return $this->db->query("SELECT * FROM projects", true);
    }
    public function getProjectsByCustomerID($id){
        return $this->db->query("SELECT * FROM projects WHERE projects.customer_id = $id", true);
      }
    public function getProject($id){
        return $this->db->query("SELECT * FROM projects WHERE id = '$id' ", false);
    }
    public function editProjects($data){

        extract($data);

        if (!$customer_id || $customer_id == null ) {
            $customer_id = 0;
        }
        $start_date = !$start_date ? date('Y-m-d'): $start_date;
        $end_date = !$end_date ? date('Y-m-d'): $end_date;
        
        // echo is_string($customer_id) ? 'evet':$customer_id;
        
        $user = $this->db->connect->prepare("UPDATE projects SET
                            projects.customer_id =?,
                            projects.title =?,
                            projects.description =?,
                            projects.start_date =?,
                            projects.end_date =?,
                            projects.added_id=?,
                            projects.progress =?,
                            projects.status =? WHERE projects.id =?");

        $update = $user->execute([
            intval($customer_id),
            $title,
            $description ?? '',
            $start_date,
            $end_date,
            intval(Session::getSession('id')),
            $progress ?? 1,
            $status ?? 'a',
            $id
        ]);
        
        if ($update) {
            return true;
        }else{
            return false;
        }
    }

    
}
