<?php
// views/courses/index.php
// Biến cần có trước khi include file:
// $courses      (danh sách khóa học)
// $categories   (danh sách danh mục)
// optional: $_GET['q'], $_GET['category']
?>

<div class="container">
    <h1 class="page-title">Danh sách khóa học</h1>

    <!-- Form tìm kiếm & lọc -->
    <form method="GET" class="course-filter-box">

        <div class="filter-left">
            <input type="text" 
                   name="q" 
                   placeholder="Tìm kiếm khóa học..." 
                   value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
            <button type="submit" class="btn-primary">Tìm</button>
        </div>

        <div class="filter-right">
            <select name="category" onchange="this.form.submit()">
                <option value="">-- Tất cả danh mục --</option>
                <?php foreach ($categories as $cate): ?>
                    <option value="<?= $cate->id ?>"
                        <?= (!empty($_GET['category']) && $_GET['category'] == $cate->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cate->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

    </form>

    <!-- Danh sách khóa học -->
    <div class="course-grid">
        <?php if (empty($courses)): ?>
            <p class="no-course">Không có khóa học nào được tìm thấy.</p>
        <?php else: ?>

            <?php foreach ($courses as $c): ?>
                <div class="course-card">

                    <div class="course-thumb">
                        <img src="<?= $c->thumbnail ?>" alt="Course Thumbnail">
                    </div>

                    <div class="course-info">

                        <h3 class="course-title">
                            <?= htmlspecialchars($c->title) ?>
                        </h3>

                        <p class="course-category">
                            <?= htmlspecialchars($c->category_name) ?>
                        </p>

                        <p class="course-desc">
                            <?= htmlspecialchars(substr($c->description, 0, 80)) ?>...
                        </p>

                        <div class="course-footer">
                            <span class="students">👥 <?= $c->students_count ?> học viên</span>

                            <a href="/views/courses/detail.php?id=<?= $c->id ?>" 
                               class="btn-outline">
                                Xem chi tiết
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>
</div>
