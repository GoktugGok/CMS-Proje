<?php

namespace App\Controllers;

use App\Model\ModelAuth;
use Core\BaseController;
use Core\Session;

class Auth extends BaseController{

    public function Index(){
        $data['form_link'] = _link('giris');
        echo $this->view->load('auth/index',$data); // compact [$user => 'user'] anlamına gelir.
    }
    public function Login(){
   
        $data = $this->request->post();
        $AuthModel = new ModelAuth();
        $access = $AuthModel->userLogin($data);

        if ($access) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg,'redirect' => _link()]);
            exit();
        }else{
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'İşlem tamamlanmadı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
    }
    public function Logout(){
        Session::removeSession();
        redirect('giris');
    }
}