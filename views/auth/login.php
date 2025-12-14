<div class="container">
    <div class="auth-box">
        <h2 style="text-align: center; margin-bottom: 20px;">Đăng nhập hệ thống</h2>
        <form action="/onlinecourse/auth/handleLogin" method="POST">
            <div class="form-group">
                <label>Email / Tên đăng nhập</label>
                <input type="text" name="username" class="form-control" placeholder="admin hoặc student" required>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập bất kỳ để test" required>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Đăng nhập</button>
        </form>
        <p style="text-align: center; margin-top: 15px; font-size: 0.9em;">
            Chưa có tài khoản? <a href="/onlinecourse/auth/register" style="color:#2563eb;">Đăng ký ngay</a>
        </p>
    </div>
</div>