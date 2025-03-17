<?php include 'views/layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Danh sách học phần</h2>
    
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success'] ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    
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
            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['MaHP'] ?></td>
                    <td><?= $row['TenHP'] ?></td>
                    <td><?= $row['SoTinChi'] ?></td>
                    <td><?= $row['SoLuong'] ?></td>
                    <td>
                        <?php if(isset($_SESSION['user']) && $row['SoLuong'] > 0): ?>
                            <a href="index.php?controller=hocphan&action=addToCart&id=<?= $row['MaHP'] ?>" class="btn btn-primary btn-sm">Đăng ký</a>
                        <?php elseif($row['SoLuong'] <= 0): ?>
                            <button class="btn btn-secondary btn-sm" disabled>Đã hết chỗ</button>
                        <?php else: ?>
                            <a href="index.php?controller=auth&action=login" class="btn btn-info btn-sm">Đăng nhập để đăng ký</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'views/layouts/footer.php'; ?>