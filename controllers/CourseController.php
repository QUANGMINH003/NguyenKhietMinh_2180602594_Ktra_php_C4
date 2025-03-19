<?php
require_once './models/HocPhanModel.php';
require_once './models/DangkyModel.php';
require_once './models/ChiTietDangkyModel.php';

class CourseController
{
    private $hocPhanModel;
    private $dangkyModel;
    private $chiTietDangkyModel;

    public function __construct($db)
    {
        session_start();
        if (!isset($_SESSION['maSV'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        $this->hocPhanModel = new HocPhanModel($db);
        $this->dangkyModel = new DangkyModel($db);
        $this->chiTietDangkyModel = new ChiTietDangkyModel($db);
    }

    public function register()
    {
        $hocPhans = $this->hocPhanModel->getAllHocPhan();
        $successMessage = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
            $maSV = $_POST['maSV'];
            $selectedHP = $_POST['hocPhan'] ?? [];

            $maDK = $this->dangkyModel->createDangky($maSV);
            $hasError = false;

            foreach ($selectedHP as $maHP) {
                $soLuong = $this->hocPhanModel->getSoLuongDuKien($maHP);
                if ($soLuong > 0) {
                    $this->chiTietDangkyModel->addChiTietDangky($maDK, $maHP);
                    $this->hocPhanModel->giamSoLuongDuKien($maHP);
                } else {
                    $hasError = true;
                    echo "<p style='color:red;'>Học phần $maHP đã hết số lượng!</p>";
                }
            }
            if (!$hasError) {
                $_SESSION['success_message'] = "Đăng ký thành công!";
                header("Location: index.php?controller=course&action=cart&maSV=" . urlencode($maSV));
                exit();
            }
        }
        require_once './views/courses/register.php';
    }

    public function cart($maSV)
    {
        $query = "SELECT dk.MaDK, dk.NgayDK, ctdk.MaHP, hp.TenHP, hp.SoTinChi 
                  FROM Dangky dk 
                  JOIN ChiTietDangky ctdk ON dk.MaDK = ctdk.MaDK 
                  JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP 
                  WHERE dk.MaSV = :maSV";
        $stmt = $this->hocPhanModel->getConnection()->prepare($query);
        $stmt->execute(['maSV' => $maSV]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
        unset($_SESSION['success_message']);

        require_once './views/courses/cart.php';
    }

    public function deleteCourse($maDK, $maHP, $maSV)
    {
        $query = "DELETE FROM ChiTietDangky WHERE MaDK = :maDK AND MaHP = :maHP";
        $stmt = $this->hocPhanModel->getConnection()->prepare($query);
        $stmt->execute(['maDK' => $maDK, 'maHP' => $maHP]);

        $this->hocPhanModel->tangSoLuongDuKien($maHP);

        $queryCheck = "SELECT COUNT(*) FROM ChiTietDangky WHERE MaDK = :maDK";
        $stmtCheck = $this->hocPhanModel->getConnection()->prepare($queryCheck);
        $stmtCheck->execute(['maDK' => $maDK]);
        $count = $stmtCheck->fetchColumn();

        if ($count == 0) {
            $queryDeleteDK = "DELETE FROM Dangky WHERE MaDK = :maDK";
            $stmtDeleteDK = $this->hocPhanModel->getConnection()->prepare($queryDeleteDK);
            $stmtDeleteDK->execute(['maDK' => $maDK]);
        }

        header("Location: index.php?controller=course&action=cart&maSV=" . urlencode($maSV));
        exit();
    }
}
