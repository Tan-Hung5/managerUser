<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;
layouts('header', 'reset password');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validator = new FormValidator();
    $email = $_POST["email"];
    $errors = $validator->validateForgot($email); 
    if(empty($errors)) {
        setSession('email', $email);
        $activeCode = new activeCode();
        $code = $activeCode->createCode();
        setSession('activecode', $code);
        $sendMail = new MyMailer();
        $sendMail-> sendActivecode($code,$email);
        $url= '/Project/manager_user/?module=auth&action=reset';
        header("Location:".$url."");
    }
}
    

?>

<hr style="margin-bottom: 100px;">
<div class=" shadow d-flex justify-content-center align-items-center container ">
        <div class="row " style="width:380px; ">
            <div class=" col ">
                <h2 class="text-center"><p class="fs-1 --bs-success-text-emphasis login">RESET PASSWORD</p></h2>
                <form action="" method="post">
                    <div class="form-group m-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Email..." class="form-control" >
                        <label style="color:red;"><?php echo (!empty($errors['email'])) ? $errors['email']:'' ?> </label>
                    </div>
                    <div class="text-center">
                    <button type="submit" class=" m-2 btn btn-primary btn-block w-btn-lg btn-shadow" name="submit_button">GetCode</button>
                    </div>
                </form>
            </div>
        </div>
</div>
