<?php
// require_once '../config/Database.php'; // Điều chỉnh đường dẫn theo cấu trúc autoload/include thực tế

class Course {
    private $conn;
    private $table = 'courses';

    public function __construct() {
        $this->conn = Database::connect(); // Sử dụng kết nối từ Database.php
    }

    /**
     * Lấy danh sách khóa học của một giảng viên (instructor_id)
     */
    public function findByInstructor($instructor_id) {
        $query = 'SELECT c.*, u.fullname as instructor_name FROM ' . $this->table . ' c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  WHERE c.instructor_id = :instructor_id 
                  ORDER BY c.created_at DESC';
        
        $stmt = $this->conn->prepare($query);
        // Ngăn chặn SQL Injection
        $stmt->bindParam(':instructor_id', $instructor_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Tạo khóa học mới
     */
    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' 
                  (title, description, instructor_id, category_id, price, duration_weeks, level, image) 
                  VALUES (:title, :description, :instructor_id, :category_id, :price, :duration_weeks, :level, :image)';
        
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':instructor_id', $data['instructor_id']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':duration_weeks', $data['duration_weeks']);
        $stmt->bindParam(':level', $data['level']);
        $stmt->bindParam(':image', $data['image']);

        return $stmt->execute();
    }
    
    /**
     * Cập nhật khóa học
     */
    public function update($id, $data) {
        $query = 'UPDATE ' . $this->table . ' 
                  SET title = :title, description = :description, category_id = :category_id, 
                      price = :price, duration_weeks = :duration_weeks, level = :level, image = :image 
                  WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':duration_weeks', $data['duration_weeks']);
        $stmt->bindParam(':level', $data['level']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Xóa khóa học
     */
    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /** Lấy tất cả khóa học */
    public function findAll() {
        $query = "SELECT c.*, u.fullname as instructor_name, cat.name as category_name
                  FROM $this->table c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  ORDER BY c.created_at DESC";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Tìm khóa học theo ID */
    public function findById($id) {
        $query = "SELECT * FROM $this->table WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Tìm khóa học theo danh mục */
    public function findByCategory($category_id) {
        $query = "SELECT * FROM $this->table WHERE category_id = :category_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Tìm kiếm khóa học */
    public function search($keyword) {
        $query = "SELECT * FROM $this->table WHERE title LIKE :keyword";
        $stmt = $this->conn->prepare($query);
        $kw = "%$keyword%";
        $stmt->bindParam(":keyword", $kw);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>