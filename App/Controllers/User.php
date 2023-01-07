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
            Session::setSession('name', $data['name']);
            Session::setSession('surname', $data['surname']);
            Session::setSession('email', $data['email']);
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'Profiliniz.';
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
        $data = $this->request->post();

        if (!$data['password']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Lütfen geçerli şifrenizi giriniz.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        if (!$data['new_password']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Lütfen yeni şifrenizi giriniz.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        if (strlen($data['new_password']) < 6) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'En az 6 karekterlik tahmin edilmesi zor bi şifre yap.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        if (!$data['new_password_again']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Lütfen yeni şifrenizi tekrar giriniz.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        
        if ($data['new_password'] != $data['new_password_again']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Şifreleriniz birbiri ile uyuşmuyor.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }

        //benim
        $ModelUser = new ModelUser();
        $update = $ModelUser->changePassword($data);

        if ($update) {
            Session::setSession('password',md5($data['new_password']));
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'Profiliniz.';
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
    
}