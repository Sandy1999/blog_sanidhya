<?php
require_once("../includes/sessions.php");
require_once("../includes/functions.php");

session_start();
$_COOKIE = array();
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-42000,"/");
}
session_destroy();
redirect_to("login.php");

?>
