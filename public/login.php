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
        $password = $_POST['password'];
        $found_admin = attempt_login($username,$password);
        if($found_admin){
            $_SESSION['user_id'] = $found_admin['id'];
            $_SESSION['user_name'] = $found_admin['username'];
            redirect_to("admin.php");
        }else{
            $_SESSION['message'] = "Invalid Username/Password";
        }
    }else  $_SESSION['errors'] = $errors;
}
?>
 <div class="main">
            <div class="navigation">
                &nbsp;
            </div>
            <div class="page">
                <h2 id="heading">Login</h2>
                 <?php echo form_errors($errors); 
                       echo msg_session();
                 ?> 
                 <form method="POST" action="login.php">
                     <fieldset>
                         <legend>Login</legend>
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