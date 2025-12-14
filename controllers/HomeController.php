<?php
// Gọi model Course để lấy dữ liệu khóa học (nếu cần hiển thị danh sách khóa học nổi bật)
require_once 'models/Course.php'; 

class HomeController {
    public function index() {
        // 1. Chuẩn bị dữ liệu (Ví dụ: lấy danh sách khóa học)
        // $courseModel = new Course();
        // $courses = $courseModel->getAll(); // Giả sử model có hàm này
        
        // 2. Gọi giao diện (View)
        // Lưu ý: Đường dẫn tính từ file index.php gốc
        
        // a. Gọi Header (chứa menu, css)
        require_once 'views/layouts/header.php';
        
        // b. Gọi nội dung chính của trang chủ
        require_once 'views/home/index.php';
        
        // c. Gọi Footer (chứa script, bản quyền)
        require_once 'views/layouts/footer.php';
    }
}
?>