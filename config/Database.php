<?php
class Database {
    private $host = "localhost";    // máy chủ MySQL, thường là localhost
    private $db_name = "onlinecourse"; // tên CSDL
    private $username = "root";     // user MySQL
    private $password = "";         // password MySQL
    private $conn;

    // Hàm kết nối
    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );

            // Hiển thị lỗi dưới dạng Exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo "Lỗi kết nối: " . $e->getMessage();
            exit;
        }

        return $this->conn;
    }
}
