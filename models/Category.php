<?php
require_once 'config/Database.php';

class Category {
    private $conn;
    private $table = 'categories';

    public function __construct() {
        // SỬA 1: Dùng Database::connect() để đồng bộ với hệ thống
        $this->conn = Database::connect();
    }

    // SỬA 2: Đổi tên thành findAll() để khớp với CourseController
    public function findAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>