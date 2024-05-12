<?php
require_once PROJECT_ROOT_PATH . "/inc/config.php";
class Database{
    private $conn = null;
    public function __construct(){
        $this->conn = new mysqli(DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);
        if(mysqli_connect_errno()){
            throw new Exception("Connection fail");
        }
    }

    public function select($querry="", $params=array()){
        try {
            $stmt = $this->executeStament($querry, $params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            // $json = json_encode($result);
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function executeStament($querry="", $params=[]){
        try {
            $stmt = $this->conn->prepare($querry);
            if($stmt === false){
                throw new Exception("Unable to prapare a statement", $querry);
            }
            if($params){
                $stmt->bind_param($params[0], $params[1]);
            }
            $stmt->execute();
            return $stmt;
        } catch (Exeption $e) {
            throw new Exception($e->getMessage());
        }
    }
}

$v = new Database();

?>