<?php
include("../classes/Admin.php");

$admin = new Admin;

$admin->login_action();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>restricted area</title>
    </head>
    <body>
        <form action="" method="post">
            <fieldset>
                <table> 
                    <tr>
                        <td><label for="username">Username: </label></td>
                        <td><input type="text" name="username" id="username" /></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password: </label></td>
                        <td><input type="password" name="password" id="password" /></td>
                    </tr>
                    <tr>
                        <td><input name="submit" type="submit" value="submit" /></td>
                    </tr>
                </table>    
            </fieldset>
        </form>
    </body>
</html>