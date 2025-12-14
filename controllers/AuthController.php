<?php
class AuthController {
    public function login() {
        require_once 'views/layouts/header.php';
        require_once 'views/auth/login.php';
        require_once 'views/layouts/footer.php';
    }

    public function handleLogin() {
        // Logic giả lập: Nếu username là admin thì vào admin, còn lại vào student
        $username = $_POST['username'] ?? '';
        
        if ($username == 'admin') {
            $_SESSION['user'] = ['name' => 'Admin Boss', 'role' => 'admin'];
            header("Location: /onlinecourse/admin/dashboard");
        } else {
            $_SESSION['user'] = ['name' => 'Học Viên A', 'role' => 'student'];
            header("Location: /onlinecourse/student/dashboard");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /onlinecourse/");
    }
}
?>