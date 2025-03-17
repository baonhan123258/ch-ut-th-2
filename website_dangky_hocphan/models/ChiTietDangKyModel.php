<?php
class ChiTietDangKyModel {
    private $conn;
    private $table_name = "ChiTietDangKy";
    
    public $MaDK;
    public $MaHP;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Thêm chi tiết đăng ký
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET MaDK=:MaDK, MaHP=:MaHP";
        
        $stmt = $this->conn->prepare($query);
        
        // Làm sạch dữ liệu
        $this->MaDK = htmlspecialchars(strip_tags($this->MaDK));
        $this->MaHP = htmlspecialchars(strip_tags($this->MaHP));
        
        // Bind dữ liệu
        $stmt->bindParam(":MaDK", $this->MaDK);
        $stmt->bindParam(":MaHP", $this->MaHP);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Xóa chi tiết đăng ký
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaDK = ? AND MaHP = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaDK);
        $stmt->bindParam(2, $this->MaHP);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>