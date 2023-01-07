<?php

namespace App\Model;

use Core\BaseModel;
use Core\Session;


class ModelUser extends BaseModel{
    public function getProfile(){
        $id = intval(Session::getSession('id'));
        return $this->db->query("SELECT * FROM system_users WHERE id = '$id' ", false);
    }

    public function editProfile($data){
        extract($data);
        $id = Session::getSession('id');

        $user = $this->db->connect->prepare('UPDATE system_users SET
                            system_users.name =?,
                            system_users.surname =?,
                            system_users.email =?
                            WHERE system_users.id =?');

        $insert = $user->execute([
            $name,
            $surname,
            $email,
            $id
        ]);
        
        if ($insert) {
            return true;
        }else{
            return false;
        }
      }
      public function editNote($data){
            extract($data);
            
            $user = $this->db->connect->prepare('UPDATE customers SET customers.notes =?
                    WHERE customers.id =?');

            $update = $user->execute([
                $html,
                $id
            ]);

            if ($update) {
                return true;
            }else{
                return false;
            }
    }
    public function changePassword($data){
        extract($data);
        $id = Session::getSession('id');
        $user = $this->db->connect->prepare('UPDATE system_users SET system_users.password =?
                    WHERE system_users.id =?');

            $update = $user->execute([
                md5($new_password),
                $id
            ]);

            if ($update) {
                return true;
            }else{
                return false;
            }
    }

}
