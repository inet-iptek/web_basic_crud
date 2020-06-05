<?php 
    require '../function/function.php';

    // Cek Login
    session_start();
    if(!isset($_SESSION['login'])) {
        header('location:../auth/login.php');
        exit;
    }

    $id = $_GET ['id'];

    if(empty($id)) {
        header('location:../');
        exit;
    }
    
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