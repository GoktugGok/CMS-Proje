<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Session;

class Auth extends BaseController{

    public function Index(){
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('auth/index', compact('data')); // compact [$user => 'user'] anlamına gelir.
    }
    public function Login(){
       $post = $this->request->post();
       print_r($post);
    }
    public function Logout(){
        Session::removeSession();
        redirect('login');
    }
}