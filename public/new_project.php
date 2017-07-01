<?php
    include("../includes/layout/header.php");
    require_once("../includes/sessions.php");
    require_once("../includes/config.php");
    require_once("../includes/functions.php");
    require_once("../includes/validations.php");
    ?>
    <?php
        if(isset($_POST['new_project'])){
            if(!isset($_POST['visible'])){
                $_POST['visible'] = null;
            }
            $field_require = array('project_title','position','visible');
            validate_presences($field_require);
            if(empty($errors)){
                $project_title = $_POST['project_title'];
                $position      = (int)$_POST['position'];
                $visible       = (int)$_POST['visible'];
                $sql_ins = "INSERT into project_name(project_title,position,visible) values('{$project_title}',{$position},{$visible})";
                $project_set = mysqli_query($conn,$sql_ins);
                check_query($project_set);
                if($project_set && mysqli_affected_rows($conn)==1){
                    $_SESSION['message'] = "Project Creation Sucessfull";
                    redirect_to("manage_content.php");
                }else {
                    $_SESSION['message'] = "Project Creation Failed";
                    redirect_to("manage_content.php");
                }
            }else{
                $_SESSION['errors'] = $errors;
                redirect_to("new_project.php");
            }            
        }
        ?>
    <div class="main">
            <div class="navigation">
                &nbsp;
                <?php navigation(); ?>
            </div>
            <div class="page">
            <div id="heading">
                <h3>Create a new Project</h3>
                <p>In this section you write about your new Project and about it,
                    you just need to enter its <strong>Name,Position and Visiblity</strong>of your new page 
                    in the given below form.</p>
            </div>
                        <?php
            echo form_errors($errors);
            ?>
            <div id="form-nw-prjct">
                <form method="POST" action="new_project.php">
                    <fieldset>
                    <legend>Edit Project</legend>
                    Name:
                    <input type="text" name="project_title"><br/>
                    Position:
                    <select name ="position">
                    <?php
                      $project_set = select_all_project();
                      $projcts = mysqli_num_rows($project_set);
                      for($count = 1; $count <=($projcts+1);$count++){
                          echo"<option value=\"{$count}\">{$count}</option>";
                      }
                      ?>
                    </select><br/>
                    Visible:
                    <input type="radio" name="visible" value="1">Yes
                    &nbsp;
                    <input type="radio" name="visible" value="0">No<br/>
                    <button type="submit" name="new_project" value="new project" onclick="return confirm('Are you sure?')">Create Project</button>
                    </fieldset>
                </form>
            </div>
        </div>
    <?php 
    include("../includes/layout/footer.php");
    ?>