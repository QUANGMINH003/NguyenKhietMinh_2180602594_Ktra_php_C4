<?php include_once __DIR__ . '/../shares/header.php'; ?>
<?php
$title = "Thêm Sinh Viên";
?>

<h2>Thêm Sinh Viên</h2>
<form method="POST" action="index.php?controller=student&action=store" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="maSV" class="form-label">Mã SV:</label>
        <input type="text" class="form-control" id="maSV" name="maSV" required>
    </div>
    <div class="mb-3">
        <label for="hoTen" class="form-label">Họ Tên:</label>
        <input type="text" class="form-control" id="hoTen" name="hoTen" required>
    </div>
    <div class="mb-3">
        <label for="gioiTinh" class="form-label">Giới Tính:</label>
        <select class="form-select" id="gioiTinh" name="gioiTinh">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="ngaySinh" class="form-label">Ngày Sinh:</label>
        <input type="date" class="form-control" id="ngaySinh" name="ngaySinh" required>
    </div>
    <div class="mb-3">
        <label for="hinh" class="form-label">Hình:</label>
        <input type="file" class="form-control" id="hinh" name="hinh" accept="image/*">
    </div>
    <div class="mb-3">
        <label for="maNganh" class="form-label">Ngành:</label>
        <select class="form-select" id="maNganh" name="maNganh">
            <?php foreach ($nganhHocs as $nganh) { ?>
                <option value="<?php echo htmlspecialchars($nganh['MaNganh']); ?>">
                    <?php echo htmlspecialchars($nganh['TenNganh']); ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
    <a href="index.php?controller=student&action=index" class="btn btn-secondary">Quay lại</a>
</form>

<?php include_once __DIR__ . '/../shares/footer.php'; ?>