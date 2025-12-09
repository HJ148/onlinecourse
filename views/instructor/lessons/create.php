<?php include_once __DIR__ . "/../../layouts/header.php"; ?>

<div class="container">
    <h2 class="page-title">Thêm bài học mới</h2>

    <form action="/instructor/lessons/store.php" method="POST" enctype="multipart/form-data" class="form-box">

        <input type="hidden" name="course_id" value="<?= $_GET['course_id'] ?>">

        <!-- Tên bài học -->
        <div class="form-group">
            <label>Tên bài học</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <!-- Video bài học -->
        <div class="form-group">
            <label>Video bài học (mp4)</label>
            <input type="file" name="video" accept="video/mp4" class="form-control">
        </div>

        <!-- Tài liệu PDF -->
        <div class="form-group">
            <label>Tài liệu PDF (tùy chọn)</label>
            <input type="file" name="document" accept="application/pdf" class="form-control">
        </div>

        <!-- Nội dung bài học -->
        <div class="form-group">
            <label>Nội dung bài học</label>
            <textarea name="content" class="form-control" rows="8"></textarea>
        </div>

        <button type="submit" class="btn-submit">Tạo bài học</button>
    </form>
</div>

<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>
