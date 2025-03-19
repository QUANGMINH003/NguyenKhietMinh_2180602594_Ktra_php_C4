<?php include_once __DIR__ . '/../shares/header.php'; ?>

<h2>Đăng Ký Học Phần</h2>
<?php if ($successMessage) { ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($successMessage); ?></div>
<?php } ?>
<form method="POST" action="index.php?controller=course&action=register">
    <div class="mb-3">
        <label for="maSV" class="form-label">Mã SV:</label>
        <input type="text" class="form-control" id="maSV" name="maSV" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Danh sách học phần:</label><br>
        <?php foreach ($hocPhans as $rowHP) { ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="hocPhan[]" value="<?php echo htmlspecialchars($rowHP['MaHP']); ?>" id="hp_<?php echo htmlspecialchars($rowHP['MaHP']); ?>">
                <label class="form-check-label" for="hp_<?php echo htmlspecialchars($rowHP['MaHP']); ?>">
                    <?php echo htmlspecialchars($rowHP['TenHP']) . " (" . htmlspecialchars($rowHP['SoTinChi']) . " tín chỉ, Số lượng: " . (isset($rowHP['SoLuongDuKien']) ? htmlspecialchars($rowHP['SoLuongDuKien']) : 'N/A') . ")"; ?>
                </label>
            </div>
        <?php } ?>
    </div>
    <button type="submit" name="register" class="btn btn-primary">Đăng Ký</button>
    <a href="index.php?controller=student&action=index" class="btn btn-secondary">Quay lại</a>
</form>

<?php include_once __DIR__ . '/../shares/footer.php'; ?>