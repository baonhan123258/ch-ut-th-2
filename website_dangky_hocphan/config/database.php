<?php
class Database {
    private $host = "127.0.0.1"; // Đã thay localhost thành 127.0.0.1
    private $db_name = "test1"; // Thay bằng tên database của bạn
    private $username = "root"; // Username mặc định của MySQL
    private $password = ""; // Nếu MySQL có mật khẩu, hãy thay vào đây
    public $conn;
    
    public function getConnection() {
        $this->conn = null;
        
        try {
            // Kiểm tra nếu MySQL chạy ở cổng khác, thêm ";port=3306"
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "✅ Kết nối thành công!";
        } catch(PDOException $exception) {
            echo "❌ Lỗi kết nối: " . $exception->getMessage();
        }
        
        return $this->conn;
    }
}

// Test kết nối
$database = new Database();
$database->getConnection();
?>
