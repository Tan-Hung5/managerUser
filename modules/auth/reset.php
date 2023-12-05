<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;
layouts('header', 'reset');
$email= getSession('email');
$code = getSession('activecode');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $confirmpass = $_POST["confirmpass"];
    $o1 = $_POST['code1'];
    $o2 = $_POST['code2'];
    $o3 = $_POST['code3'];
    $o4 = $_POST['code4'];
    $o5 = $_POST['code5'];
    $o6 = $_POST['code6'];
    $Inputcode = $o1.$o2.$o3.$o4.$o5.$o6;
    $validator = new FormValidator();
     
    for( $i = 1; $i < 7; $i++ ){
        $input[$i] = $_POST['code'.$i];  
    }
    $errors = $validator->validateResetPass($input,$password,$confirmpass);

    if(empty($errors)){
        
        $errors =  $validator->checkActiveCode($code,$Inputcode);
    }

       
     
    
    if(empty($errors)) {
        $data =['password'=> $password];
        $data = encodePass($data);
        $data = setTime($data, 'update_at');
        update('user',$data, 'email = "'.$email.'"');
        $url= _WEB_HOST.'/?module=auth&action=login';
            echo '<script>
                
                    window.location.href = "'.$url.'";
               
            </script>';
    }
}
?>

<hr style="margin-bottom: 50px;">
<div class=" shadow d-flex justify-content-center align-items-center container ">
        <div class="row " style="width:380px; ">
            <div class=" col ">
                <h2 class="text-center"><p class="fs-1 --bs-success-text-emphasis login">RESET PASSWORD</p></h2>
                <form action="" method="post">
                    <div class="form-group m-2">
                        <label for="auth-code">Enter Your Code</label>
                        <div id="auth-code">
                            <input type="text" name="code1" class="text-center auth-code-input" id="digit1" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(this)">
                            <input type="text" name="code2" class="text-center auth-code-input" id="digit2" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(this)">
                            <input type="text" name="code3" class="text-center auth-code-input" id="digit3" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(this)">
                            <input type="text" name="code4" class="text-center auth-code-input" id="digit4" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(this)">
                            <input type="text" name="code5" class="text-center auth-code-input" id="digit5" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(this)">
                            <input type="text" name="code6" class="text-center auth-code-input" id="digit6" maxlength="1" onkeydown="moveToPrevious(this)">
                        </div>
                        <label for="auth-code" style="color: red;"><?php echo (!empty($errors['code'])) ? $errors['code']:'' ?></label>
                    </div>
                    <div class="form-group m-2">
                        <label for="newpassword"> New password</label>
                        <input type="password"  maxlength="20" name="password" placeholder="Password..." class="form-control">  
                        <label for="newpassword" style="color: red;"><?php echo (!empty($errors['password'])) ? $errors['password']:'' ?></label>                 
                    </div>
                    <div class="form-group m-2">
                        <label for="password">Confirm password</label>
                        <input type="password" name="confirmpass" maxlength="20" placeholder="Password..." class="form-control">   
                        <label for="password" style="color: red;"><?php echo (!empty($errors['confirmpass'])) ? $errors['confirmpass']:'' ?></label>             
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary w-btn-lg btn-shadow">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
</div>
<script>
const authCodeInputs = Array.from({ length: 6 }, (_, index) => new AuthCodeInput("digit" + (index + 1)));</script>

