<?php // views/layouts/sidebar.php ?>
<aside class="sidebar">
  <div class="widget">
    <h4>Danh mục</h4>
    <ul>
      <?php foreach($categories as $cat): ?>
        <li><a href="/courses/index.php?category=<?= intval($cat->id) ?>"><?= htmlspecialchars($cat->name) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="widget">
    <h4>Khóa nổi bật</h4>
    <?php foreach($featured as $f): ?>
      <a class="mini-course" href="/courses/detail.php?id=<?= $f->id ?>">
        <img src="<?= $f->thumbnail ?: '/assets/images/default-course.jpg' ?>" alt="<?= htmlspecialchars($f->title) ?>">
        <div><?= htmlspecialchars($f->title) ?></div>
      </a>
    <?php endforeach; ?>
  </div>
</aside>