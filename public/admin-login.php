<!DOCTYPE html>
<?php
    require_once("..\includes\initialize.php");
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    
        $found_user = User::authenticate($username, $password);
    
        if ($found_user) {
            $privilege = trim($_POST['privilege']);
            if ($privilege == 'default') {
                $session->login($found_user);
            } else {
                $session->login($found_user, $privilege);
            }
            $priv = $session->get_session_priv();
            $log_message = $username . " logged in as " . $priv . ".";
            $message = Logger::log_action('Login', $log_message);
            if ($message == 'OK') {
                if ($priv == "admin") {
                    redirect_to("../private/admin-home.php");
                }
                if ($priv == "guest") {
                    redirect_to("guest-home.php");
                }
                if ($priv == "instructor") {
                    redirect_to("home.php");
                }
            } 
        } else {
            $message = $username . " " . $password . " Username/password combination incorrect.";
        }
    } else {
        $username = "";
        $password = "";
        $message = "";
    }
?>

<html>
    <head>
        <title>Group Fitness Login</title>
        <meta lang="en" charset="utf-8">
    </head>
    <body>
        <h2>Staff Login</h2>
        <?php echo output_message($message); ?>
        <form action="admin-login.php" method="post">
            <table>
                <table style="border:2px solid black">
                    <tr>
                        <td>Username</td>
                        <td>
                            <input type="text" name="username" maxlength="20"
                                   value="<?php echo htmlentities($username); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" maxlength="30"
                                   value="<?php echo htmlentities($password); ?>">
                        </td>
                    </tr>
                </table>
                <tr>
                    <table style="border:2px solid black">
                        <tr>
                            <td colspan="4" style="text-align:center">View</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="privilege" value="admin">Admin
                            </td>
                            <td>
                                <input type="radio" name="privilege" value="instructor">Instructor
                            </td>
                            <td>
                                <input type="radio" name="privilege" value="guest">Guest
                            </td>
                            <td>
                                <input type="radio" name="privilege" value="default" checked="checked">Default
                            </td>
                        </tr>
                    </table>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Login">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>

