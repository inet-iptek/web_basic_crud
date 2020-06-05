<?php 
    // Koneksi Database
    function conn() {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "db_web_basic_crud";

        $conn = new mysqli($host, $user, $pass, $db);

        return $conn;
    }

    function query($s) {
        $conn = conn();

        $data = $conn->query($s);

        // Jika data nya hanya 1
        if($data->num_rows == 1) {
            return $data->fetch_assoc();
        }

        $rows = [];
        while($row = $data->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    function cari($keyword) {
        $conn = conn();
        $cari = $conn->query("SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%'");

        $rows = [];
        while($row = $cari->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    // Upload Gambar
    function upload() {
        $nama_file = $_FILES['gambar']['name'];
        $tipe_file = $_FILES['gambar']['type'];
        $ukuran_file = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmp_file = $_FILES['gambar']['tmp_name'];
        $lokasi_upload = '../img/';

        // Ketika gambar kosong / tidak dipilih
        if($error == 4) {
            echo "<script>
                alert('Gambar kosong');
            </script>";

            return false;
        }

        // Cek ekstensi file
        $daftar_tipe_file = ['jpg','jpeg','png'];
        $ekstensi_file = explode('.', $nama_file);
        $ekstensi_file = strtolower(end($ekstensi_file));
        

        if(!in_array($ekstensi_file, $daftar_tipe_file)) {
            echo "<script>
                alert('Ekstensi file harus jpg, jpeg dan png');
            </script>";
            return false;
        }

        // Cek type file
        if($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
            echo "<script>
                alert('File bukan gambar');
            </script>";
            
            return false;
        }

        // Cek ukuran file
        // Maksimal 1MB = 1000000
        if($ukuran_file > 1000000) {
            echo "<script>
                alert('Ukuran file terlalu besar, file harus dibawah 1MB');
            </script>";
            return false;
        }

        // Jika berhasil dicek
        // upload file ke folder img

        // Generate nama gambar yg baru
        $nama_file_baru = uniqid();
        $nama_file_baru .= '.';
        $nama_file_baru .= $ekstensi_file;

        move_uploaded_file($tmp_file, $lokasi_upload.$nama_file_baru);
        
        return $nama_file_baru;
    }

    // Tambah
    function tambah($data) {
        $conn = conn();

        $nama = htmlspecialchars($data['nama']);
        $nim = htmlspecialchars($data['nim']);
        $jurusan = htmlspecialchars($data['jurusan']);
        $alamat = htmlspecialchars($data['alamat']);
        // Upload Gambar
        $gambar = upload();

        if(!$gambar) {
            return false;
        }

        $conn->query("INSERT INTO mahasiswa(nama,nim,jurusan,alamat,gambar) VALUES('$nama','$nim','$jurusan','$alamat','$gambar')");
        
        return $conn->affected_rows;
    }
?>