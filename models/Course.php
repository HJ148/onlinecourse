<?php
require_once 'config/Database.php';

class Course {
    private $conn;
    private $table = 'courses';

    public function __construct() {
        $this->conn = Database::connect(); 
    }

    /**
     * 1. Lấy tất cả khóa học (Dùng cho Student Dashboard)
     * Sửa: u.name -> u.fullname
     */
    public function getAll($keyword = '') {
        $query = "SELECT c.*, u.username as instructor_name, cat.name as category_name
                  FROM " . $this->table . " c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  WHERE 1=1";
        
        if (!empty($keyword)) {
            $query .= " AND c.title LIKE :keyword";
        }
        
        $query .= " ORDER BY c.id DESC";

        $stmt = $this->conn->prepare($query);

        if (!empty($keyword)) {
            $kw = "%$keyword%";
            $stmt->bindParam(":keyword", $kw);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 2. Lấy khóa học của Giảng viên
     * Sửa: u.name -> u.fullname
     */
    public function findByInstructor($instructor_id) {
        $query = 'SELECT c.*, u.fullname as instructor_name FROM ' . $this->table . ' c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  WHERE c.instructor_id = :instructor_id 
                  ORDER BY c.id DESC';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':instructor_id', $instructor_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 3. Lấy chi tiết 1 khóa học
     * Sửa: u.name -> u.fullname
     */
    public function getById($id) {
        $query = "SELECT c.*, u.fullname as instructor_name, cat.name as category_name
                  FROM " . $this->table . " c
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  LEFT JOIN users u ON c.instructor_id = u.id
                  WHERE c.id = :id LIMIT 1";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // --- CÁC HÀM CREATE, UPDATE, DELETE (GIỮ NGUYÊN) ---

    public function create($data) {
        $query = 'INSERT INTO ' . $this->table . ' 
                  (title, description, instructor_id, category_id, price, duration_weeks, level, image) 
                  VALUES (:title, :description, :instructor_id, :category_id, :price, :duration_weeks, :level, :image)';
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':instructor_id', $data['instructor_id']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':price', $data['price']);
        
        $weeks = $data['duration_weeks'] ?? 0;
        $lvl = $data['level'] ?? 'Cơ bản';
        
        $stmt->bindParam(':duration_weeks', $weeks);
        $stmt->bindParam(':level', $lvl);
        $stmt->bindParam(':image', $data['image']);

        return $stmt->execute();
    }

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
        
        $weeks = $data['duration_weeks'] ?? 0;
        $lvl = $data['level'] ?? 'Cơ bản';
        
        $stmt->bindParam(':duration_weeks', $weeks);
        $stmt->bindParam(':level', $lvl);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    // Alias cho getById
    public function findById($id) {
        return $this->getById($id);
    }
}
?>