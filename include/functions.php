<?php 
require('config.php');

function redirect($location){
    header("location:".$location);
}
function logout(){
    $_SESSION['logged'] = false;
    session_unset();
    session_destroy();
    redirect("home.php");
}