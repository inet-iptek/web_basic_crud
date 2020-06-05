<?php 
    require '../function/function.php';

    if(isset($_POST['login'])) {
        login($_POST);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <table>
            <tr>
                <th>Username</th>
                <td>:</td>
                <td>
                    <input type="text" name="username" placeholder="Username" required autofocus>
                </td>
            </tr>
            <tr>
                <th>Password</th>
                <td>:</td>
                <td>
                    <input type="password" name="password" placeholder="Password" required>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <input type="submit" name="login" value="Login">
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <a href="daftar.php">Daftar</a>
                </td>
            </tr>
            
        </table>
    </form>
</body>
</html>