<?php
//Change this on server
require_once("..\includes\initialize.php");

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $found_user = User::authenticate($username, $password);
    
    if ($found_user) {
        $session->login($found_user);
        $log_message = $username . " logged in.";
        $message = Logger::log_action('Login', $log_message);
        if ($message == 'OK') {
            redirect_to("home.php");            
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
        <form action="index.php" method="post">
            <table>
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
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Login">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>