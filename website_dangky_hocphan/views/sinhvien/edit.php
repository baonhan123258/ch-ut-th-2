<?php include 'views/layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Sửa thông tin sinh viên</h2>
    
    <form action="index.php?controller=sinhvien&action=update" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="maSV">Mã sinh viên</label>
            <input type="text" class="form-control" id="maSV" name="maSV" value="<?= $this->sinhVienModel->MaSV ?>" readonly>
        </div>
        
        <div class="form-group">
            <label for="hoTen">Họ tên</label>
            <input type="text" class="form-control" id="hoTen" name="hoTen" value="<?= $this->sinhVienModel->HoTen ?>" required>
        </div>
        
        <div class="form-group">
            <label for="gioiTinh">Giới tính</label>
            <select class="form-control" id="gioiTinh" name="gioiTinh">
                <option value="Nam" <?= $this->sinhVienModel->GioiTinh == 'Nam' ? 'selected' : '' ?>>Nam</option>
                <option value="Nữ" <?= $this->sinhVienModel->GioiTinh == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="ngaySinh">Ngày sinh</label>
            <input type="date" class="form-control" id="ngaySinh" name="ngaySinh" value="<?= $this->sinhVienModel->NgaySinh ?>" required>
        </div>
        
        <div class="form-group">
            <label for="hinh">Hình ảnh</label>
            <?php if($this->sinhVienModel->Hinh): ?>
                <div class="mb-2">
                    <img src="<?= $this->sinhVienModel->Hinh ?>" alt="<?= $this->sinhVienModel->HoTen ?>" style="max-width: 100px;">
                </div>
            <?php endif; ?>
            <input type="file" class="form-control-file" id="hinh" name="hinh">
            <input type="hidden" name="current_hinh" value="<?= $this->sinhVienModel->Hinh ?>">
        </div>
        
        <div class="form-group">
            <label for="maNganh">Ngành học</label>
            <select class="form-control" id="maNganh" name="maNganh" required>
                <?php while($nganh = $nganh_result->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $nganh['MaNganh'] ?>" <?= $this->sinhVienModel->MaNganh == $nganh['MaNganh'] ? 'selected' : '' ?>>
                        <?= $nganh['TenNganh'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?>