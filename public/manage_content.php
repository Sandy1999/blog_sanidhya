<?php
     include("../includes/layout/header.php");
     include("../includes/config.php");
     require_once("../includes/sessions.php");
     require_once("../includes/functions.php");
      find_selected_pages();
     ?>        
        <div class="main">
            <div class="navigation">
                &nbsp;
                <?php 
                echo"<a href=\"admin.php\"><< Back to main menu</a>";
                navigation();
                echo"<a href=\"new_project.php\">"."+ Add New Project"."</a>";
                 ?>
            </div>
            <div class="page">
            <?php
                 msg_session();
               if($current_project){
                   print_project($current_project);
               }elseif($current_page){
                   print_page($current_page);
               }else{
                   echo"Please select a Project or a Page.";
               }
               ?>
            </div>
        </div>
<?php 
     include("../includes/layout/footer.php");
     ?>