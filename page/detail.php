<?php 
    require '../function/function.php';

    // Cek Login
    session_start();
    if(!isset($_SESSION['login'])) {
        header('location:../auth/login.php');
        exit;
    }

    
    // ambil id dari url
    // untuk menghindari sql injection gunakan fungsi real_escape_string pada fungsi mysqli
    $conn = conn();
    $id = $conn->real_escape_string($_GET['id']);

    $data = query("SELECT * FROM mahasiswa WHERE id = '$id'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
</head>
<body>
    <h1>Detail Mahasiswa</h1>
    <img src="../img/<?= $data['gambar']; ?>" width="200">
    <table>
        <tr>
            <td>NIM</td>
            <td>:</td>
            <td><?= $data['nim']; ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $data['nama']; ?></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td>:</td>
            <td><?= $data['jurusan']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $data['alamat']; ?></td>
        </tr>
        <tr>
            <td>
                <a href="edit.php?id=<?= $data['id']; ?>">Edit</a>
            </td>
            <td>
                <a onclick="return confirm('Yakin?')" href="hapus.php?id=<?= $data['id']; ?>">Hapus</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="../">Kembali</a>
            </td>
        </tr>
    </table>
</body>
</html>