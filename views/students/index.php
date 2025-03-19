<?php include_once __DIR__ . '/../shares/header.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh Sách Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/style.css">
</head>

<body>
    <div style="text-align: right;">
        Xin chào, <?php echo htmlspecialchars($_SESSION['maSV']) . " - " . htmlspecialchars($_SESSION['hoTen']); ?> |
        <a class="btn btn-danger" href="index.php?controller=auth&action=logout">Đăng Xuất</a>
    </div>
    <h2>Danh Sách Sinh Viên</h2>
    <a class="btn btn-primary" href="/2180602594_NguyenKhietMinh_KT/index.php?controller=student&action=create">Thêm Sinh Viên</a>
    <table class="table table-hover">
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Hình</th>
            <th>Ngành</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($sinhViens as $row) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['MaSV']); ?></td>
                <td><?php echo htmlspecialchars($row['HoTen']); ?></td>
                <td><?php echo htmlspecialchars($row['GioiTinh']); ?></td>
                <td><?php echo htmlspecialchars($row['NgaySinh']); ?></td>
                <td><img src="/2180602594_NguyenKhietMinh_KT/<?php echo htmlspecialchars($row['Hinh']); ?>" width="50" alt="Hình"></td>
                <td><?php echo htmlspecialchars($row['TenNganh']); ?></td>
                <td>
                    <a href="/2180602594_NguyenKhietMinh_KT/index.php?controller=student&action=edit&maSV=<?php echo urlencode($row['MaSV']); ?>" class="btn btn-warning">Sửa</a> |
                    <a href="/2180602594_NguyenKhietMinh_KT/index.php?controller=student&action=detail&maSV=<?php echo urlencode($row['MaSV']); ?>" class="btn btn-info">Chi tiết</a>|
                    <a href="/2180602594_NguyenKhietMinh_KT/index.php?controller=student&action=delete&maSV=<?php echo urlencode($row['MaSV']); ?>" onclick="return confirm('Bạn có chắc?')" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>
<?php include_once __DIR__ . '/../shares/footer.php'; ?>