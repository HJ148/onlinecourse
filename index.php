<?php
// =======================================================
// BƯỚC 1: CẤU HÌNH BAN ĐẦU
// =======================================================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Khởi tạo session ngay từ đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// KHAI BÁO THƯ MỤC GỐC (Đường dẫn tuyệt đối đến thư mục THUCHANHSO2)
define('APP_ROOT', __DIR__);

// =======================================================
// BƯỚC 2: KHAI BÁO CÁC FILE CẦN THIẾT
// =======================================================
// Sử dụng đường dẫn tương đối với index.php (tương đối với thư mục gốc)
require_once APP_ROOT . "/model/User.php";
require_once APP_ROOT . "/controller/AuthController.php";

// =======================================================
// BƯỚC 3: XỬ LÝ ACTION TỪ URL
// =======================================================
$auth = new AuthController();
$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        $auth->login();
        break;
    
    case 'handleLogin':
        $auth->handleLogin();
        break;
    
    case 'register':
        $auth->register();
        break;
    
    case 'handleRegister':
        $auth->handleRegister();
        break;
    
    case 'logout':
        $auth->logout();
        break;

    default:
        $auth->login();
        break;
}

?>