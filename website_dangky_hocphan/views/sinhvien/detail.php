<?php include 'views/layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Thông tin chi tiết sinh viên</h2>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <?php if($this->sinhVienModel->Hinh): ?>
                        <img src="<?= $this->sinhVienModel->Hinh ?>" alt="<?= $this->sinhVienModel->HoTen ?>" class="img-fluid">
                    <?php else: ?>
                        <img src="/Content/images/noimage.jpg" alt="No Image" class="img-fluid">
                    <?php endif; ?>
                </div>
                
                <div class="col-md-9">
                    <h5 class="card-title"><?= $this->sinhVienModel->HoTen ?></h5>
                    <p><strong>Mã SV:</strong> <?= $this->sinhVienModel->MaSV ?></p>
                    <p><strong>Giới tính:</strong> <?= $this->sinhVienModel->GioiTinh ?></p>
                    <p><strong>Ngày sinh:</strong> <?= date('d/m/Y', strtotime($this->sinhVienModel->NgaySinh)) ?></p>
                    <p><strong>Ngành học:</strong> <?= $this->sinhVienModel->MaNganh ?></p>
                    
                    <a href="index.php?controller=sinhvien&action=index" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>