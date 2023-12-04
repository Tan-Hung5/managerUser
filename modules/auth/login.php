<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;
layouts('header', 'login');
$condition = getFlashData('register');
printToast($condition,'Register success');

$data=['email'=>'', 'password'=>''];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validator = new FormValidator();
    foreach ($data as $key=>$value) {
        $data[$key] = $_POST[$key];
    }
    $errors = $validator->validateLogin($data['email'], $data['password']); 
    if(empty($errors)) {
        $res = queryData($data['email']);
        if(password_verify($data['password'], $res['password'])) {

            setSession('islogin', true);
            $url= '/Project/manager_user/?module=&action=';
            header("Location:".$url."");
        }else{
            echo '<div class="alert alert-danger" role="alert">
            Email or password incorrect!
          </div>';
          printToast('error');
        }
    }
}

?>
<hr>
<div class=" shadow d-flex justify-content-center align-items-center container ">
        <div class="row " style="width:380px;">
            <div class=" col ">
                <h2 class="text-center"><p class="fs-1 text-success-emphasis login">LOGIN</p></h2>
                <form action="" method="post">
                    <div class="form-group m-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Email..." class="form-control" value="<?php echoOldData($data['email'])?>">
                        <label style="color:red;"><?php echo (!empty($errors['email'])) ? $errors['email']:'' ?> </label>
                    </div>
                    <div class="form-group m-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password..." 
                        class="form-control" value="<?php echoOldData($data['password'])?>">
                        <label style="color:red;"><?php echo (!empty($errors['password'])) ? $errors['password']:'' ?> </label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class=" m-2 btn btn-primary btn-lg btn-block w-btn-lg btn-shadow">Login</button>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p><a href="?module=auth&action=forgot">Forgot password</a></p>
                        </div>
                        <div class="col " style="text-align: end; align-items: flex-end;">
                            <a class="btn btn-outline-success btn-shadow" href="?module=auth&action=register" role="button">Register</a>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
</div>
<?php
layouts('footer','');
?>
