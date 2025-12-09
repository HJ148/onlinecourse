<?php include_once __DIR__ . "/../../layouts/header.php"; ?>

<div class="container">
    <h2 class="page-title">Quản lý khóa học</h2>

    <a href="/instructor/course/create.php" class="btn-submit">Thêm khóa học mới</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
            <tr>
                <td><?= $course['id'] ?></td>
                <td><?= $course['title'] ?></td>
                <td><?= $course['created_at'] ?></td>
                <td><?= $course['status'] ?></td>
                <td>
                    <a href="/instructor/course/edit.php?id=<?= $course['id'] ?>" class="btn-action">Sửa</a>
                    <a href="/instructor/course/delete.php?id=<?= $course['id'] ?>" class="btn-action" onclick="return confirm('Bạn có chắc muốn xóa khóa học này?');">Xóa</a>
                    <a href="/instructor/lessons/manage.php?course_id=<?= $course['id'] ?>" class="btn-action">Quản lý bài học</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>
