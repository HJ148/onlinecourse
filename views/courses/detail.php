<?php
// views/courses/detail.php
// YÊU CẦU BIẾN TỪ CONTROLLER:
// $course        – thông tin khóa học
// $lessons       – danh sách bài học
// $materials     – tài liệu đính kèm
// $is_enrolled   – true/false: học viên đã đăng ký chưa
// $progress      – % tiến độ học tập (nếu đã đăng ký)
// $relatedCourses – (tùy chọn) khóa học gợi ý

session_start();
$user = $_SESSION['user'] ?? null;
?>

<div class="container course-detail-page">

    <!-- THÔNG TIN KHÓA HỌC -->
    <div class="course-header">
        <img src="<?= $course->thumbnail ?>" class="course-banner">

        <div class="course-info">
            <h1><?= htmlspecialchars($course->title) ?></h1>
            <p class="course-category"><?= htmlspecialchars($course->category_name) ?></p>
            <p class="course-desc"><?= htmlspecialchars($course->description) ?></p>

            <p class="course-meta">
                👨‍🏫 Giảng viên: <b><?= htmlspecialchars($course->instructor_name) ?></b><br>
                👥 <?= $course->students_count ?> học viên đã đăng ký
            </p>

            <!-- NÚT ĐĂNG KÝ / VÀO HỌC -->
            <?php if (!$user): ?>
                <a href="/views/auth/login.php" class="btn-primary">Đăng nhập để học</a>

            <?php elseif (!$is_enrolled): ?>
                <form method="POST" action="/EnrollmentController.php?action=register">
                    <input type="hidden" name="course_id" value="<?= $course->id ?>">
                    <button class="btn-primary">Đăng ký khóa học</button>
                </form>

            <?php else: ?>
                <a href="/views/student/course_progress.php?course_id=<?= $course->id ?>" class="btn-success">
                    Vào học
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- TIẾN ĐỘ HỌC TẬP -->
    <?php if ($is_enrolled): ?>
        <div class="progress-box">
            <p>Tiến độ học tập:</p>
            <div class="progress-bar">
                <div class="progress" style="width: <?= $progress ?>%"></div>
            </div>
            <p><?= $progress ?>% hoàn thành</p>
        </div>
    <?php endif; ?>

    <!-- DANH SÁCH BÀI HỌC -->
    <h2 class="section-title">Danh sách bài học</h2>

    <div class="lesson-list">
        <?php foreach ($lessons as $i => $lesson): ?>
            <div class="lesson-item">

                <div>
                    <b><?= $i+1 ?>. <?= htmlspecialchars($lesson->title) ?></b>
                    <p class="lesson-duration">⏱ <?= gmdate("i:s", $lesson->duration) ?></p>
                </div>

                <?php if ($is_enrolled): ?>
                    <a href="/views/lessons/view.php?id=<?= $lesson->id ?>" class="btn-outline">
                        Xem bài
                    </a>
                <?php else: ?>
                    <span class="locked">🔒 Chưa đăng ký</span>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>

    <!-- TÀI LIỆU ĐÍNH KÈM -->
    <h2 class="section-title">Tài liệu học tập</h2>

    <div class="material-list">
        <?php if (empty($materials)): ?>
            <p>Không có tài liệu.</p>
        <?php else: ?>

            <?php foreach ($materials as $m): ?>
                <div class="material-item">
                    📄 <?= htmlspecialchars($m->name) ?>

                    <?php if ($is_enrolled): ?>
                        <a href="<?= $m->url ?>" class="btn-download" download>Tải xuống</a>
                    <?php else: ?>
                        <span class="locked">🔒</span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>

    <!-- GỢI Ý KHÓA HỌC -->
    <?php if (!empty($relatedCourses)): ?>
        <h2 class="section-title">Khóa học tương tự</h2>

        <div class="related-grid">
            <?php foreach ($relatedCourses as $rc): ?>
                <div class="related-card">
                    <img src="<?= $rc->thumbnail ?>">
                    <h3><?= htmlspecialchars($rc->title) ?></h3>
                    <a href="/views/courses/detail.php?id=<?= $rc->id ?>" class="btn-outline">Xem chi tiết</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
