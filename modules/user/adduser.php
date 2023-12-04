<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;
layouts('header','Register');

$data =['email'=>'', 'username'=>'', 'phone'=>'', 'password'=>'', 'confirmpass'=>''];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($data as $key => $value) {
        $value = $_POST[$key];
        $data[$key] = $value;

    };
    $validator = new FormValidator();
    $errors = $validator->validateRegister($data['email'],$data['username'],$data['phone'],$data['password'],$data['confirmpass']);
    if(empty($errors)) {
        $standardization = new standardization();
        $data = $standardization->standarData($data);
        $data = setTime($data,'create_at');
        insert('user',$data);
        $url= '/Project/manager_user/?module=&action=';
        header("Location:".$url."");
    }
}
?>
<div class=" shadow d-flex justify-content-center align-items-center container ">
        <div class="row " style="width:380px;">
            <div class=" col ">
                <h2 class="text-center"><p class="fs-1 text-success-emphasis login">Add user</p></h2>
                <form action="" method="post">
                    <div class="form-group m-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Email..." class="form-control" value="<?php echoOldData($data['email'])?>">
                        <label for="eamil" style="color: red;"><?php echo (!empty($errors['email'])) ? $errors['email']:'' ?></label>
                    </div>
                    <div class="form-group m-2">
                        <label for="username">Usename</label>
                        <input type="usename" name="username" placeholder="Username..." class="form-control" value="<?php echoOldData($data['username'])?>">
                        <label for="username" style="color: red;"><?php echo (!empty($errors['username'])) ? $errors['username']:'' ?></label>
                    </div>
                    <div class="form-group m-2">
                        <label for="number">Phone number</label>
                        <input type="number" name="phone" placeholder="Phone number" class="form-control" value="<?php echoOldData($data['phone'])?>">
                        <label for="phonenumber" style="color: red;"><?php echo (!empty($errors['phonenumber'])) ? $errors['phonenumber']:'' ?></label>
                    </div>
                    <div class="form-group m-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password.." class="form-control" value="<?php echoOldData($data['password'])?>">
                        <label for="password" style="color: red;"><?php echo (!empty($errors['password'])) ? $errors['password']:'' ?></label>
                    </div>
                    <div class="form-group m-2">
                        <label for="cofirm password">Confirm Password</label>
                        <input type="password" name="confirmpass" placeholder="Password.." class="form-control" value="<?php echoOldData($data['confirmpass'])?>">
                        <label for="confirmpass" style="color: red;"><?php echo (!empty($errors['confirmpass'])) ? $errors['confirmpass']:'' ?></label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class=" m-2 btn btn-primary btn-lg btn-block w-btn-lg btn-shadow">Submit</button>
                    </div>          
                </form>
            </div>
        </div>
</div>



<?php
layouts('footer', '');
?>