<?php
require_once 'config/database.php';
require_once 'models/DangKyModel.php';
require_once 'models/ChiTietDangKyModel.php';
require_once 'models/HocPhanModel.php';

class DangKyController {
    private $db;
    private $dangKyModel;
    private $chiTietDangKyModel;
    private $hocPhanModel;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->dangKyModel = new DangKyModel($this->db);
        $this->chiTietDangKyModel = new ChiTietDangKyModel($this->db);
        $this->hocPhanModel = new HocPhanModel($this->db);
    }
    
    // Hiển thị giỏ đăng ký
    public function cart() {
        $cart_items = array();
        
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $maHP) {
                $this->hocPhanModel->MaHP = $maHP;
                if($this->hocPhanModel->getById()) {
                    $cart_items[] = array(
                        'MaHP' => $this->hocPhanModel->MaHP,
                        'TenHP' => $this->hocPhanModel->TenHP,
                        'SoTinChi' => $this->hocPhanModel->SoTinChi,
                        'SoLuong' => $this->hocPhanModel->SoLuong
                    );
                }
            }
        }
        
        include 'views/dangky/cart.php';
    }
    
    // Xóa một học phần khỏi giỏ
    public function removeFromCart() {
        if(isset($_GET['id']) && isset($_SESSION['cart'])) {
            $maHP = $_GET['id'];
            $key = array_search($maHP, $_SESSION['cart']);
            
            if($key !== false) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex
            }
            
            header("Location: index.php?controller=dangky&action=cart");
        }
    }
    
    // Xóa tất cả khỏi giỏ
    public function clearCart() {
        if(isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        
        header("Location: index.php?controller=hocphan&action=index");
    }
    
    // Lưu đăng ký
    public function save() {
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart']) && isset($_SESSION['user'])) {
            // Tạo đăng ký mới
            $this->dangKyModel->NgayDK = date('Y-m-d');
            $this->dangKyModel->MaSV = $_SESSION['user']['MaSV'];
            
            $maDK = $this->dangKyModel->create();
            
            if($maDK) {
                // Thêm chi tiết đăng ký và cập nhật số lượng học phần
                foreach($_SESSION['cart'] as $maHP) {
                    $this->chiTietDangKyModel->MaDK = $maDK;
                    $this->chiTietDangKyModel->MaHP = $maHP;
                    
                    if($this->chiTietDangKyModel->create()) {
                        // Cập nhật số lượng học phần
                        $this->hocPhanModel->MaHP = $maHP;
                        $this->hocPhanModel->updateSoLuong();
                    }
                }
                
                // Xóa giỏ sau khi đăng ký thành công
                unset($_SESSION['cart']);
                
                $_SESSION['success'] = "Đăng ký học phần thành công!";
                header("Location: index.php?controller=hocphan&action=index");
            } else {
                echo "Đã xảy ra lỗi khi lưu đăng ký";
            }
        } else {
            header("Location: index.php?controller=auth&action=login");
        }
    }
}
?>