<?php include_once __DIR__ . "/../../layouts/header.php"; ?>

<div class="container">
    <h2 class="page-title">Tạo khóa học mới</h2>

    <form action="/instructor/course/store.php" method="POST" enctype="multipart/form-data" class="form-box">

        <!-- Tiêu đề khóa học -->
        <div class="form-group">
            <label>Tiêu đề khóa học</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <!-- Mô tả khóa học -->
        <div class="form-group">
            <label>Mô tả khóa học</label>
            <textarea name="description" class="form-control" rows="5"></textarea>
        </div>

        <!-- Ảnh thumbnail -->
        <div class="form-group">
            <label>Ảnh thumbnail</label>
            <input type="file" name="thumbnail" accept="image/*" class="form-control">
        </div>

        <button type="submit" class="btn-submit">Tạo khóa học</button>
    </form>
</div>

<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>
