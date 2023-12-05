<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;

layouts('header','');
$id = $_GET['id'];

$sql = "SELECT * FROM user WHERE ID =".$id."";
$res = select1Raw($sql);
$dataFormDb = ['email'=>$res['email'], 'username'=>$res['username'], 'phone'=>$res['phone']];


$data =['email'=>'', 'username'=>'', 'phone'=>''];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($data as $key => $value) {
        $value = $_POST[$key];
        $data[$key] = $value;
    }
    $errors = arrEmpty($data);
    if(empty($errors)){
    	$dataUpdate = getDataToUpdate($data, $dataFormDb);
    	if(!empty($dataUpdate)){
    		$dataUpdate = setTime($dataUpdate,'update_at');
    		update('user', $dataUpdate, 'ID ='.$id);
            $url= _WEB_HOST.'/?module=&action=';
            echo '<script>
                
                    window.location.href = "'.$url.'";
               
            </script>';
    	}

    }
}
    

?>

<div class=" shadow d-flex justify-content-center align-items-center container ">
        <div class="row " style="width:380px;">
            <div class=" col ">
            	<div class="text-center"> <p>Edit user information</p></div>
               
                <form action="" method="post">
                    <div class="form-group m-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Email..." class="form-control" value="<?php if(isset($res['email']))echo $res['email']?>">
                        <label for="eamil" style="color: red;"><?php echo (!empty($errors['email'])) ? $errors['email']:'' ?></label>
                    </div>
                    <div class="form-group m-2">
                        <label for="username">Usename</label>
                        <input type="usename" name="username" placeholder="Username..." class="form-control" value="<?php if(isset($res['username']))echo $res['username']?>">
                        <label for="username" style="color: red;"><?php echo (!empty($errors['username'])) ? $errors['username']:'' ?></label>
                    </div>
                    <div class="form-group m-2">
                        <label for="number">Phone number</label>
                        <input type="number" name="phone" placeholder="Phone number" class="form-control" value="<?php echo $res['phone']?>">
                        <label for="phonenumber" style="color: red;"><?php echo (!empty($errors['phonenumber'])) ? $errors['phonenumber']:'' ?></label>
                    </div>
               
                   
                    <div class="text-center">
                        <button type="submit" class=" m-2 btn btn-primary btn-lg btn-block w-btn-lg btn-shadow">submit</button>
                    </div>


