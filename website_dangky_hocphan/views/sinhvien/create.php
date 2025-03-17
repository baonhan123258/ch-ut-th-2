<?php include 'views/layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Thêm sinh viên</h2>
    
    <form action="index.php?controller=sinhvien&action=store" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="maSV">Mã sinh viên</label>
            <input type="text" class="form-control" id="maSV" name="maSV" required>
        </div>
        
        <div class="form-group">
            <label for="hoTen">Họ tên</label>
            <input type="text" class="form-control" id="hoTen" name="hoTen" required>
        </div>
        
        <div class="form-group">
            <label for="gioiTinh">Giới tính</label>
            <select class="form-control" id="gioiTinh" name="gioiTinh">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="ngaySinh">Ngày sinh</label>
            <input type="date" class="form-control" id="ngaySinh" name="ngaySinh" required>
        </div>
        
        <div class="form-group">
            <label for="hinh">Hình ảnh</label>
            <input type="file" class="form-control-file" id="hinh" name="hinh">
        </div>
        
        <div class="form-group">
            <label for="maNganh">Ngành học</label>
            <select class="form-control" id="maNganh" name="maNganh" required>
                <?php while($nganh = $nganh_result->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $nganh['MaNganh'] ?>"><?= $nganh['TenNganh'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?>