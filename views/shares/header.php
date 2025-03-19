<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="app/public/styles.css">
    <style>
        .navbar {
            background-color: #333;
        }

        .navbar a {
            color: #fff !important;
        }

        .student-img {
            width: 120px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: 30px;
        }

        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <!-- ===== HEADER / NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php?controller=student&action=index">Quản lý sản phẩm</a>
            <div class="collapse navbar-collapse">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/2180602594_NguyenKhietMinh_KT/index.php?controller=student&action=index">Danh sách sinh viên</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/2180602594_NguyenKhietMinh_KT/index.php?controller=course&action=register">Đăng ký học phần</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-4">