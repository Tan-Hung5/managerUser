<?php

session_start();
require_once("config.php");
require_once("includes/connectDb.php");
require_once("includes/phpmailer/Exception.php");
require_once("includes/phpmailer/PHPMailer.php");
require_once("includes/phpmailer/SMTP.php");
require_once("includes/phpmailer/bodymail.php");
require_once("includes/sendmail.php");
require_once("includes/session.php");
require_once("includes/functions.php");
require_once("includes/database.php");


$module = _MODULE;
$action = _ACTION;

if(!empty($_GET['module'])){
    if(is_string($_GET['module'])){
        $module = $_GET['module'];
    }    
}

if(!empty($_GET['action'])){
    if(is_string($_GET['action'])){
        $action = $_GET['action'];
    }    
}


$path = 'modules/'.$module.'/'.$action.'.php';

if(file_exists($path)){
    require_once($path);
}
else{
    require_once('modules/error/404.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (empty($title)) ? 'Usermanager': $title;?></title>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLE?>/css/style.css">
    <script src="<?php echo _WEB_HOST_TEMPLE?>/js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="d-inline " style=" width: max-content;" >


</html>


