<?php
include("../includes/layout/header.php");
include("../includes/config.php");
require_once("../includes/sessions.php");
require_once("../includes/functions.php");
require_once("../includes/validations.php");
?>
<?php
if(isset($_POST['submit'])){
    $fields_require = array("username","password");
    validate_presences($fields_require);
    if(empty($errors)){
        $username = htmlentities($_POST['username']);
        $password = password_encrypt($_POST['password']);
        $sql_ins = "INSERT INTO admins(username,password) values('{$username}','{$password}')";
        $result = mysqli_query($conn,$sql_ins);
        if($result){
            $_SESSION['message'] = "New Admin created sucessfully.";
            redirect_to("manage_admins.php");
        }else{
            $_SESSION['message'] = "{$username},Username already exsist.";
        }
    }else  $_SESSION['errors'] = $errors;
}
?>
 <div class="main">
            <div class="navigation">
                &nbsp;
            </div>
            <div class="page">
                <h2 id="heading">New Admin</h2>
                 <p>Create a new authorized admin or administrator here.</p>
                 <?php echo form_errors($errors); ?>
                 <?php echo msg_session(); ?> 
                 <form method="POST" action="new_admin.php">
                     <fieldset>
                         <legend>New Admin</legend>
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