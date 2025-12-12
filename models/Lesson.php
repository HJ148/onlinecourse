<?php
// require_once '../config/Database.php';

class Lesson {
    private $conn;
    private $table = 'lessons';

    public function __construct() {
        $this->conn = Database::connect();
    }
    
    // ... các hàm find, findByCourseId ...

    /**
     * Tạo bài học mới
     */
    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' 
                  (course_id, title, content, video_url, `order`) 
                  VALUES (:course_id, :title, :content, :video_url, :order)';
        
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':course_id', $data['course_id']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':video_url', $data['video_url']);
        $stmt->bindParam(':order', $data['order']);

        return $stmt->execute();
    }
    
    
    /** Lấy bài học theo khóa học */
    public function getByCourseId($course_id) {
        $query = "SELECT * FROM $this->table WHERE course_id = :course_id ORDER BY `order` ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":course_id", $course_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Lấy bài học theo ID */
    public function find($id) {
        $query = "SELECT * FROM $this->table WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Cập nhật bài học */
    public function update($id, $data) {
        $query = "UPDATE $this->table SET title=:title, content=:content, video_url=:video_url, `order`=:order
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $data['title']);
        $stmt->bindParam(":content", $data['content']);
        $stmt->bindParam(":video_url", $data['video_url']);
        $stmt->bindParam(":order", $data['order']);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    /** Xóa bài học */
    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>