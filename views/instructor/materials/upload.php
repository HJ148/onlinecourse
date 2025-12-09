<?php include_once __DIR__ . "/../../layouts/header.php"; ?>

<div class="container">
    <h2 class="page-title">Upload tài liệu học tập</h2>

    <form action="/instructor/materials/store.php" method="POST" enctype="multipart/form-data" class="form-box">

        <!-- Chọn khóa học -->
        <div class="form-group">
            <label>Khóa học</label>
            <select name="course_id" class="form-control" required>
                <option value="">-- Chọn khóa học --</option>
                <?php foreach ($courses as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Chọn bài học -->
        <div class="form-group">
            <label>Bài học</label>
            <select name="lesson_id" class="form-control" required>
                <option value="">-- Chọn bài học --</option>
                <?php foreach ($lessons as $l): ?>
                    <option value="<?= $l['id'] ?>"><?= $l['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Upload file -->
        <div class="form-group">
            <label>Chọn tài liệu PDF / DOCX / PPTX</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button type="submit" class="btn-submit">Upload tài liệu</button>
    </form>
</div>

<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>
