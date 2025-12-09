<?php // views/layouts/header.php ?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'MyCourse' ?></title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <a href="/" class="logo">MyCourse</a>
    <form id="searchForm" action="/courses/search.php" method="GET" class="search-form">
      <input id="searchInput" name="q" type="search" placeholder="Tìm khóa học..." aria-label="Tìm khóa học">
    </form>
    <nav class="main-nav">
      <a href="/courses">Khóa học</a>
      <a href="/instructor">Giảng viên</a>
      <?php if(isset($_SESSION['user'])): ?>
        <a href="/student/dashboard.php">Xin chào, <?= htmlspecialchars($_SESSION['user']->name) ?></a>
        <a href="/auth/logout.php" class="btn-link">Đăng xuất</a>
      <?php else: ?>
        <a href="/auth/login.php">Đăng nhập</a>
        <a href="/auth/register.php" class="btn-primary">Đăng ký</a>
      <?php endif; ?>
    </nav>
    <button id="mobileMenuBtn" class="mobile-menu-btn" aria-label="Mở menu">☰</button>
  </div>
</header>
<main>