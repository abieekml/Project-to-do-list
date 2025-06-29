<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'todo_app';
    private $username = 'root';   
    private $password = '';       
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e) {
            die("Koneksi Database Gagal: " . $e->getMessage() .
                "<br>Mohon periksa:
                <br>1. XAMPP MySQL sudah Running.
                <br>2. Nama Database '" . $this->db_name . "' di phpMyAdmin sudah benar.
                <br>3. Username/Password di database.php sudah sesuai (default XAMPP: root / kosong).");
        }

        return $this->conn; // Jika koneksi berhasil, ini akan mengembalikan objek PDO, jika tidak, die() sudah dieksekusi
    }
}
?>