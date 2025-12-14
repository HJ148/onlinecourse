<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Course Platform</title>
    <link rel="stylesheet" href="/onlinecourse/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container navbar">
            <a href="/onlinecourse/" class="logo"><i class="fas fa-graduation-cap"></i> E-Learning</a>
            
            <ul class="nav-menu">
                <li><a href="/onlinecourse/">Trang chủ</a></li>
                
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'student'): ?>
                     <li><a href="/onlinecourse/student/dashboard">Khóa học mới</a></li>
                <?php else: ?>
                     <li><a href="/onlinecourse/course/index">Khóa học  </a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user'])): ?>
                    
                    <?php if($_SESSION['user']['role'] == 'student'): ?>
                        <li><a href="/onlinecourse/student/my_courses">Góc học tập</a></li>
                    
                    <?php elseif($_SESSION['user']['role'] == 'instructor'): ?>
                        <li><a href="/onlinecourse/course/index">Quản lý khóa học</a></li>
                    <?php endif; ?>
                    
                    <li>
                        <span style="color:#2563eb; font-weight:bold;">
                            Hi, <?= isset($_SESSION['user']['fullname']) ? $_SESSION['user']['fullname'] : $_SESSION['user']['name'] ?>
                        </span>
                    </li>
                    <li><a href="/onlinecourse/auth/logout" style="color:#ef4444;"><i class="fas fa-sign-out-alt"></i> Thoát</a></li>
                
                <?php else: ?>
                    <li><a href="/onlinecourse/auth/login">Đăng nhập</a></li>
                    <li><a href="/onlinecourse/auth/register" class="btn-primary">Đăng ký ngay</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>