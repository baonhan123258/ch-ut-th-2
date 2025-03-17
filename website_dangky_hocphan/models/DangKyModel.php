<?php
class DangKyModel {
    private $conn;
    private $table_name = "DangKy";
    
    public $MaDK;
    public $NgayDK;
    public $MaSV;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Tạo đăng ký mới
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET NgayDK=:NgayDK, MaSV=:MaSV";
        
        $stmt = $this->conn->prepare($query);
        
        // Làm sạch dữ liệu
        $this->MaSV = htmlspecialchars(strip_tags($this->MaSV));
        
        // Bind dữ liệu
        $stmt->bindParam(":NgayDK", $this->NgayDK);
        $stmt->bindParam(":MaSV", $this->MaSV);
        
        if($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        
        return false;
    }
    
    // Lấy đăng ký theo sinh viên
    public function getByStudent() {
        $query = "SELECT d.*, ct.MaHP, h.TenHP, h.SoTinChi 
                 FROM " . $this->table_name . " d
                 JOIN ChiTietDangKy ct ON d.MaDK = ct.MaDK
                 JOIN HocPhan h ON ct.MaHP = h.MaHP
                 WHERE d.MaSV = ?
                 ORDER BY d.NgayDK DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaSV);
        $stmt->execute();
        
        return $stmt;
    }
}
?>