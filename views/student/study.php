<div class="container" style="padding: 30px 0; display: flex; gap: 30px; min-height: 600px;">
    <div style="flex: 3;">
        <div style="background: #000; width: 100%; aspect-ratio: 16/9; display: flex; justify-content: center; align-items: center; border-radius: 8px; margin-bottom: 20px;">
            <div style="text-align: center; color: white;">
                <i class="fas fa-play-circle" style="font-size: 4em; margin-bottom: 10px;"></i>
                <p>Màn hình Video Bài Giảng</p>
            </div>
        </div>
        <h1><?= $course['title'] ?></h1>
        <p><?= $course['description'] ?></p>
    </div>

    <div style="flex: 1; background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
        <h3 style="border-bottom: 2px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">Nội dung khóa học</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 12px; border-bottom: 1px solid #eee; background: #fff; cursor: pointer; border-left: 3px solid #3498db; margin-bottom: 5px;">
                ▶ Bài 1: Giới thiệu khóa học
            </li>
            <li style="padding: 12px; border-bottom: 1px solid #eee; cursor: pointer; color: #666;">
                🔒 Bài 2: Kiến thức nền tảng
            </li>
            <li style="padding: 12px; border-bottom: 1px solid #eee; cursor: pointer; color: #666;">
                🔒 Bài 3: Thực hành Project
            </li>
        </ul>
        <button style="width: 100%; background: #e74c3c; color: white; border: none; padding: 10px; border-radius: 4px; margin-top: 20px; cursor: pointer;">
            Đánh dấu hoàn thành bài này
        </button>
    </div>
</div>