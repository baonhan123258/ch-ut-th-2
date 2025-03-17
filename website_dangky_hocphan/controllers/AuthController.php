<?php
require_once 'config/database.php';
require_once 'models/SinhVienModel.php';

class AuthController {
    private $db;
    private $sinhVienModel;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sinhVienModel = new SinhVienModel($this->db);
    }
    
    // Hiển thị form đăng nhập
    public function login() {
        include 'views/auth/login.php';
    }
    
    // Xử lý đăng nhập
    public function authenticate() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maSV = $_POST['maSV'];
            
            $this->sinhVienModel->MaSV = $maSV;
            
            if($this->sinhVienModel->getById()) {
                // Lưu thông tin sinh viên vào session
                $_SESSION['user'] = array(
                    'MaSV' => $this->sinhVienModel->MaSV,
                    'HoTen' => $this->sinhVienModel->HoTen
                );
                
                header("Location: index.php?controller=hocphan&action=index");
            } else {
                $_SESSION['error'] = "Mã sinh viên không tồn tại!";
                header("Location: index.php?controller=auth&action=login");
            }
        }
    }
    
  // Đăng xuất
  public function logout() {
    unset($_SESSION['user']);
    unset($_SESSION['cart']);
    header("Location: index.php?controller=auth&action=login");
}
}
?>