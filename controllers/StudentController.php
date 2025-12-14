<?php
require_once 'models/Enrollment.php';
require_once 'models/Course.php';

class StudentController {
    
    // 1. DASHBOARD: Hiển thị TẤT CẢ khóa học (Chợ khóa học)
    public function dashboard() {
        if (!isset($_SESSION['user'])) { header("Location: /onlinecourse/auth/login"); exit; }
        
        $courseModel = new Course();
        $keyword = $_GET['q'] ?? '';
        $allCourses = $courseModel->getAll($keyword); // Lấy TẤT CẢ

        require_once 'views/layouts/header.php';
        require_once 'views/student/dashboard.php'; // View hiển thị tất cả
        require_once 'views/layouts/footer.php';
    }

    // 2. MY COURSES: Chỉ hiển thị khóa ĐÃ MUA (Góc học tập)
    public function my_courses() {
        if (!isset($_SESSION['user'])) { header("Location: /onlinecourse/auth/login"); exit; }

        $userId = $_SESSION['user']['id'];
        $enrollModel = new Enrollment();
        
        // Lấy danh sách RIÊNG của user
        $myCourses = $enrollModel->getMyCourses($userId);

        require_once 'views/layouts/header.php';
        require_once 'views/student/my_courses.php'; // QUAN TRỌNG: Phải gọi đúng file này
        require_once 'views/layouts/footer.php';
    }

    // 3. STUDY: Vào học
    public function study($id) {
        if (!isset($_SESSION['user'])) { header("Location: /onlinecourse/auth/login"); exit; }

        $courseModel = new Course();
        $course = $courseModel->getById($id);

        require_once 'views/layouts/header.php';
        require_once 'views/student/study.php'; // File giao diện học tập
        require_once 'views/layouts/footer.php';
    }

    // ... (Giữ nguyên các hàm detail, join, progress cũ của bạn) ...
    public function detail($id) {
        // Code cũ của hàm detail
        $courseModel = new Course();
        $course = $courseModel->getById($id);
        require_once 'views/layouts/header.php';
        require_once 'views/student/detail.php';
        require_once 'views/layouts/footer.php';
    }
    
    public function join($courseId) {
        // Code cũ xử lý đăng ký
        if (!isset($_SESSION['user'])) { header("Location: /onlinecourse/auth/login"); exit; }
        $enrollModel = new Enrollment();
        $userId = $_SESSION['user']['id'];
        if($enrollModel->enroll($userId, $courseId)) {
             echo "<script>alert('Đăng ký thành công'); window.location='/onlinecourse/student/my_courses';</script>";
        } else {
             echo "<script>alert('Đã đăng ký rồi'); window.location='/onlinecourse/student/my_courses';</script>";
        }
    }
}
?>