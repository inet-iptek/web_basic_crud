<?php 
    require '../function/function.php';

    $id = $_GET ['id'];

    if(hapus($id) > 0) {
        echo "<script>
            alert('Berhasil');
            document.location.href = '../';
        </script>";
    } else {
        echo "<script>
            alert('Gagal');
            document.location.href = '../';
        </script>";
    }
?>