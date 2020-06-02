<?php 
    require 'function/function.php';
    $data = query("SELECT * FROM mahasiswa");

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Basic Crud</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <a href="">Tambah Data</a>

    <br><br>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="keyword" placeholder="pencarian" size="40" autocomplete="off" autofocus="on">
        <input type="submit" value="cari" name="cari">
    </form>

    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>#</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        <?php 
            $no = 1;
            foreach($data as $dt) :
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><img src="img/<?= $dt['gambar']; ?>" width="100"></td>
            <td><?= $dt['nama']; ?></td>
            <td>
                <a href="detail">Detail</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>