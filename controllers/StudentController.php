<?php
require_once './models/SinhVienModel.php';
require_once './models/NganhHocModel.php';

class StudentController
{
    private $sinhVienModel;
    private $nganhHocModel;

    public function __construct($db)
    {
        session_start();
        if (!isset($_SESSION['maSV'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        $this->sinhVienModel = new SinhVienModel($db);
        $this->nganhHocModel = new NganhHocModel($db);
    }

    public function index()
    {
        $sinhViens = $this->sinhVienModel->getAllSinhVien();
        require_once './views/students/index.php';
    }

    public function create()
    {
        $nganhHocs = $this->nganhHocModel->getAllNganhHoc();
        require_once './views/students/create.php';
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hinhPath = '/Content/images/default.jpg'; // Đường dẫn mặc định nếu không upload hình

            // Xử lý upload hình
            if (isset($_FILES['hinh']) && $_FILES['hinh']['error'] == 0) {
                $uploadDir = 'public/images/';
                $uploadFile = $uploadDir . time() . '_' . basename($_FILES['hinh']['name']); // Thêm timestamp để tránh trùng tên
                $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['hinh']['tmp_name'], $uploadFile)) {
                        $hinhPath = '/' . $uploadFile;
                    } else {
                        echo "Lỗi khi upload hình!";
                        return;
                    }
                } else {
                    echo "Chỉ cho phép upload file hình ảnh (jpg, jpeg, png, gif)!";
                    return;
                }
            }

            $data = [
                'maSV' => $_POST['maSV'],
                'hoTen' => $_POST['hoTen'],
                'gioiTinh' => $_POST['gioiTinh'],
                'ngaySinh' => $_POST['ngaySinh'],
                'hinh' => $hinhPath,
                'maNganh' => $_POST['maNganh']
            ];
            $this->sinhVienModel->createSinhVien($data);
            header("Location: index.php?controller=student&action=index");
            exit();
        }
    }

    public function edit($maSV)
    {
        $sinhVien = $this->sinhVienModel->getSinhVienByMaSV($maSV);
        $nganhHocs = $this->nganhHocModel->getAllNganhHoc();
        require_once './views/students/edit.php';
    }

    public function update($maSV)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sinhVien = $this->sinhVienModel->getSinhVienByMaSV($maSV);
            $hinhPath = $sinhVien['Hinh']; // Giữ hình cũ nếu không upload hình mới

            // Xử lý upload hình mới
            if (isset($_FILES['hinh']) && $_FILES['hinh']['error'] == 0) {
                $uploadDir = 'public/images/';
                $uploadFile = $uploadDir . time() . '_' . basename($_FILES['hinh']['name']);
                $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['hinh']['tmp_name'], $uploadFile)) {
                        $hinhPath = '/' . $uploadFile;
                    } else {
                        echo "Lỗi khi upload hình!";
                        return;
                    }
                } else {
                    echo "Chỉ cho phép upload file hình ảnh (jpg, jpeg, png, gif)!";
                    return;
                }
            }

            $data = [
                'hoTen' => $_POST['hoTen'],
                'gioiTinh' => $_POST['gioiTinh'],
                'ngaySinh' => $_POST['ngaySinh'],
                'hinh' => $hinhPath,
                'maNganh' => $_POST['maNganh']
            ];
            $this->sinhVienModel->updateSinhVien($maSV, $data);
            header("Location: index.php?controller=student&action=index");
            exit();
        }
    }

    public function delete($maSV)
    {
        $this->sinhVienModel->deleteSinhVien($maSV);
        header("Location: index.php?controller=student&action=index");
        exit();
    }

    public function detail($maSV)
    {
        $sinhVien = $this->sinhVienModel->getSinhVienByMaSV($maSV);
        require_once './views/students/detail.php';
    }
}
