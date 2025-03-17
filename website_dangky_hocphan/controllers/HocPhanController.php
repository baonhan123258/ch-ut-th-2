<?php
require_once 'config/database.php';
require_once 'models/HocPhanModel.php';

class HocPhanController {
    private $db;
    private $hocPhanModel;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->hocPhanModel = new HocPhanModel($this->db);
    }
    
    // Hiển thị danh sách học phần
    public function index() {
        $result = $this->hocPhanModel->getAll();
        include 'views/hocphan/index.php';
    }
    
    // Thêm học phần vào giỏ đăng ký
    public function addToCart() {
        if(isset($_GET['id'])) {
            $maHP = $_GET['id'];
            
            // Khởi tạo giỏ đăng ký nếu chưa tồn tại
            if(!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
            
            // Kiểm tra học phần đã có trong giỏ chưa
            if(!in_array($maHP, $_SESSION['cart'])) {
                $_SESSION['cart'][] = $maHP;
            }
            
            header("Location: index.php?controller=dangky&action=cart");
        }
    }
}
?>