<?php
// Giả định: Có một hàm/class để kiểm tra role của người dùng hiện tại
class AuthHelper {
    public static function getUserId() {
        // Thay thế bằng logic session thực tế
        return 1; // Giả định người dùng có ID 1 là Giảng viên đang đăng nhập
    }

    public static function isInstructor() {
        // Thay thế bằng logic session thực tế để kiểm tra role == 1
        // (Đây là logic của LTV A, nhưng LTV B cần sử dụng nó)
        return true; 
    }
}
?>