<?php
require_once 'Database.php';
class UserModel extends Database{
    public function GetAllUser($limit){
        return $this->select("SELECT * FROM client_master ORDER BY id LIMIT ?", ["i", $limit]);
    }

    public function GetAllUserById($id){
        return $this->select("SELECT * FROM client_master WHERE client_no = $id");
    }
}
?>