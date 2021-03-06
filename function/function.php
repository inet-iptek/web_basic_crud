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
    // Untuk menampikan 1 baris pada table
    function query($s) {
        $conn = conn();

        $data = $conn->query($s);

        return $data->fetch_assoc();
    }
    // Untuk menampilkan banyak data
    function queryAll($s) {
        $conn = conn();

        $data = $conn->query($s);

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
           return 'default.png';
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

    // Hapus
    function hapus($id) {
        $conn = conn();
        $gambar = query("SELECT * FROM mahasiswa WHERE id = '$id'");
        $lokasi_file = '../img/';

        $conn->query("DELETE FROM mahasiswa WHERE id = '$id'");

        if($gambar['gambar'] != 'default.png') {
            unlink($lokasi_file.$gambar['gambar']);
        }

        return $conn->affected_rows;
    }

    // Edit
    function edit($data) {
        
        $conn = conn();

        $id = $data['id'];
        $nama = htmlspecialchars($data['nama']);
        $nim = htmlspecialchars($data['nim']);
        $jurusan = htmlspecialchars($data['jurusan']);
        $alamat = htmlspecialchars($data['alamat']);
        $gambar_lama = $data['gambar_lama'];

        // Jika tidak upload gambar
        if(empty($_FILES['gambar']['name'])) {
            $edit = $conn->query("UPDATE mahasiswa SET nama = '$nama', nim = '$nim', jurusan = '$jurusan', alamat = '$alamat' WHERE id = '$id'");
            if($edit) {
                echo "<script>
                    alert('Berhasil');
                    document.location.href = 'detail.php?id=".$id."';
                </script>";
            } else {
                echo "<script>
                    alert('Gagal');
                    
                </script>";
            }
        } else {
            $gambar = upload();        

            if(!$gambar) {
                return false;
            }
    
            if($gambar == 'default.png') {
                $gambar = $gambar_lama;
            }
            
            $gbr = query("SELECT * FROM mahasiswa WHERE id = '$id'");
            $lokasi_file = '../img/';
    
            if($gbr['gambar'] != 'default.png') {
                unlink($lokasi_file.$gbr['gambar']);
            }

            $edit = $conn->query("UPDATE mahasiswa SET nama = '$nama', nim = '$nim', jurusan = '$jurusan', alamat = '$alamat', gambar = '$gambar' WHERE id = '$id'");
            if($edit) {
                echo "<script>
                    alert('Berhasil');
                    document.location.href = 'detail.php?id=".$id."';
                </script>";
            } else {
                echo "<script>
                    alert('Gagal');
                    
                </script>";
            }
        }

        
    }

    function register($data) {
        $conn = conn();

        $username = htmlspecialchars($data['username']);
        $password1 = $conn->real_escape_string($data['password1']);
        $password2 = $conn->real_escape_string($data['password2']);

        // Jika Username / Password kosong
        if(empty($username) || empty($password1) || empty($password2)) {
            echo "<script>
                alert('Username / Password tidak boleh kosong')
            </script>";
            return false;
        }

        // Jika username sudah ada
        if(query("SELECT * FROM login WHERE username = '$username'")) {
            echo "<script>
                alert('Username sudah terdaftar')
            </script>";
            return false;
        }

        // Jika konfirmasi password tidak sesuai
        if($password1 !== $password2) {
            echo "<script>
                alert('Konfirmasi password tidak sama')
            </script>";
            return false;
        }

        // Jika password kurang dari 5 digit
        if(strlen($password1) < 5) {
            echo "<script>
                alert('Password terlalu pendek')
            </script>";
            return false;
        }

        // Jika Username dan Password sudah sesuai

        // Enkripsi Password
        $password_baru = password_hash($password1, PASSWORD_DEFAULT);

        $conn->query("INSERT into login(username, password) VALUES('$username', '$password_baru')");

        return $conn->affected_rows;
    }

    // Login
    function login($data) {
        session_start();
        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars($data['password']);
        
        // Cek Username
        $user = query("SELECT * FROM login WHERE username = '$username'");

        if($user) {
            // Cek Password
            if(password_verify($password, $user['password'])) {
                // Set Session
                $_SESSION['login'] = TRUE;
                header('location:../');
                exit;
            } else {
                echo "<script>
                alert('Password Salah');
                </script>";
            }
        } else {
            echo "<script>
                alert('Username tidak terdaftar');
            </script>";
        }
        
    }

?>