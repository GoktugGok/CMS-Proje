<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Session;
use PDO;

class User extends BaseController{

    public function showProfile($id){
    //$user = $this->db->connect->query("SELECT * FROM user WHERE user.id = '$id' ")->fetch(PDO::FETCH_ASSOC);

    $user = $this->db->query("SELECT * FROM user WHERE user.id = '$id' ",false);
       print_r($user);
    }

    public function Test(){
        $this->view->load('test',['isim' => 'Göktuğ']);
    }

    public function getTest(){
        $get = $this->request->post();
        print_r($get);
    }
    
}