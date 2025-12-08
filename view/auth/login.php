<?php 
// Đảm bảo biến $error (chứa thông báo lỗi từ AuthController) đã được định nghĩa
// Nếu không tồn tại, gán bằng chuỗi rỗng để tránh lỗi "Undefined variable"
$error = $error ?? ''; 
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Hệ thống Quản lý Khóa học Online</title>
    <link rel="stylesheet" href="../assets/css/style.css"> 
    <style>
        /* CSS cơ bản để form dễ nhìn */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 350px; }
        h1 { text-align: center; color: #333; margin-bottom: 25px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-primary { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .btn-primary:hover { background-color: #0056b3; }
        .error-message { color: white; background-color: #dc3545; padding: 10px; border-radius: 4px; margin-bottom: 15px; text-align: center; }
        .mt-3 { margin-top: 15px; text-align: center; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Đăng nhập</h1>
        
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=handleLogin" method="POST">
            <div class="form-group">
                <label for="email">Địa chỉ Email:</label>
                <input type="email" id="email" name="email" required 
                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" 
                       placeholder="Nhập email của bạn">
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required
                       placeholder="Nhập mật khẩu">
            </div>

            <button type="submit" class="btn-primary">Đăng nhập</button>
        </form>

        <p class="mt-3">
            Chưa có tài khoản? <a href="index.php?action=register">Đăng ký ngay</a>
        </p>
    </div>

</body>
</html>