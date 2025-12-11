<?php
// require_once '../config/Database.php';

class Material {
    private $conn;
    private $table = 'materials';

    public function __construct() {
        $this->conn = Database::connect();
    }

    /**
     * Thêm tài liệu mới vào CSDL
     */
    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' 
                  (lesson_id, filename, file_path, file_type) 
                  VALUES (:lesson_id, :filename, :file_path, :file_type)';
        
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':lesson_id', $data['lesson_id']);
        $stmt->bindParam(':filename', $data['filename']);
        $stmt->bindParam(':file_path', $data['file_path']);
        $stmt->bindParam(':file_type', $data['file_type']);

        return $stmt->execute();
    }
    
    /** Lấy tất cả tài liệu của 1 bài học */
    public function getByLessonId($lesson_id) {
        $query = "SELECT * FROM $this->table WHERE lesson_id = :lesson_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":lesson_id", $lesson_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Xóa tài liệu */
    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>