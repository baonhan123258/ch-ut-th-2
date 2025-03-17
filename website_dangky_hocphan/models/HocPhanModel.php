<?php
class HocPhanModel {
    private $conn;
    private $table_name = "HocPhan";
    
    public $MaHP;
    public $TenHP;
    public $SoTinChi;
    public $SoLuong;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Lấy tất cả học phần
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY MaHP ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Lấy học phần theo ID
    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaHP = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaHP);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->MaHP = $row['MaHP'];
            $this->TenHP = $row['TenHP'];
            $this->SoTinChi = $row['SoTinChi'];
            $this->SoLuong = $row['SoLuong'];
            return true;
        }
        
        return false;
    }
    
    // Cập nhật số lượng học phần
    public function updateSoLuong() {
        $query = "UPDATE " . $this->table_name . " SET SoLuong = SoLuong - 1 WHERE MaHP = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaHP);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>