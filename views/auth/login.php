<?php include_once __DIR__ . '/../shares/header.php'; ?>

<head>
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h2>Đăng Nhập</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="index.php?controller=auth&action=login">
        <label>Mã Sinh Viên:</label><br>
        <input type="text" class="form-label" name="maSV" required><br>
        <input type="submit" value="Đăng Nhập">
    </form>
</body>

<?php include_once __DIR__ . '/../shares/footer.php'; ?>