<?php
     include("../includes/layout/header.php");
     require_once("../includes/sessions.php");
     require_once("../includes/functions.php");
     ?>       
        <div class="main">
            <div class="navigation">
                &nbsp;
            </div>
            <div class="page">
                <h2 id="heading">Admin Menu</h2>
                 <p>Welcome to Admin Area,<?php echo htmlentities($_SESSION['user_name']);?> !!</p>
                <ul class="admn-mnu">
                    <li><a href="manage_content.php">Manage Content</a></li>
                    <li><a href="manage_admins.php">Manage Admin</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </div>
        </div>
<?php 
     include("../includes/layout/footer.php");
     ?>