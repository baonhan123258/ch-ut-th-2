<?php include 'views/layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Đăng ký học phần</h2>
    
    <?php if(!isset($_SESSION['user'])): ?>
        <div class="alert alert-warning">
            Vui lòng <a href="index.php?controller=auth&action=login">đăng nhập</a> để đăng ký học phần.
        </div>
    <?php else: ?>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Thông tin sinh viên
                    </div>
                    <div class="card-body">
                        <p><strong>Mã SV:</strong> <?= $_SESSION['user']['MaSV'] ?></p>
                        <p><strong>Họ tên:</strong> <?= $_SESSION['user']['HoTen'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Giỏ đăng ký
                    </div>
                    <div class="card-body">
                        <p><strong>Số học phần đã chọn:</strong> <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></p>
                        <a href="index.php?controller=dangky&action=cart" class="btn btn-outline-primary">
                            Xem giỏ đăng ký
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <h4>Danh sách học phần</h4>
        <p>Vui lòng chọn các học phần muốn đăng ký:</p>
        
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Mã HP</th>
                    <th>Tên học phần</th>
                    <th>Số tín chỉ</th>
                    <th>Số lượng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Lấy danh sách học phần từ controller
                $database = new Database();
                $db = $database->getConnection();
                $hocPhanModel = new HocPhanModel($db);
                $result = $hocPhanModel->getAll();
                
                while($row = $result->fetch(PDO::FETCH_ASSOC)):
                ?>
                    <tr>
                        <td><?= $row['MaHP'] ?></td>
                        <td><?= $row['TenHP'] ?></td>
                        <td><?= $row['SoTinChi'] ?></td>
                        <td><?= $row['SoLuong'] ?></td>
                        <td>
                            <?php if($row['SoLuong'] > 0): ?>
                                <a href="index.php?controller=hocphan&action=addToCart&id=<?= $row['MaHP'] ?>" class="btn btn-primary btn-sm">Đăng ký</a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>Đã hết chỗ</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'views/layouts/footer.php'; ?>