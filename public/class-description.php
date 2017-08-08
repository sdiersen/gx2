<!DOCTYPE html>
<?php
    require_once("..\includes\initialize.php");
    
	if (isset($_POST['submit'])) {
        $crud = trim($_POST['crud']);
		
		if($crud == 'create') 
		{
				
		} else if ($crud == 'read')
		{
			
		} else if ($crud == 'update')
		{
			
		} else if ($crud == 'delete')
		{
			
		}
    }
    
?>
<html>
    <head>
        <title>Group Fitness Login</title>
        <meta lang="en" charset="utf-8">
    </head>
    <body>
		 <form action="class-description.php" method="post">
            <table>
                <tr>
                    <table style="border:2px solid black">
                        <tr>
                            <td colspan="4" style="text-align:center">CRUD</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="crud" value="create" checked="checked">Create
                            </td>
                            <td>
                                <input type="radio" name="crud" value="read">Read
                            </td>
                            <td>
                                <input type="radio" name="crud" value="update">Update
                            </td>
                            <td>
                                <input type="radio" name="crud" value="delete">delete
                            </td>
                        </tr>
                    </table>
                </tr>
			 </table>
			Name: <input type="text" name="name" maxlength="30"><br>
			 Description: <textarea rows=4 cols=50 name=gxdesc></textarea><br>
             <input type="submit" name="submit" value="Submit">
             </form>
	</body>
</html>