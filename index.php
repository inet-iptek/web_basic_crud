<?php 
    require 'function/function.php';
    $data = query("SELECT * FROM mahasiswa");

    // jika tombol cari di klik
    if(isset($_POST['cari'])) {
        $data = cari($_POST['keyword']);
    }
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
        <input class="keyword" type="text" name="keyword" placeholder="pencarian" size="40" autocomplete="off" autofocus="on">
        <input type="submit" value="Cari" name="cari">
    </form>

    <br>

    <div class="container">

        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>#</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
            <?php if(empty($data)) : ?>
            <tr>
                <td colspan="4">Data tidak ditemukan!</td>
            </tr>
            <?php endif; ?>
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

    </div>

    <script src="js/script.js"></script>

</body>
</html>