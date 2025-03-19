<?php
require_once './models/SinhVienModel.php';

class AuthController
{
    private $sinhVienModel;

    public function __construct($db)
    {
        $this->sinhVienModel = new SinhVienModel($db);
    }

    public function login()
    {
        session_start();

        // Nếu đã đăng nhập, chuyển hướng đến trang chính
        if (isset($_SESSION['maSV'])) {
            header("Location: index.php?controller=student&action=index");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $maSV = $_POST['maSV'];

            // Kiểm tra mã sinh viên trong bảng SinhVien
            $sinhVien = $this->sinhVienModel->getSinhVienByMaSV($maSV);

            if ($sinhVien) {
                // Đăng nhập thành công, lưu thông tin vào session
                $_SESSION['maSV'] = $sinhVien['MaSV'];
                $_SESSION['hoTen'] = $sinhVien['HoTen'];
                header("Location: index.php?controller=student&action=index");
                exit();
            } else {
                $error = "Mã sinh viên không tồn tại!";
                require_once './views/auth/login.php';
            }
        } else {
            require_once './views/auth/login.php';
        }
    }

    public function logout()
    {
        session_start();
        session_destroy(); // Xóa toàn bộ session
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
}
