<?php
// 
// require_once 'UserController.php';
class BaseController{
    public function __call($name, $argument){
        $User = new UserController();
        switch ($name) {
            case 'v1/getAllUser':
                // $userLimit = $this->getQuerryParams();
                parse_str($_SERVER['QUERY_STRING'], $param);
                $userLimit = $param['limit'];
                $User->ListAction($userLimit);
                break;
            case 'v1/getUser':
                // $userLimit = $this->getQuerryParams();
                parse_str($_SERVER['QUERY_STRING'], $param);
                $client_no = $param['client_no'];
                $User->getUserByIdAction($client_no);
                break;
            
            default:
                # code...
                $this->sendOutput('', array("HTTP/1.1 404 found".$name));
                break;
        }

    }

    protected function getQuerryParams(){
        parse_str($_SERVER['QUERY_STRING'], $param);
        return $param['limit'];
        }
    

    public function sendOutput($data, $httpHeaders=array()){
        header_remove('set_cookies');
        foreach($httpHeaders as $httpHeader){
            header($httpHeader);
        }
        echo $data;
        exit();
    }

}
?>