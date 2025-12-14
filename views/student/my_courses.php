<div class="container" style="padding: 30px 0;">
    <div style="border-bottom: 2px solid #2ecc71; margin-bottom: 20px; padding-bottom: 10px;">
        <h2 style="color: #27ae60;">🎓 Góc học tập của tôi</h2>
        <p style="color: #666;">Danh sách các khóa học bạn đã đăng ký và tiến độ hiện tại.</p>
    </div>

    <div class="grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
        
        <?php if(empty($myCourses)): ?>
            <div style="grid-column: 1/-1; text-align: center; padding: 50px; background: #f9f9f9; border-radius: 8px;">
                <p style="font-size: 1.2em; color: #7f8c8d;">Bạn chưa đăng ký khóa học nào cả!</p>
                <a href="/onlinecourse/student/dashboard" class="btn btn-primary" style="background: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                    🔍 Tìm khóa học ngay
                </a>
            </div>
        <?php else: ?>
            
            <?php foreach($myCourses as $item): ?>
                <div class="card" style="background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 1px solid #eee;">
                    <div style="height: 160px; overflow: hidden;">
                        <img src="/onlinecourse/assets/uploads/<?= !empty($item['image']) ? $item['image'] : 'default.jpg' ?>" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <div class="card-body" style="padding: 20px;">
                        <h3 style="margin: 0 0 15px; font-size: 1.2em; color: #2c3e50; line-height: 1.4;">
                            <?= htmlspecialchars($item['title']) ?>
                        </h3>

                        <div style="margin-bottom: 20px;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.9em; margin-bottom: 5px; color: #555;">
                                <span>Tiến độ học tập</span>
                                <b><?= $item['progress'] ?>%</b>
                            </div>
                            <div style="background: #ecf0f1; height: 10px; border-radius: 5px; overflow: hidden;">
                                <div style="background: #27ae60; width: <?= $item['progress'] ?>%; height: 100%;"></div>
                            </div>
                        </div>

                        <a href="/onlinecourse/student/study/<?= $item['id'] ?>" 
                           style="display: block; text-align: center; background: #3498db; color: white; padding: 12px; border-radius: 5px; text-decoration: none; font-weight: bold; transition: 0.3s;">
                           <i class="fas fa-play-circle"></i> Tiếp tục học
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>
</div>