<?php
// echo 'home';
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
// if(empty($_SERVER['PATH_INFO'])){
//     $url = $_SERVER['PATH_INFO'];
// }
// else {
//     $url ='/';
// }
    
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once 'bootstrap.php';
$app = new App();
// echo $url;
?>
