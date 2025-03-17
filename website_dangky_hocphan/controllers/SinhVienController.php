<?php
require_once 'config/database.php';
require_once 'models/SinhVienModel.php';
require_once 'models/NganhHocModel.php';

class SinhVienController {
    private $db;
    private $sinhVienModel;
    private $nganhHocModel;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sinhVienModel = new SinhVienModel($this->db);
        $this->nganhHocModel = new NganhHocModel($this->db);
    }
    
    // Hiển thị danh sách sinh viên
    public function index() {
        $result = $this->sinhVienModel->getAll();
        include 'views/sinhvien/index.php';
    }
    
    // Hiển thị form tạo sinh viên
    public function create() {
        $nganh_result = $this->nganhHocModel->getAll();
        include 'views/sinhvien/create.php';
    }
    
    // Lưu sinh viên mới
    public function store() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Upload hình ảnh nếu có
            $target_dir = "Content/images/";
            $hinh = "";
            
            if($_FILES["hinh"]["name"]) {
                $hinh = $target_dir . basename($_FILES["hinh"]["name"]);
                move_uploaded_file($_FILES["hinh"]["tmp_name"], $hinh);
            }
            
            $this->sinhVienModel->MaSV = $_POST['maSV'];
            $this->sinhVienModel->HoTen = $_POST['hoTen'];
            $this->sinhVienModel->GioiTinh = $_POST['gioiTinh'];
            $this->sinhVienModel->NgaySinh = $_POST['ngaySinh'];
            $this->sinhVienModel->Hinh = $hinh;
            $this->sinhVienModel->MaNganh = $_POST['maNganh'];
            
            if($this->sinhVienModel->create()) {
                header("Location: index.php?controller=sinhvien&action=index");
            } else {
                echo "Đã xảy ra lỗi khi thêm sinh viên";
            }
        }
    }
    
    // Hiển thị form sửa sinh viên
    public function edit() {
        if(isset($_GET['id'])) {
            $this->sinhVienModel->MaSV = $_GET['id'];
            $this->sinhVienModel->getById();
            $nganh_result = $this->nganhHocModel->getAll();
            include 'views/sinhvien/edit.php';
        }
    }
    
    // Cập nhật sinh viên
    public function update() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Upload hình ảnh nếu có
            $target_dir = "Content/images/";
            $hinh = $_POST['current_hinh'];
            
            if($_FILES["hinh"]["name"]) {
                $hinh = $target_dir . basename($_FILES["hinh"]["name"]);
                move_uploaded_file($_FILES["hinh"]["tmp_name"], $hinh);
            }
            
            $this->sinhVienModel->MaSV = $_POST['maSV'];
            $this->sinhVienModel->HoTen = $_POST['hoTen'];
            $this->sinhVienModel->GioiTinh = $_POST['gioiTinh'];
            $this->sinhVienModel->NgaySinh = $_POST['ngaySinh'];
            $this->sinhVienModel->Hinh = $hinh;
            $this->sinhVienModel->MaNganh = $_POST['maNganh'];
            
            if($this->sinhVienModel->update()) {
                header("Location: index.php?controller=sinhvien&action=index");
            } else {
                echo "Đã xảy ra lỗi khi cập nhật sinh viên";
            }
        }
    }
    
    // Hiển thị trang xác nhận xóa
    public function delete() {
        if(isset($_GET['id'])) {
            $this->sinhVienModel->MaSV = $_GET['id'];
            $this->sinhVienModel->getById();
            include 'views/sinhvien/delete.php';
        }
    }
    
    // Xóa sinh viên
    public function destroy() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->sinhVienModel->MaSV = $_POST['maSV'];
            
            if($this->sinhVienModel->delete()) {
                header("Location: index.php?controller=sinhvien&action=index");
            } else {
                echo "Đã xảy ra lỗi khi xóa sinh viên";
            }
        }
    }
    
    // Hiển thị chi tiết sinh viên
    public function detail() {
        if(isset($_GET['id'])) {
            $this->sinhVienModel->MaSV = $_GET['id'];
            $this->sinhVienModel->getById();
            include 'views/sinhvien/detail.php';
        }
    }
}
?>