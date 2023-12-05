<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;
layouts('header', 'acvite accout');

$code = getFlashData('activecode');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $o1 = $_POST['code1'];
    $o2 = $_POST['code2'];
    $o3 = $_POST['code3'];
    $o4 = $_POST['code4'];
    $o5 = $_POST['code5'];
    $o6 = $_POST['code6'];
    $Inputcode = $o1.$o2.$o3.$o4.$o5.$o6;
    if (isset($_POST["confirmcode"])) {
    $validator = new FormValidator();
    for( $i = 1; $i < 7; $i++ ){
        $input[$i] = $_POST['code'.$i];
        
    }
    $errors = $validator->checkEmptyCode($input);
    if (empty($errors)) {
       $errors =  $validator->checkActiveCode($code,$Inputcode);
    }

    if (empty($errors)) {
        setFlashData('register', true);
        $data = getFlashData('data');
        insert('user', $data);
        echo '<script>alert("Active success");</script>';
        sleep(1);
        $url= _WEB_HOST.'/?module=auth&action=login';
            echo '<script>
                
                    window.location.href = "'.$url.'";
               
            </script>';
    }

    }elseif(isset($_POST['resend'])){
        $email = getSession('email');
        $activeCode = new activeCode();
        $code = $activeCode->createCode();
        setFlashData('activecode', $code);
        $sendMail = new MyMailer();
        $sendMail-> sendActivecode($code,$email,);
    }
}
?>


<hr style="margin-bottom: 50px;">
<div class=" shadow d-flex justify-content-center align-items-center container ">
        <div class="row align-content-center" style="width:580px; height: 350px;">
            <div class=" col ">
                <h2 class="text-center m-2"><p class="fs-1  --bs-success-text-emphasis login">ACTIVE YOUR ACCOUT</p></h2>
                <form action="" class="text-center" method="post">
                    <div class="form-group active text-center ">
                        <label for="auth-code">Enter Your Code</label>
                        <div id="auth-code " class="m-2 p-2" >
                            <input type="text" name="code1" class="text-center auth-code-input" id="digit1" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(this)">
                            <input type="text" name="code2" class="text-center auth-code-input" id="digit2" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(this)">
                            <input type="text" name="code3" class="text-center auth-code-input" id="digit3" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(this)">
                            <input type="text" name="code4" class="text-center auth-code-input" id="digit4" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(this)">
                            <input type="text" name="code5" class="text-center auth-code-input" id="digit5" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(this)">
                            <input type="text" name="code6" class="text-center auth-code-input" id="digit6" maxlength="1" onkeydown="moveToPrevious(this)">
                        </div>
                        <label for="auth-code" style="color: red;"><?php echo (!empty($errors['code'])) ? $errors['code']:'' ?></label>
                    </div>
                    <button type="submit" name="confirmcode" class="btn btn-primary w-btn-lg btn-shadow">Confirm</button>
                    </br>
                    <div class="m-4">
                        <p>Click on the button below to receive the code again</p>
                        <button name="resend" type="submit" class="btn  btn-outline-info btn-shadow">Resend</button>
                    </div>
                    
                </form>
            </div>
        </div>
</div>


<script>
const authCodeInputs = Array.from({ length: 6 }, (_, index) => new AuthCodeInput("digit" + (index + 1)));
</script>
<?php layouts('footer','');?>