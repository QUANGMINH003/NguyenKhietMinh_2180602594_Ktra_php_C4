<?php include_once __DIR__ . '/../shares/header.php'; ?>

<head>
    <title>Sửa Thông Tin Sinh Viên</title>
</head>

<body>


    <h2>Sửa Thông Tin Sinh Viên</h2>
    <form method="POST" action="index.php?controller=student&action=update&maSV=<?php echo urlencode($sinhVien['MaSV']); ?>" enctype="multipart/form-data">
        <input type="hidden" name="maSV" value="<?php echo htmlspecialchars($sinhVien['MaSV']); ?>">
        <div class="mb-3">
            <label for="hoTen" class="form-label">Họ Tên:</label>
            <input type="text" class="form-control" id="hoTen" name="hoTen" value="<?php echo htmlspecialchars($sinhVien['HoTen']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="gioiTinh" class="form-label">Giới Tính:</label>
            <select class="form-select" id="gioiTinh" name="gioiTinh">
                <option value="Nam" <?php if ($sinhVien['GioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                <option value="Nữ" <?php if ($sinhVien['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="ngaySinh" class="form-label">Ngày Sinh:</label>
            <input type="date" class="form-control" id="ngaySinh" name="ngaySinh" value="<?php echo htmlspecialchars($sinhVien['NgaySinh']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hình hiện tại:</label><br>
            <?php
            $imagePath = htmlspecialchars($sinhVien['Hinh']);
            $baseUrl = '/2180606572_PhanHieuNghia_KT';
            $fullImagePath = $baseUrl . $imagePath;
            $serverPath = $_SERVER['DOCUMENT_ROOT'] . $baseUrl . $imagePath;
            if (file_exists($serverPath) && !empty($imagePath)) {
                echo '<img src="' . $fullImagePath . '" width="50" alt="Hình">';
            } else {
                echo '<span class="text-muted">Không có hình</span>';
            }
            ?>
        </div>
        <div class="mb-3">
            <label for="hinh" class="form-label">Thay đổi Hình:</label>
            <input type="file" class="form-control" id="hinh" name="hinh" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="maNganh" class="form-label">Ngành:</label>
            <select class="form-select" id="maNganh" name="maNganh">
                <?php foreach ($nganhHocs as $nganh) { ?>
                    <option value="<?php echo htmlspecialchars($nganh['MaNganh']); ?>" <?php if ($nganh['MaNganh'] == $sinhVien['MaNganh']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($nganh['TenNganh']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="index.php?controller=student&action=index" class="btn btn-secondary">Quay lại</a>
    </form>




    <?php include_once __DIR__ . '/../shares/footer.php'; ?>