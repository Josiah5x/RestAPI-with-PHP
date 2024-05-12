<?php
// require_once PROJECT_ROOT_PATH . "/model/UserModel.php";
class UserController extends BaseController{
    protected $strErrorDesc = '';
    protected $strHeaderDesc = '';
    // protected $requestMethod = $_SERVER['REQUEST_METHOD'];
    
    public function ListAction($limit){
        if(strtoupper($_SERVER['REQUEST_METHOD'] === 'GET')){
            try {
                $userModel = new UserModel();
                $intstandardLimit = 5;
                $intstandardLimit = $limit;
                $arrUser = $userModel->GetAllUser($intstandardLimit);
                $response = json_encode($arrUser);
                // return $response;
            } catch (Error $e) {
                $this->strErrorDesc = $e->getMessag()."Please contact the service provider";
                $this->strHeaderDesc = "HTTP/1.1 500 SERVER ERROR";
            } 
        }else {
            $this->strErrorDesc = "Method not supported";
            $this->strHeaderDesc = "HTTP/1.1 422 Unprocessable Entity";
        }

        if(!$this->strErrorDesc){
            $this->sendOutput($response, array("Content-Type: application/json", "HTTP/1.1 200 OK"));
        }else{
            $this->sendOutput(json_encode(array("Error"=>$this->strErrorDesc)), array("Content-Type: application/json", $this->strHeaderDesc));
        }
    }

    public function getUserByIdAction($client_no){
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                try {
                    $userModel = new UserModel();
                    $oneUser = $userModel->GetAllUserById($client_no);
                    $response = json_encode($oneUser);
                } catch (Error $e) {
                    $this->strErrorDesc = $e->getMessag()."Please contact the service provider";
                    $this->strHeaderDesc = "HTTP/1.1 500 SERVER ERROR";   
                }
            }else {
                $this->strErrorDesc = "Method not supported";
                $this->strHeaderDesc = "HTTP/1.1 422 Unprocessable Entity";
            }

            if(!$this->strErrorDesc){
                $this->sendOutput($response, array("Content-Type: application/json", "HTTP/1.1 200 OK"));
            }else{
                $this->sendOutput(json_encode(array("Error"=>$this->strErrorDesc)), array("Content-Type: application/json", $this->strHeaderDesc));
            }
        
        }  
}
?>