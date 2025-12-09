<?php include_once __DIR__ . "/../layouts/header.php"; ?>

<div class="container">
    <h2 class="page-title">Tiến độ học tập</h2>

    <div class="progress-list">

        <?php foreach ($courses as $course): ?>
            <div class="progress-card">
                <img src="/assets/courses/<?= $course['thumbnail'] ?>" alt="course">

                <div class="progress-content">
                    <h3><?= $course['title'] ?></h3>
                    <p class="category"><?= $course['category'] ?></p>

                    <!-- Thanh tiến độ -->
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?= $course['progress'] ?>%"></div>
                    </div>
                    <span class="progress-label"><?= $course['progress'] ?>%</span>

                    <a href="/lessons/view.php?course_id=<?= $course['id'] ?>" class="btn-continue">
                        Tiếp tục học
                    </a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php include_once __DIR__ . "/../layouts/footer.php"; ?>
