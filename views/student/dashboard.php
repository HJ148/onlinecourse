<div class="container" style="padding: 30px 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="color: #2c3e50;">🔍 Khám phá khóa học</h2>
        <form action="" method="GET" style="display: flex; gap: 10px;">
            <input type="text" name="q" placeholder="Tìm khóa học..." value="<?= $_GET['q'] ?? '' ?>" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" style="padding: 8px 15px; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer;">Tìm</button>
        </form>
    </div>

    <div class="grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
        <?php foreach($allCourses as $c): ?>
            <div class="card" style="border: 1px solid #eee; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <img src="/onlinecourse/assets/uploads/<?= $c['image'] ?: 'default.jpg' ?>" style="width: 100%; height: 180px; object-fit: cover;">
                <div style="padding: 15px;">
                    <h3 style="margin: 0 0 10px; font-size: 1.1em;"><?= $c['title'] ?></h3>
                    <p style="color: #e74c3c; font-weight: bold;"><?= number_format($c['price']) ?> VNĐ</p>
                    <p style="color: #666; font-size: 0.9em;">Giảng viên: <?= $c['instructor_name'] ?></p>
                    
                    <a href="/onlinecourse/student/detail/<?= $c['id'] ?>" 
                       style="display: block; text-align: center; background: #fff; color: #3498db; border: 1px solid #3498db; padding: 8px; border-radius: 4px; text-decoration: none; margin-top: 10px;">
                       Xem chi tiết
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>