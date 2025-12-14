<?php
// Gọi Model Enrollment và AuthHelper
require_once 'models/Enrollment.php';
require_once 'helpers/AuthHelper.php';

class EnrollmentController {
    private $enrollmentModel;

    public function __construct() {
        // Khởi tạo Model
        $this->enrollmentModel = new Enrollment();
    }

    /**
     * Chức năng: Xử lý Đăng ký tham gia khóa học
     * URL gọi: /onlinecourse/enrollment/join/{id_khóa_học}
     */
    public function join($courseId) {
        // 1. Kiểm tra đăng nhập (Bắt buộc phải đăng nhập mới được học)
        // Nếu bạn không dùng AuthHelper thì dùng: if (!isset($_SESSION['user'])) ...
        if (!isset($_SESSION['user'])) {
            // Lưu lại trang hiện tại để login xong quay lại (nếu muốn làm kỹ)
            $_SESSION['redirect_after_login'] = "/onlinecourse/course/detail/$courseId";
            
            echo "<script>
                alert('Vui lòng đăng nhập để đăng ký khóa học!'); 
                window.location.href='/onlinecourse/auth/login';
            </script>";
            exit();
        }

        $userId = $_SESSION['user']['id']; // Lấy ID học viên từ session

        // 2. Gọi Model để lưu vào Database
        $result = $this->enrollmentModel->enroll($userId, $courseId);

        // 3. Kiểm tra kết quả và chuyển hướng
        if ($result) {
            echo "<script>
                alert('Chúc mừng! Bạn đã đăng ký thành công.');
                window.location.href='/onlinecourse/student/dashboard';
            </script>";
        } else {
            // Trường hợp false thường do đã đăng ký rồi (Model trả về false)
            echo "<script>
                alert('Bạn đã đăng ký khóa học này rồi!');
                window.history.back(); // Quay lại trang trước
            </script>";
        }
    }

    /**
     * Chức năng: Hủy đăng ký (Nếu bạn muốn cho phép)
     * URL gọi: /onlinecourse/enrollment/cancel/{id_khóa_học}
     */
    public function cancel($courseId) {
        // Logic tương tự join, nhưng gọi hàm delete/cancel trong Model
        // (Phần này tùy chọn, bạn có thể bổ sung sau)
    }
}
?>