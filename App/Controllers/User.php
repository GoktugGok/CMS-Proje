<?php

namespace App\Controllers;

use App\Model\ModelUser;
use Core\BaseController;
use Core\Session;
use PDO;

class User extends BaseController{

    public function Index(){

        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        $data['user'] = Session::getAllSession();
        
        echo $this->view->load('user/index',compact('data'));
    }
    public function EditProfile(){
        $data = $this->request->post();

        if (!$data['name']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'İsmi boş bırakmayın.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        if (!$data['surname']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Soyismi boş bırakmayın.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        if (!$data['email']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'E-Posta yı boş bırakmayın.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        $ModelUser = new ModelUser();
        $update = $ModelUser->editProfile($data);

        if ($update) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'Profiliniz Güncellendi.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }else{
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'İşlem tamamlanmadı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
    }
    public function ChangePassword(){
        echo 'asd';
    }
    
}