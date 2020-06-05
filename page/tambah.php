<?php

    require '../function/function.php';

    if(isset($_POST['tambah'])) {
        if(tambah($_POST) > 0) {
            echo "Berhasil";
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
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th>Nama</th>
                <td>:</td>
                <td>
                    <input type="text" name="nama" placeholder="Nama" required>
                </td>
            </tr>
            <tr>
                <th>NIM</th>
                <td>:</td>
                <td>
                    <input type="text" name="nim" placeholder="NIM" required>
                </td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>:</td>
                <td>
                    <input type="text" name="jurusan" placeholder="Jurusan" required>
                </td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>:</td>
                <td>
                    <input type="text" name="alamat" placeholder="Alamat" required>
                </td>
            </tr>
            <tr>
                <th>Gambar</th>
                <td>:</td>
                <td>
                    <input type="file" name="gambar">
                   
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <input type="submit" name="tambah" value="Tambah">
                </td>
            </tr>
            <tr>
                <td>
                    <a href="../">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>