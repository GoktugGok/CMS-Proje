<?php

namespace App\Controllers;

use Core\BaseController;
use App\Model\ModelCustomer;
use App\Model\ModelProject;
class Customer extends BaseController{ // controllers altındaki dosya isimleri büyük harfle başlamalı

    public function Index()
        {
            $ModelCustomer = new ModelCustomer();

            $data['customers'] = $ModelCustomer->getCustomers();

            $data['navbar'] = $this->view->load('static/navbar');
            $data['sidebar'] = $this->view->load('static/sidebar');
            echo $this->view->load('customer/index', compact('data')); // compact [$user => 'user'] anlamına gelir.
        }
    public function Add(){
        $user = [
            'isim' => 'Göktuğ',
            'soyisim' => 'Gök',
            'yas' => 18,
        ];
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('customer/add', compact('data')); // compact [$user => 'user'] anlamına gelir.
        }   
    public function Edit($id){
        $ModelCustomer = new ModelCustomer();
        $data['customer'] = $ModelCustomer->getCustomer($id);
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('customer/edit', compact('data')); // compact [$user => 'user'] anlamına gelir.
    }
    public function Detail($id){
        $ModelProject = new ModelProject();
        $data['projects'] = $ModelProject->getProjectsByCustomerID($id);

        $ModelCustomer = new ModelCustomer();
        $data['customer'] = $ModelCustomer->getCustomer($id);

        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('customer/detail', compact('data')); // compact [$user => 'user'] anlamına gelir.
    }  
    
    public function CreateCustomer(){
        $data = $this->request->post();

        if (!$data['customer_name'] || !$data['customer_surname']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Lütfen müşteri adını giriniz ve soyadını giriniz.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        $ModelCustomer = new ModelCustomer();
        $insert = $ModelCustomer->createCustomer($data);

        if ($insert) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg,'redirect' => _link('musteri/')]);
            exit();
        }else{
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'İşlem tamamlanmadı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
    }
    public function EditCustomer(){

        $data = $this->request->post();

        if (!$data['customer_id']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Lütfen müşteri bilgisine ulaşamadık sayfanızı yenileyin.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        if (!$data['customer_name'] || !$data['customer_surname']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Lütfen müşteri adını ve soyadını giriniz.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        $ModelCustomer = new ModelCustomer();
        $insert = $ModelCustomer->editCustomers($data);

        if ($insert) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg,'redirect' => _link('musteri/')]);
            exit();
        }else{
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'İşlem tamamlanmadı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
    }
    public function RemoveCustomer(){
        $data = $this->request->post();

        if (!$data['customer_id']){
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Müşteri bilgisi alınamadı';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        
        $remove = $this->db->remove("DELETE FROM customers WHERE customers.id='{$data['customer_id']}'");

        if ($remove) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'Kullanıcı silindi';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg,'removed' => $data['customer_id']]);
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