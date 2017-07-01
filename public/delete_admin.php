<?php 
require_once("../includes/sessions.php");
require_once("../includes/functions.php");
include("../includes/config.php");
if(isset($_GET['admin'])){
     $id = $_GET['admin'];
    $sql_del  = "DELETE from admins where id = {$id} limit 1";
    $admin_set = mysqli_query($conn,$sql_del);
    check_query($admin_set);
    if($admin_set && mysqli_affected_rows($conn) ==1){
        $_SESSION['message'] = "Admin Deleted Sucessfully.";
        redirect_to("manage_admins.php");
    }
    else{
        $_SESSION['message']  ="Admin Deletion Failed.";
        redirect_to("manage_admins.php");
    }
}
?>