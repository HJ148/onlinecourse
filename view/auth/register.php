<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
</head>
<body>
    <h2>Đăng ký tài khoản</h2>

    <form method="POST" action="?controller=auth&action=handleRegister">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Mật khẩu:</label>
        <input type="password" name="password" required><br>

        <label>Họ tên:</label>
        <input type="text" name="fullname" required><br>

        <button type="submit">Đăng ký</button>
    </form>

    <a href="?controller=auth&action=login">Đã có tài khoản? Đăng nhập</a>
</body>
</html>
