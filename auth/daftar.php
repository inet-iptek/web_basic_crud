<?php 
    require '../function/function.php';

    // Jika tombol daftar di klik
    if(isset($_POST['register'])) {
        if(register($_POST) > 0) {
           echo "<script>
                alert('Berhasil');
                document.location.href = 'login.php';
           </script>";
        } else {
            echo "Gagal";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
</head>
<body>
    <h1>Daftar</h1>
    <form action="" method="post">
        <table>
            <tr>
                <th>Username</th>
                <td>:</td>
                <td>
                    <input type="text" name="username" placeholder="Username">
                </td>
            </tr>
            <tr>
                <th>Password</th>
                <td>:</td>
                <td>
                    <input type="password" name="password1" placeholder="Password">
                </td>
            </tr>
            <tr>
                <th>Konfirmasi Password</th>
                <td>:</td>
                <td>
                    <input type="password" name="password2" placeholder="Konfirmasi Password">
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <input type="submit" name="register" value="Daftar">
                </td>
            </tr>
            
            
        </table>
    </form>
</body>
</html>