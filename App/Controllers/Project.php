<?php

namespace App\Controllers;

use Core\BaseController;

class Project extends BaseController{ // controllers altındaki dosya isimleri büyük harfle başlamalı

    public function Index(){
        $user = [
            'isim' => 'Göktuğ',
            'soyisim' => 'Gök',
            'yas' => 18,
        ];
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/index', compact('data')); // compact [$user => 'user'] anlamına gelir.
    }
    public function Add(){
        $user = [
            'isim' => 'Göktuğ',
            'soyisim' => 'Gök',
            'yas' => 18,
        ];
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/add', compact('data')); // compact [$user => 'user'] anlamına gelir.
    }   
    public function Edit($id){
        $user = [
            'isim' => 'Göktuğ',
            'soyisim' => 'Gök',
            'yas' => 18,
        ];
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/edit', compact('data')); // compact [$user => 'user'] anlamına gelir.
    }      
}