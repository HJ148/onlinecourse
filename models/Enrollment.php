<?php
require_once 'config/Database.php';

class Enrollment {
    private $conn;
    private $table = 'enrollments';

    public function __construct() {
        $this->conn = Database::connect();
    }

    // Lấy danh sách khóa học mà User ID này đã đăng ký
    public function getMyCourses($userId) {
        // JOIN bảng enrollments với courses để lấy tên, ảnh, giá...
        $query = "SELECT c.*, e.progress, e.enrolled_at 
                  FROM " . $this->table . " e
                  JOIN courses c ON e.course_id = c.id
                  WHERE e.user_id = :user_id
                  ORDER BY e.enrolled_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đăng ký khóa học mới
    public function enroll($userId, $courseId) {
        // 1. Kiểm tra xem đã đăng ký chưa
        $checkQuery = "SELECT * FROM " . $this->table . " WHERE user_id = :uid AND course_id = :cid";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':uid', $userId);
        $stmt->bindParam(':cid', $courseId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false; // Đã đăng ký rồi
        }

        // 2. Nếu chưa thì thêm mới
        $query = "INSERT INTO " . $this->table . " (user_id, course_id, progress) VALUES (:uid, :cid, 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':uid', $userId);
        $stmt->bindParam(':cid', $courseId);

        return $stmt->execute();
    }
}
?>