<?php include 'views/layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Xóa sinh viên</h2>
    
    <div class="alert alert-danger">
        <p>Bạn có chắc chắn muốn xóa sinh viên này?</p>
        <p><strong>Mã SV:</strong> <?= $this->sinhVienModel->MaSV ?></p>
        <p><strong>Họ tên:</strong> <?= $this->sinhVienModel->HoTen ?></p>
    </div>
    
    <form action="index.php?controller=sinhvien&action=destroy" method="POST">
        <input type="hidden" name="maSV" value="<?= $this->sinhVienModel->MaSV ?>">
        
        <button type="submit" class="btn btn-danger">Xóa</button>
        <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?>