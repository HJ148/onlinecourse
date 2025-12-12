<?php
// Tệp này do toàn bộ dự án sử dụng để thiết lập kết nối PDO
class Database {
    private static $host = 'localhost';
    private static $db_name = 'onlinecourse';
    private static $username = 'root';
    private static $password = '';
    private static $conn;

    public static function connect() {
        self::$conn = null;
        try {
            self::$conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db_name . ';charset=utf8mb4', self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$conn;
        } catch (PDOException $exception) {
            echo "Lỗi kết nối CSDL: " . $exception->getMessage();
            exit();
        }
    }
}
?>