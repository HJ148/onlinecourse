<?php
// views/home/index.php
// expects $featured_courses, $categories
$page_title = 'Trang chủ';
include __DIR__.'/../layouts/header.php';
?>
<div class="container page">
  <div class="main">
    <section class="card">
      <h2>Khóa học nổi bật</h2>
      <div class="course-grid">
        <?php foreach($featured_courses as $c): ?>
          <div class="course-card">
            <img src="<?= $c->thumbnail ?: '/assets/images/default-course.jpg' ?>" alt="<?= htmlspecialchars($c->title) ?>">
            <div class="course-title"><?= htmlspecialchars($c->title) ?></div>
            <div class="course-meta"><?= htmlspecialchars($c->category_name) ?> · <?= intval($c->students_count) ?> học viên</div>
            <div style="margin-top:8px"><a class="btn-primary" href="/courses/detail.php?id=<?= $c->id ?>">Xem chi tiết</a></div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </div>
  <?php include __DIR__.'/../layouts/sidebar.php'; ?>
</div>
<?php include __DIR__.'/../layouts/footer.php'; ?>