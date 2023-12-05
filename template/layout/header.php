<?php
(!defined('_CODE')) ? die('Truy cap khong hop le') : false;
$islogin = getSession('islogin');
$username = getSession('namelogin');

?>
<script src="<?php echo _WEB_HOST_TEMPLE?>/js/script.js"></script>
<nav class="navbar navbar-expand-lg bg-body-tertiary row">

    <div class="container-fluid col">
        <a class="navbar-brand" href="#">Manager Users</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?module=&action=">Home</a>
                </li>
                <?php
                echo ($islogin) ?
                    '<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    '.$username.'
                </a>
                <ul class="dropdown-menu">
                    
                    <li><a class="dropdown-item" href="?module=auth&action=login">Logout</a></li>
                    
                   
                </ul>
                </li>' : '';

                ?>

            </ul>
        </div>
    </div>
    <?php
        echo (!$islogin) ? '<div class="col text-end   ">
        <div class="align-item-center ">
            <a href="?module=auth&action=login" class="btn btn-success" >Login</a>
            <a href="?module=auth&action=register" class="btn btn-outline-success" >Register</a>
        </div>
    </div>':'';
    ?>
    
</nav>
<br>