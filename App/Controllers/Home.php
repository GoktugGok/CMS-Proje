<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Session;

class Home extends BaseController{ // controllers altındaki dosya isimleri büyük harfle başlamalı

    public function Index(){
        $user = [
            'isim' => 'Göktuğ',
            'soyisim' => 'Gök',
            'yas' => 18,
        ];
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('home/index', compact('data')); // compact [$user => 'user'] anlamına gelir.
    }   
}