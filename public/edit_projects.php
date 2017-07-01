<?php
    include("../includes/layout/header.php");
    require_once("../includes/config.php");
    require_once("../includes/functions.php");
    require_once("../includes/validations.php");
    find_selected_pages();
    ?>
    <?php
        if(isset($_POST['new_project'])){
            var_dump($_POST);
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
            <div id="form-nw-prjct">
                <form method="POST" action="edit_project.php">
                    <fieldset>
                    <legend>Edit Project</legend>
                    Name:
                    <input type="text" name="project_title" value = "<?php echo get_project_name($current_project)?>"><br/>
                    Position:
                    <select name ="position">
                    <?php
                    $proje0ct_set = select_all_project();
                    if($project = mysqli_fetch_assoc($project_set)){
                       $output = $project['position']; 
                    }
                    $projects =mysqli_num_rows($project_set);
                    for($count = 1; $count<= $projects ; $count++){
                        echo "<option value=\"{$count}\"";
                        if($output == $count){
                            echo " selected ";
                        }
                        echo ">{$count}</option>";
                    }
                    ?>
                    </select><br/>
                    Visible:
                    <input type="radio" name="visible" value="1">Yes
                    &nbsp;
                    <input type="radio" name="visible" value="0">No<br/>
                    <button type="submit" name="edit_project" value="edit project" onclick="return confirm('Are you sure?')">Edit Project</button>
                    </fieldset>
                </form>
                <a href = "delete_project.php?project=<?php echo $current_project; ?>">Delete Project</a>
            </div>
        </div>
    <?php 
    include("../includes/layout/footer.php");
    ?>