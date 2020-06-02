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
?>