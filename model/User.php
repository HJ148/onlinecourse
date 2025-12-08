<?php
// SỬA LỖI ĐƯỜNG DẪN: Dùng APP_ROOT để truy cập config/Database.php một cách tuyệt đối
require_once APP_ROOT . "/config/Database.php";

class User {
    private $conn;
    private $table = "users";

    public function __construct() {
        $db = new Database(); 
        $this->conn = $db->connect();
    }

    // Đăng ký
    public function register($data) {
        $sql = "INSERT INTO users (username, email, password, fullname, role, created_at)
                VALUES (:username, :email, :password, :fullname, :role, NOW())";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':username' => $data['username'],
            ':email'    => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
            ':fullname' => $data['fullname'],
            ':role'     => 0
        ]);

        return true;
    }

    // Lấy user theo email
    public function getByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Kiểm tra đăng nhập
    public function login($email, $password) {
        $user = $this->getByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>