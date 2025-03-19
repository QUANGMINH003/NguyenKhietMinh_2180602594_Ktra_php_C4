<?php include_once __DIR__ . '/../shares/header.php'; ?>

<head>
    <title>Thông Tin Học Phần Đã Lưu</title>
</head>

<body>
    <div style="text-align: right;">
        Xin chào, <?php echo htmlspecialchars($_SESSION['maSV']) . " - " . htmlspecialchars($_SESSION['hoTen']); ?> |
        <a href="index.php?controller=auth&action=logout">Đăng Xuất</a>
    </div>
    <h2>Thông Tin Học Phần Đã Lưu</h2>
    <?php if ($successMessage) echo "<p style='color:green;'>$successMessage</p>"; ?>
    <table class="table table-hover">
        <tr>
            <th>Mã ĐK</th>
            <th>Ngày ĐK</th>
            <th>Mã HP</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Lựa chọn</th>
        </tr>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['MaDK']); ?></td>
                <td><?php echo htmlspecialchars($row['NgayDK']); ?></td>
                <td><?php echo htmlspecialchars($row['MaHP']); ?></td>
                <td><?php echo htmlspecialchars($row['TenHP']); ?></td>
                <td><?php echo htmlspecialchars($row['SoTinChi']); ?></td>
                <td>
                    <a href="index.php?controller=course&action=deleteCourse&maDK=<?php echo urlencode($row['MaDK']); ?>&maHP=<?php echo urlencode($row['MaHP']); ?>&maSV=<?php echo urlencode($_GET['maSV']); ?>" onclick="return confirm('Bạn có chắc muốn xóa học phần này?')">Xóa học phần</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a href="index.php?controller=course&action=register">Quay lại Đăng Ký</a>
</body>

<?php include_once __DIR__ . '/../shares/footer.php'; ?>