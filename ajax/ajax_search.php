<?php 
    require '../function/function.php';

    $data = cari($_GET['keyword']);
?>

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