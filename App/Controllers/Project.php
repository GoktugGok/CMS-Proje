<?php

namespace App\Controllers;
use App\Model\ModelProject;
use App\Model\ModelCustomer;
use Core\BaseController;

class Project extends BaseController{ // controllers altındaki dosya isimleri büyük harfle başlamalı

    public function Index(){
        $ModelProject = new ModelProject();
        $data['projects'] = $ModelProject->getProjects();
        
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/index', compact('data')); // compact [$user => 'user'] anlamına gelir.
    }
    public function Add(){
        $ModelCustomer = new ModelCustomer();
        $data['customers'] = $ModelCustomer->getCustomers();

        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/add', compact('data')); // compact [$user => 'user'] anlamına gelir.
    } 

    public function Edit($id){
        $ModelProject = new ModelProject();
        $data['projects'] = $ModelProject->getProject($id);

        $ModelCustomer = new ModelCustomer();
        $data['customers'] = $ModelCustomer->getCustomers();

        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/edit', compact('data')); // compact [$user => 'user'] anlamına gelir.
    }
    public function EditProject(){

        $data = $this->request->post();

        if (!$data['id'] ) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Proje bilgisine ulaşamadık lütfen sayfanızı yenileyin.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }

        if (!$data['title'] ) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Lütfen proje adını boş bırak mıyınız.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        $ModelProject = new ModelProject();
        $insert = $ModelProject->editProjects($data);

        if ($insert) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg,'redirect' => _link('proje/')]);
            exit();
        }else{
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'İşlem tamamlanmadı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
    }   
    
    public function CreateProject(){
        
        $data = $this->request->post();
        
        if (!$data['title'] ) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Lütfen proje adını giriniz.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        
        $ModelProject = new ModelProject();
        $insert = $ModelProject->createProject($data);
        if ($insert) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg,'redirect' => _link('proje')]);
            exit();
        }else{
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'İşlem tamamlanmadı.';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
    }

    public function RemoveProject(){
        $data = $this->request->post();

        if (!$data['project_id']) {
            $status = 'error';
            $title = 'Ops! Dikkat ';
            $msg = 'Müşteri bilgisi alınamadı';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg]);
            exit();
        }
        $remove = $this->db->remove("DELETE FROM projects WHERE projects.id='{$data['project_id']}'");

        if ($remove) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'Proje silindi';
            echo json_encode(['status' => $status,'title' => $title,'msg' => $msg,'removed' => $data['project_id']]);
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
    