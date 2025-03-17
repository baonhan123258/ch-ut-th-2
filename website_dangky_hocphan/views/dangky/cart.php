<?php include 'views/layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Giỏ đăng ký học phần</h2>
    
    <?php if(empty($cart_items)): ?>
        <div class="alert alert-info">
            Chưa có học phần nào được chọn.
        </div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Mã HP</th>
                    <th>Tên học phần</th>
                    <th>Số tín chỉ</th>
                    <th>Còn lại</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cart_items as $item): ?>
                    <tr>
                        <td><?= $item['MaHP'] ?></td>
                        <td><?= $item['TenHP'] ?></td>
                        <td><?= $item['SoTinChi'] ?></td>
                        <td><?= $item['SoLuong'] ?></td>
                        <td>
                            <a href="index.php?controller=dangky&action=removeFromCart&id=<?= $item['MaHP'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="mt-3">
            <a href="index.php?controller=dangky&action=save" class="btn btn-primary">Lưu đăng ký</a>
            <a href="index.php?controller=dangky&action=clearCart" class="btn btn-secondary">Xóa đăng ký</a>
            <a href="index.php?controller=hocphan&action=index" class="btn btn-info">Tiếp tục đăng ký</a>
        </div>
    <?php endif; ?>
</div>

<?php include 'views/layouts/footer.php'; ?>