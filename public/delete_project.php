<?php
include("../includes/config.php");
require_once("../includes/sessions.php");
require_once("../includes/functions.php");
find_selected_pages();
if(isset($_GET['project'])){
    $sql_delete = "DELETE from project_name where id = {$current_project} limit 1";
    $project_set=mysqli_query($conn,$sql_delete);
    check_query($project_set);
    if($project_set && mysqli_affected_rows($conn) == 1){
        $_SESSION['message'] = "Project Deletion Sucessful";
        redirect_to("manage_content.php");
    }else{
        $_SESSION['message'] = "Project Deletion Failed.";
        redirect_to("manage_content.php");
    }
}
?>