<?php
// Không cần require_once cho User.php vì đã được load trong index.php

class AuthController {

    // Giao diện đăng nhập
    public function login() {
        // SỬA: Dùng APP_ROOT để truy cập View
        require APP_ROOT . "/view/auth/login.php"; 
    }

    // Xử lý đăng nhập
    public function handleLogin() {
        $userModel = new User();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userModel->login($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;

            // ĐIỀU CHỈNH ĐƯỜNG DẪN CHUYỂN HƯỚNG
            // Sử dụng đường dẫn web tương đối cho header (thay đổi /thuchanhso2/ nếu cần)
            $base_url = "/thuchanhso2/index.php"; 
            
            if ($user['role'] == 2) {
                header("Location: " . $base_url . "?controller=admin&action=dashboard"); 
            } elseif ($user['role'] == 1) {
                header("Location: " . $base_url . "?controller=instructor&action=dashboard");
            } else {
                header("Location: " . $base_url . "?controller=student&action=dashboard");
            }
            exit;
        }

        $error = "Email hoặc mật khẩu không chính xác!";
        // SỬA: Dùng APP_ROOT để truy cập View
        require APP_ROOT . "/view/auth/login.php";
    }

    // Giao diện đăng ký
    public function register() {
        // SỬA: Dùng APP_ROOT để truy cập View
        require APP_ROOT . "/view/auth/register.php";
    }

    // Xử lý đăng ký
    public function handleRegister() {
        $userModel = new User();

        $data = [
            'username' => $_POST['username'],
            'email'    => $_POST['email'],
            'password' => $_POST['password'],
            'fullname' => $_POST['fullname']
        ];

        $userModel->register($data);

        // Chuyển hướng về trang login
        header("Location: index.php?action=login"); 
        exit;
    }

    // Đăng xuất
    public function logout() {
        session_destroy();
        // Chuyển hướng về trang login
        header("Location: index.php?action=login");
        exit;
    }
}
?>