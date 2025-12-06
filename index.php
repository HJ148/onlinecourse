<?php
// 1. Tải Cấu hình và Lớp Database
require_once 'config/Database.php';

// 2. Định nghĩa hàm tải tự động (Autoload) cho Models và Controllers
function myAutoload($className) {
    // Tên thư mục 'controller' và 'model' phải khớp với cấu trúc vật lý của bạn
    if (file_exists('controller/' . $className . '.php')) {
        require_once 'controller/' . $className . '.php';
    } elseif (file_exists('model/' . $className . '.php')) {
        require_once 'model/' . $className . '.php';
    }
}
spl_autoload_register('myAutoload');

// 3. Phân tích URL (Routing)
$url = $_GET['url'] ?? 'home/index'; 
$url = explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL));

$controllerName = ucfirst($url[0]) . 'Controller'; 
$actionName = $url[1] ?? 'index';                  
$params = array_slice($url, 2);                    

// 4. Khởi tạo và Gọi Action
if (class_exists($controllerName)) {
    $controller = new $controllerName();
    
    if (method_exists($controller, $actionName)) {
        call_user_func_array([$controller, $actionName], $params);
    } else {
        header("HTTP/1.0 404 Not Found");
        die("Error 404: Action not found.");
    }
} else {
    header("HTTP/1.0 404 Not Found");
    die("Error 404: Controller not found.");
}
?>