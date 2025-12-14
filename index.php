<?php
session_start();

// 1. Giả lập đăng nhập (Code test - sau này làm xong Login thì xóa đoạn if này đi)
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        'id' => 1,          
        'name' => 'Học Viên Test',
        'role' => 'student' // Hoặc đổi thành 'instructor' để test giảng viên
    ];
}

// 2. Load file cấu hình Database ngay đầu tiên
// (Để đảm bảo class Database luôn sẵn sàng cho các Model sử dụng)
require_once 'config/Database.php';

// 3. Hàm tự động tải file (Autoload) - ĐÃ NÂNG CẤP
function myAutoload($className) {
    // Kiểm tra trong thư mục controllers
    if (file_exists('controllers/' . $className . '.php')) {
        require_once 'controllers/' . $className . '.php';
    } 
    // Kiểm tra trong thư mục models
    elseif (file_exists('models/' . $className . '.php')) {
        require_once 'models/' . $className . '.php';
    }
    // Kiểm tra trong thư mục helpers (QUAN TRỌNG: để load AuthHelper)
    elseif (file_exists('helpers/' . $className . '.php')) {
        require_once 'helpers/' . $className . '.php';
    }
}
spl_autoload_register('myAutoload');

// 4. Phân tích URL (Routing)
$url = $_GET['url'] ?? 'home/index';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Xác định Controller (Viết hoa chữ cái đầu: home -> HomeController)
$controllerName = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
$actionName = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// 5. Kiểm tra và chạy Controller
if (file_exists('controllers/' . $controllerName . '.php')) {
    // Vì đã có Autoload ở trên, ta chỉ cần khởi tạo class
    $controller = new $controllerName();
    
    if (method_exists($controller, $actionName)) {
        // Gọi hàm và truyền tham số
        call_user_func_array([$controller, $actionName], $params);
    } else {
        // Có Controller nhưng không có hàm (Action)
        echo "Lỗi 404: Không tìm thấy Action '$actionName' trong $controllerName";
    }
} else {
    // Không tìm thấy file Controller
    echo "Lỗi 404: Không tìm thấy Controller '$controllerName'";
}
?>