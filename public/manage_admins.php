<?php
     include("../includes/layout/header.php");
     include("../includes/config.php");
     require_once("../includes/sessions.php");
     require_once("../includes/functions.php");
     ?>
      <div class="main">
            <div class="navigation">
                <a href="admin.php"> &laquo; Main Menu</a>
            </div>
            <div class="page">
                <h2 id="heading">Manage Admins</h2>
                 <p>Create,update or delete admins.</p>
                 <?php echo msg_session(); ?>
                <?php
                select_all_admins();
                ?>
                <a href="new_admin.php">+ Add new Admin</a>
            </div>
        </div>
<?php include("../includes/layout/footer.php"); ?>