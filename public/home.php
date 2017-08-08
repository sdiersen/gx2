<!DOCTYPE html>
<?php
    require_once("..\includes\initialize.php");
    if(!$session->is_logged_in()) {
        redirect_to("admin-login.php");
    }
?>
<html>
    <head>
        
    </head>
    <body>
        <h1>You Made it</h1>
    </body>
</html>

