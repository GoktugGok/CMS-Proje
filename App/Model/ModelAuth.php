<?php

namespace App\Model;

use Core\BaseModel;
use Core\Session;


class ModelAuth extends BaseModel{
    public function userLogin($data){

        extract($data);

        $password = md5($password);
        
        $user = $this->db->query("SELECT * FROM system_users 
                WHERE system_users.email = '$email' && system_users.password = '$password'");

        if($user){
            Session::setSession('login',true);
            Session::setSession('name',$user[0]['name']);
            Session::setSession('surname',$user[0]['surname']);
            Session::setSession('email',$user[0]['email']);
            Session::setSession('password',$user[0]['password']);
            return true;
        }else{
            return false;
        }
    }
}