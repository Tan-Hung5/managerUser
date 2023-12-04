<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;
?>


<?php

require 'includes/vendor/autoload.php'; 


use Firebase\JWT\JWT;

function layouts($layoutName, $title){
    if(file_exists(_WEB_PATH_TEMPLATE.'/layout/'.$layoutName.'.php')){
        require_once(_WEB_PATH_TEMPLATE.'/layout/'.$layoutName.'.php');
    }
}



//VALIDATE INPUT
class FormValidator {
    private $errors = [];

    private function validateEmail($email) {

        $email = trim($email);
        if (empty($email)) {
            $this->errors['email'] = "Please provide a valid email";
         }
            
         
    }
    
    private function validatePassword($password) {

        $password = trim($password);
        if (empty($password)) {
            $this->errors['password'] = "Please provide a valid password";
        }elseif(strlen($password) < 6) {
            $this->errors['password'] = "Password must be more than 6 characters long";
        }
    }

    private function validateConfirmPass($password) {

        $password = trim($password);
        if (empty($password)) {
            $this->errors['confirmpass'] = "Please provide a valid password";
        }elseif(strlen($password) < 6) {
            $this->errors['confirmpass'] = "Password must be more than 6 characters long";
        }
    }

    private function validateName($name) {

        $name = trim($name);
        if (empty($name)) {
            $this->errors['username'] = "Please provide your name";
        }elseif (strlen($name) < 3 || strlen($name) > 10) {
            $this->errors['username'] = "Name length must be from 3 to 10 characters";

        }elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            $this->errors['username']= "The name must contain only letters and spaces";
        }else{
            $sql ="SELECT ID FROM user WHERE username ='$name'";
            if(select1Raw($sql) > 0){
                $this->errors["username"] = "Username already exists";
            }
        }
    }

    private function validatePhoneNumber($phoneNumber) {
        $phoneNumber = trim($phoneNumber);
        if (empty($phoneNumber)) {
            $this->errors['phonenumber'] = "Please provide phone number";
        }elseif (!preg_match('/^\+?[0-9\s-]{10,15}$/', $phoneNumber)) {
     
            $this->errors['phonenumber'] = 'Please provide a valid phone number';
        }
    }

    private function validateCode($code=[]) {
        foreach ($code as $key => $value) {
            if (empty($value)) {
                $this->errors['code'] = "Please enter your code with 6 numbers";
            }
        }
    }

    private function validateActiveCode($input, $Code)
    {   
        if($input != $Code){
            $this->errors ['code']= 'Code is not correct';
        }
    }
    private function comparePass($password,$newpassword) {
        if($newpassword != $password){
            $this->errors["confirmpass"] = "Password incorrect";
        }
    }

    public function validateLogin($email, $password) {
        $this->validateEmail($email);
        $this->validatePassword($password);
        return $this->errors;
    }

    public function validateRegister($email, $name, $phone,$password,$confirmpass) {
        $this->validateEmail($email);
        if(!empty($this->errors)){
            $sql ="SELECT ID FROM user WHERE email ='$email'";
            if(getRows($sql) > 0){
                $this->errors["email"] = "Email already exists";
            }
        }
        $this->validateName($name);
        $this->validatePhoneNumber($phone);
        $this->validatePassword($password);
        $this->validateConfirmPass($confirmpass);
        $this->comparePass($password,$confirmpass);
        return $this->errors;

    }

    public function validateEditUser($email,$name,$phone){
        $this->validateEmail($email);
        $this->validateName($name);
        $this->validatePhoneNumber($phone);
      
         return $this->errors;

    }

    public function validateForgot($email) {
        $this->validateEmail($email);
        return $this->errors;
    }

    public function validateResetPass($input=[],$password, $confirmpass) {
        $this->validateCode($input);
        $this->validateconfirmPass($confirmpass);
        $this->validatePassword($password);
        $this->comparePass($confirmpass,$password);
        return $this->errors;
    }

    public function checkEmptyCode($input=[]) {
        $this->validateCode($input);
        return $this->errors;
    }

    public function checkActiveCode( $code, $codeInput){
        $this->validateActiveCode($codeInput, $code);
        return $this->errors;
    }


}


function echoOldData ( $value){
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        if(!empty($value)){
            echo $value;
        }else{
            echo null;
        }

    }
}

function encodePass($data=[]){
    if(isset($data['password'])){
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    }
    return $data;
}

class standardization{
    private $data;
    private function doStandar($data=[]){
        $this->data = array_pop($data);
        $this->data = encodePass($data);
        setFlashData('data', $this->data);
    }

    public function standarData($data=[]){
        $this->doStandar($data);
        return $this->data;
    }

}

function setTime($data=[],$do){
    date_default_timezone_set('Asia/Ho_Chi_Minh'); 
    $time = date('Y-m-d_H:i:s');
    $data[$do] = $time;
    return $data;
}

class activeCode{
    private $code=0;

    private function ranCode(){
        $this->code = rand(100000,999999);
    }

   public function createCode(){
    $this->ranCode();
    return strval($this->code);

   }
}

function queryData($email=''){
    if(!empty($email)){
        $sql = "SELECT ID FROM user WHERE email = '$email'";
        if(select1Raw($sql)>0){
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $res = select1Raw($sql);
        return $res;
        }
    }else{
        $sql="SELECT * FROM user";
        $res= selectAllraw($sql);
        return $res;
    }
      
}

function printToast( $content=''){
    
    echo '<div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        '.$content.'
                    </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            ';
    
}


class Token{

    private $token;
    private $secretKey = 'h12121212';
    private $data;
    private function  generateToken($data) {
    
        $expirationTime = time() + 3600;

        
        $payload = [
            'data' => $data,
            'exp' => $expirationTime,
        ];

        
        $this->token = JWT::encode($payload, $this->secretKey, 'HS256');
        
    }


    private function decode($token){
        try {
            $decoded = JWT::decode($token, $this->secretKey, ['HS256']);
            $this->data =  $decoded->data; 
        } catch (Exception $e) {
            return null; 
        }

    }

    public function createToken($data){
        $this->generateToken($data);
        return $this->token;
    }

    public function decodeToken($token){
        $this->decode();
        return $this->data;
    }
}


function arrEmpty($arr=[]){
    $errors = [];
    foreach($arr as $key=>$value){
        if(empty($arr[$key])){
            $errors[$key] = $key.'must not be empty';
        }
    }
    return $errors;
}

function getDataToUpdate($dataInput=[],$dataDb=[]){
    $dataUpdate = [];
    if(!empty($dataInput) && !empty($dataDb)){
        
        foreach ($dataInput as $key => $value) {
            if($dataInput[$key]!=$dataDb[$key]){
                $dataUpdate[$key] = $value;
            }
        }
    }
    return $dataUpdate;

}














