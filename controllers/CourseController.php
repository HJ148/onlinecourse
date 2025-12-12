<?php
// require_once '../models/Course.php';
// require_once '../models/Category.php'; // Cần để lấy danh mục
require_once '../helpers/AuthHelper.php';

class CourseController {
    private $courseModel;
    private $categoryModel; // Giả định có model này

    public function __construct() {
        if (!AuthHelper::isInstructor()) {
            // Kiểm tra quyền truy cập (Role-based access control)
            header('Location: /login'); // Chuyển hướng nếu không phải Giảng viên
            exit();
        }
        $this->courseModel = new Course();
        // $this->categoryModel = new Category(); 
    }

    /**
     * Hiển thị danh sách khóa học của giảng viên (instructor/my_courses.php)
     */
    public function index() {
        $instructor_id = AuthHelper::getUserId();
        $courses = $this->courseModel->findByInstructor($instructor_id);
        
        // Truyền dữ liệu sang View
        include 'views/instructor/my_courses.php'; 
    }

    /**
     * Hiển thị form tạo khóa học (instructor/course/create.php)
     */
    public function create() {
        // $categories = $this->categoryModel->findAll(); // Lấy danh sách danh mục
        // include 'views/instructor/course/create.php';
    }

    /**
     * Xử lý POST request để lưu khóa học mới
     */
    public function store() {
        // 1. Validate Input (Lưu ý)
        // 2. Xử lý Upload File (LTV D phụ trách xử lý chính, B tích hợp)
        $image_path = $this->handleImageUpload($_FILES['image']);

        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'instructor_id' => AuthHelper::getUserId(),
            'category_id' => $_POST['category_id'],
            'price' => $_POST['price'],
            'duration_weeks' => $_POST['duration_weeks'],
            'level' => $_POST['level'],
            'image' => $image_path
        ];

        if ($this->courseModel->create($data)) {
            // Tạm thời chuyển hướng về danh sách
            header('Location: /instructor/my_courses');
            exit();
        } else {
            // Xử lý lỗi
            // include 'views/instructor/course/create.php'; 
        }
    }

    /**
     * Hàm giả định xử lý upload ảnh (LTV B cần tích hợp với LTV D)
     */
    private function handleImageUpload($file) {
        $target_dir = 'assets/courses/'; // Thư mục courses trong assets
        $file_name = uniqid() . basename($file['name']);
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return $file_name; // Lưu tên file vào CSDL
        }
        return '';
    }
    
    // ... các hàm edit, update, delete tương tự ...
}
?>