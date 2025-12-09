<?php include_once __DIR__ . "/../../layouts/header.php"; ?>

<div class="container">
    <h2 class="page-title">Chỉnh sửa khóa học</h2>

    <form action="/instructor/course/update.php" method="POST" enctype="multipart/form-data" class="form-box">

        <input type="hidden" name="id" value="<?= $course['id'] ?>">

        <!-- Tiêu đề khóa học -->
        <div class="form-group">
            <label>Tiêu đề khóa học</label>
            <input type="text" name="title" class="form-control" value="<?= $course['title'] ?>" required>
        </div>

        <!-- Mô tả khóa học -->
        <div class="form-group">
            <label>Mô tả khóa học</label>
            <textarea name="description" class="form-control" rows="5"><?= $course['description'] ?></textarea>
        </div>

        <!-- Thumbnail -->
        <div class="form-group">
            <label>Ảnh thumbnail</label>
            <p>Ảnh hiện tại: <?= $course['thumbnail'] ?></p>
            <input type="file" name="thumbnail" accept="image/*" class="form-control">
        </div>

        <button type="submit" class="btn-submit">Cập nhật khóa học</button>
    </form>
</div>

<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>
