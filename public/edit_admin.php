<?php
include("../includes/layout/header.php");
include("../includes/config.php");
require_once("../includes/sessions.php");
require_once("../includes/functions.php");
require_once("../includes/validations.php");
?>
<?php
$username = "";
if(isset($_GET['admin'])){
    $id = $_GET['admin'];
    $admin = select_admin_by_id($id);
 if(isset($_POST['submit'])){
    $fields_require = array("username","password");
    validate_presences($fields_require);
    if(empty($errors)){
        $username = htmlentities($_POST['username']);
        $password = password_encrypt($_POST['password']);
        $sql_ins = "UPDATE admins set username = '{$username}', password = '{$password}' where id =$id";
        $result = mysqli_query($conn,$sql_ins);
        check_query($result);
        if($result && mysqli_affected_rows($conn)>0){
            $_SESSION['message'] = "Admin Updated Sucessfully.";
            redirect_to("manage_admins.php");
        }else{
            $_SESSION['message'] = "Admin updation failed.";
            redirect_to("manage_admins.php");
        }
    }else  $_SESSION['errors'] = $errors;
 }
}
?>
 <div class="main">
            <div class="navigation">
                &nbsp;
            </div>
            <div class="page">
                <h2 id="heading">Update Admin:<?php echo $admin['username']; ?></h2>
                 <p>Update authorized admin or administrators here.</p>
                 <?php echo form_errors($errors); ?>
                 <?php echo msg_session(); ?>
                 <form method="POST" action="edit_admin.php?admin=<?php echo $admin['id'];?>">
                     <fieldset>
                         <legend>Edit Admin</legend>
                         <p>User Name:
                             <input type="text" name="username"/><br>
                         </p>
                         <p>Password
                             <input type="password" name="password"/><br>
                         </p>
                         <button type="submit" name="submit" value="new admin">Create Admin</button>
                     </fieldset>
                 </form>
            </div>
        </div>
<?php include("../includes/layout/footer.php"); ?>
