<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
require_once 'controllers/StudentController.php';
require_once 'controllers/CourseController.php';
require_once 'controllers/AuthController.php';

$db = new Database();
$conn = $db->getConnection();

if ($conn === null) {
    die("Không thể kết nối cơ sở dữ liệu. Vui lòng kiểm tra cấu hình.");
}

$controller = $_GET['controller'] ?? 'auth'; // Mặc định là auth (đăng nhập)
$action = $_GET['action'] ?? 'login'; // Mặc định là login
$maSV = $_GET['maSV'] ?? '';
$maDK = $_GET['maDK'] ?? '';
$maHP = $_GET['maHP'] ?? '';

switch ($controller) {
    case 'student':
        $controller = new StudentController($conn);
        break;
    case 'course':
        $controller = new CourseController($conn);
        break;
    case 'auth':
        $controller = new AuthController($conn);
        break;
    default:
        $controller = new AuthController($conn);
        $action = 'login';
}

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit($maSV);
        break;
    case 'update':
        $controller->update($maSV);
        break;
    case 'delete':
        $controller->delete($maSV);
        break;
    case 'detail':
        $controller->detail($maSV);
        break;
    case 'register':
        $controller->register();
        break;
    case 'cart':
        $controller->cart($maSV);
        break;
    case 'deleteCourse':
        $controller->deleteCourse($maDK, $maHP, $maSV);
        break;
    case 'login':
        $controller->login();
        break;
    case 'logout':
        $controller->logout();
        break;
    default:
        $controller->login();
}
