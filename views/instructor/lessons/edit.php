<?php include_once __DIR__ . "/../../layouts/header.php"; ?>

<div class="container">
    <h2 class="page-title">Chỉnh sửa bài học</h2>

    <form action="/instructor/lessons/update.php" method="POST" enctype="multipart/form-data" class="form-box">

        <input type="hidden" name="id" value="<?= $lesson['id'] ?>">
        <input type="hidden" name="course_id" value="<?= $lesson['course_id'] ?>">

        <!-- Tên bài học -->
        <div class="form-group">
            <label>Tên bài học</label>
            <input type="text" name="title" class="form-control" value="<?= $lesson['title'] ?>" required>
        </div>

        <!-- Video -->
        <div class="form-group">
            <label>Video bài học</label>
            <p>Video hiện tại: <?= $lesson['video'] ?></p>
            <input type="file" name="video" accept="video/mp4" class="form-control">
        </div>

        <!-- PDF -->
        <div class="form-group">
            <label>Tài liệu PDF</label>
            <p>Tài liệu hiện tại: <?= $lesson['document'] ?></p>
            <input type="file" name="document" accept="application/pdf" class="form-control">
        </div>

        <!-- Nội dung bài học -->
        <div class="form-group">
            <label>Nội dung bài học</label>
            <textarea name="content" class="form-control" rows="8"><?= $lesson['content'] ?></textarea>
        </div>

        <button type="submit" class="btn-submit">Cập nhật</button>
    </form>
</div>

<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>
