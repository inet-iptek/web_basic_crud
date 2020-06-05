<?php

    require '../function/function.php';

    // Cek Login
    session_start();
    if(!isset($_SESSION['login'])) {
        header('location:../auth/login.php');
        exit;
    }

    
    // Jika tidak ada id di url
    if(!isset($_GET['id'])) {
        header('location:../');
        exit;
    }
    
    // Ambil id di url
    // untuk menghindari sql injection gunakan fungsi real_escape_string pada fungsi mysqli
    $conn = conn();
    $id = $conn->real_escape_string($_GET['id']);

    // menampilkan data mahasiswa berdasarkan id
    $dt = query("SELECT * FROM mahasiswa WHERE id = '$id'");

    // Jika tombil edit ditekan
    if(isset($_POST['edit'])) {
        if(edit($_POST) > 0) {
            echo "<script>
                alert('Berhasil');
            </script>>";
            header('location:detail.php?id='. $id);
            exit;
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
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $dt['id']; ?>">
        <table>
            <tr>
                <th>Nama</th>
                <td>:</td>
                <td>
                    <input type="text" name="nama" placeholder="Nama" required value="<?= $dt['nama']; ?>">
                </td>
            </tr>
            <tr>
                <th>NIM</th>
                <td>:</td>
                <td>
                    <input type="text" name="nim" placeholder="NIM" required value="<?= $dt['nim']; ?>">
                </td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>:</td>
                <td>
                    <input type="text" name="jurusan" placeholder="Jurusan" required value="<?= $dt['jurusan']; ?>">
                </td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>:</td>
                <td>
                    <input type="text" name="alamat" placeholder="Alamat" required value="<?= $dt['alamat']; ?>">
                </td>
            </tr>
            <tr>
                <input type="hidden" name="gambar_lama" value="<?= $dt['gambar']; ?>">
                <th>Gambar</th>
                <td>:</td>
                <td>
                    <input type="file" name="gambar">
                   
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <input type="submit" name="edit" value="Edit">
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