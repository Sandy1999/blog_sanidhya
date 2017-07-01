<?php
$db_host = "localhost";
$db_user = "sanidhya";
$db_pwd  = "sanidhya@blog";
$db_name = "blog_sanidhya";
// we are about to set connection between database and php
$conn  = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);
if(!$conn){
    die("Connection Failed".mysqli_error($conn));
}

