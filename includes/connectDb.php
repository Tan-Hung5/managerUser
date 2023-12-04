<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;

require_once('config.php');

try {
    if(class_exists('PDO')) {
        $dsn = 'mysql:dbname='._DB.'; host='._HOST;
        $option = [
            PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        $conn = new PDO($dsn,_USER,_PASSWORD, $option);
    }
} catch (PDOException $e) {
    echo''. $e->getMessage() .'</br>';
    echo $e->getFile().'</br>';
    echo $e->getLine().'';
    die();
}
?>
