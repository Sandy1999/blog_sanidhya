<?php
function redirect_to($url){
 header("Location: {$url}");
 exit;
}//redirect_to function ends here e
function check_query($value){
    if(!$value){
        die("Query Failed");
    }
}// Check_query function ends here
function select_all_project(){
    global $conn;
    $sql_project = "SELECT * from project_name";
    $project_set = mysqli_query($conn,$sql_project);
    check_query($project_set);
    return $project_set; 
}// Selected_all_project function ends here 
function select_pages_by_project($project_id){
 global $conn;
 $sql_page = "SELECT * from pages where project_id = {$project_id['id']}";
 $page_set = mysqli_query($conn,$sql_page);
 check_query($page_set);
 return $page_set;
}//selected_pages_by_project function ends here
function select_project_by_id($project_id){
  global $conn;
  $sql_project = "SELECT * from project_name where id = {$project_id}";
  $project_set = mysqli_query($conn,$sql_project);
  check_query($project_set);
  return $project_set;
}// select_project_by_id ends here 
function select_pages_by_id($page_id){
  global $conn;
  $sql_page = "SELECT * from pages where id = {$page_id}";
  $page_set = mysqli_query($conn,$sql_page);
  check_query($page_set);
  return $page_set;   
}// select page by id function ends here
function select_project_by_pages($page_id){
    global $conn;
    $sql_page = "SELECT * from pages where id={$page_id} limit 1";
    $page_set = mysqli_query($conn,$sql_page);
    check_query($page_set);
    if($page = mysqli_fetch_assoc($page_set)){
        $project_id = $page['project_id'];
    }
    return $project_id;
}// select_project_by_pages function ends here
function check_visible($value){
    if($value['visible']==1){
        $output = "Yes";
    }elseif($value['visible']==0){
        $output = "No";
    }
    return $output;
}// check_visible fucntion ends here
function find_selected_pages(){
    global $current_project;
    global $current_page;
     if(isset($_GET['project'])){
             $current_project = $_GET['project'];
             $current_page    = null;
         }elseif(isset($_GET['page'])){
             $current_page = $_GET['page'];
             $current_project = null;
         }else{
             $current_page = null;
             $current_project =null;
         }
}//find_selected_pages function ends here
function get_project_name($value){
    $project_set = select_project_by_id($value);
    if($project = mysqli_fetch_assoc($project_set)){
        return $project['project_title'];
    }
}// get_project_details function ends here
function select_all_admins(){
    global $conn;
    $sql_admin = "SELECT * FROM admins";
    $admin_set = mysqli_query($conn,$sql_admin);
    check_query($admin_set);
    echo"<table>";
    echo"<tr>";
    echo"<th width=\"400\">Username</th>";
    echo"<th width=\"75\">Action</th>";
    echo"</tr>";
    while($admins = mysqli_fetch_assoc($admin_set)){
        echo"<tr>";
        echo"<td>".$admins['username']."</td>";
        echo"<td><a href=\"edit_admin.php?admin=".$admins['id']."\">Edit</a>&nbsp<a href=\"delete_admin.php?admin=".$admins['id']."\">Delete</a></td>";
        echo"</tr>"; 
    }
    echo"</table>";
}// select_all_admins function ends here
function select_admins_by_username($username){
    global $conn;
    $sql_admin = "SELECT * from admins where username = '{$username}'";
    $admin_set = mysqli_query($conn,$sql_admin);
    return $admin_set;
}//select admin by username ends here
function select_admin_by_id($admin_id){
    global $conn;
    $sql_admin = "SELECT * from admins where id = {$admin_id}";
    $admin_set = mysqli_query($conn,$sql_admin);
    check_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set))
    return $admin;
}// select admin by id ends here 
/*------------------------------------------------------------------------------------------------------------*/ 
// Navigation and printing Functions Start here
function navigation(){
    $project_set = select_all_project();
    echo"<ul class = \"prjct-nm\">";
    while($project = mysqli_fetch_assoc($project_set)){
        echo"<li><a href = \"manage_content.php?project=".urlencode($project['id'])."\">".$project['project_title']."</a></li>";
        $page_set=select_pages_by_project($project);
        echo"<ul class =\"pages\">";
        while($page = mysqli_fetch_assoc($page_set)){
         echo"<li><a href = \"manage_content.php?page=".urlencode($page['id'])."\">".$page['page_name']."</a></li>";
        }
        echo"</ul>";
    }
    echo"</ul><br/><br/><br/>";
}// Navigation Function Ends here 
function print_project($value){
    echo"<div class=\"prjct-prnt\">";
    echo"<h2>Manage Projects</h2>";
    $project_set = select_project_by_id($value);
    if($project = mysqli_fetch_assoc($project_set)){
        echo"<h3>".$project['project_title']."</h2>";
        echo"Position: ".$project['position']."<br>";
        echo"Visible:  ".check_visible($project)."<br>";
        echo"<a href=\"edit_projects.php?project={$project['id']}\">Edit Project</a>";
        echo"<hr/>";
    }
    $page_set = select_pages_by_project($project);
    echo"<h3>Pages in ".$project['project_title']."</h3>";
    echo "<ul class \"prijct-pg-prnt\">";
    while($page = mysqli_fetch_assoc($page_set)){
        echo"<li><a href =\"manage_content.php?page=".$page['id']."\">".$page['page_name']."</a></li>";
    }
    echo"</ul>";
    echo"<br/><br/>";
    echo"<a href= \"new_page.php?project={$project['id']}\">+Add new Page</a>";
    echo"</div>";
}// print_subject funtion ends here 
function print_page($value){
    $project_id = select_project_by_pages($value);
    $project_set = select_project_by_id($project_id);
    if($project = mysqli_fetch_assoc($project_set)){
        echo"<h3>".$project['project_title']."</h2>";
        echo"Position: ".$project['position']."<br>";
        echo"Visible:  ".check_visible($project)."<br>";
        echo"<a href=\"edit_projects.php?project={$project['id']}\">Edit Project</a>";
        echo"<hr/>";
    }
    $page_set = select_pages_by_id($value);
    if($page = mysqli_fetch_assoc($page_set)){
        echo"<h3>".$page['page_name']."</h2>";
        echo"Position: ".$page['position']."<br>";
        echo"Visible:  ".check_visible($page)."<br>";
        echo"Content:<br/>".$page['content']."<br/>";
        echo"<a href=\"#\">Edit Page</a>";
    }
}//print_page function ends here 
/*-------------------------------------------------------------------------------------------------------------*/
// We are creating some encryption functions here 
function password_encrypt($password){
    $hash_format = "$2y$10$";
    $salt_lenght = 22;
    $salt= generate_salt($salt_lenght);
    $format_and_salt = $hash_format.$salt;
    $hash = crypt($password,$format_and_salt);
    return $hash;    
}// password_encrypt function ends here
function generate_salt($salt_lenght){
    $unique_salt_string = md5(uniqid(mt_rand(),true));
    $base64_encoding = base64_encode($unique_salt_string);
    $modified_base64_encoding = str_replace("+",".",$base64_encoding);
    $salt = substr($modified_base64_encoding,0,$salt_lenght);
    return $salt;
}// generate_salt function ends here  
function check_password($password,$exsisting_hash){
    $hash = crypt($password,$exsisting_hash);
    if($hash == $exsisting_hash){
        return $hash;
    }
}// check password function ends here
function attempt_login($username,$password){
    $admin_set = select_admins_by_username($username);
    if($admin = mysqli_fetch_assoc($admin_set)){
        if(check_password($password,$admin['password'])){
            return $admin;
        }else return false;
    }else return false; 
}// atempt login function ends here 
?>