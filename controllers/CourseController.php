<?php
require_once 'models/Course.php';
require_once 'models/Category.php'; 
require_once 'helpers/AuthHelper.php';

class CourseController {
    private $courseModel;
    private $categoryModel;

    public function __construct() {
        $this->courseModel = new Course();
        $this->categoryModel = new Category(); 
    }

    // Trang hiển thị danh sách khóa học (Menu "Khóa học")
    public function index() {
        // 1. Nếu là GIẢNG VIÊN -> Xem dạng bảng quản lý
        if (AuthHelper::isInstructor()) {
            $instructor_id = AuthHelper::getUserId();
            $courses = $this->courseModel->findByInstructor($instructor_id);
            
            require_once 'views/layouts/header.php';
            require_once 'views/instructor/course/manage.php';
            require_once 'views/layouts/footer.php';
        } 
        // 2. Nếu là HỌC VIÊN hoặc KHÁCH -> Xem tất cả dạng lưới (giống Dashboard)
        else {
            $keyword = $_GET['q'] ?? '';
            // Lấy tất cả khóa học để hiển thị
            $allCourses = $this->courseModel->getAll($keyword);

            require_once 'views/layouts/header.php';
            // Tái sử dụng giao diện đẹp của Student Dashboard
            require_once 'views/student/dashboard.php'; 
            require_once 'views/layouts/footer.php';
        }
    }

    // Xem chi tiết khóa học
    public function detail($id) {
        $course = $this->courseModel->getById($id);
        if (!$course) {
            echo "Khóa học không tồn tại";
            return;
        }
        require_once 'views/layouts/header.php';
        require_once 'views/student/detail.php';
        require_once 'views/layouts/footer.php';
    }

    // --- Các hàm Create, Update, Delete của Giảng viên giữ nguyên bên dưới ---
    // (Nếu chưa có thì copy từ các bài trước)
}
?>