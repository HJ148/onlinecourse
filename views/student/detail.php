<div class="container" style="padding: 40px 0; display: flex; gap: 40px;">
    <div style="flex: 1;">
        <img src="/onlinecourse/assets/uploads/<?= $course['image'] ?: 'default.jpg' ?>" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    </div>

    <div style="flex: 2;">
        <h1 style="color: #2c3e50; font-size: 2em; margin-bottom: 15px;"><?= $course['title'] ?></h1>
        <p style="font-size: 1.1em; color: #555; line-height: 1.6;"><?= $course['description'] ?></p>
        
        <div style="margin: 20px 0; padding: 20px; background: #f9f9f9; border-radius: 8px;">
            <p><strong>Giảng viên:</strong> <?= $course['instructor_name'] ?></p>
            <p><strong>Cấp độ:</strong> <?= $course['level'] ?></p>
            <p><strong>Thời lượng:</strong> <?= $course['duration_weeks'] ?> tuần</p>
            <h2 style="color: #e74c3c; margin-top: 15px;"><?= number_format($course['price']) ?> VNĐ</h2>
        </div>

        <a href="/onlinecourse/student/join/<?= $course['id'] ?>" 
           onclick="return confirm('Bạn xác nhận đăng ký khóa học này?')"
           style="background: #27ae60; color: white; padding: 15px 30px; font-size: 1.2em; border-radius: 5px; text-decoration: none; display: inline-block; font-weight: bold;">
           Đăng ký học ngay
        </a>
        
        <a href="/onlinecourse/student/dashboard" style="margin-left: 20px; color: #7f8c8d; text-decoration: none;">Quay lại</a>
    </div>
</div>