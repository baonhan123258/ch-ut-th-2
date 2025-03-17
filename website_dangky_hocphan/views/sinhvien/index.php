<?php include 'views/layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Danh sách sinh viên</h2>
    <a href="index.php?controller=sinhvien&action=create" class="btn btn-primary mb-3">Thêm sinh viên</a>
    
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Ngành học</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['MaSV'] ?></td>
                    <td><?= $row['HoTen'] ?></td>
                    <td><?= $row['GioiTinh'] ?></td>
                    <td><?= date('d/m/Y', strtotime($row['NgaySinh'])) ?></td>
                    <td><?= $row['TenNganh'] ?></td>
                    <td>
                        <a href="index.php?controller=sinhvien&action=detail&id=<?= $row['MaSV'] ?>" class="btn btn-info btn-sm">Chi tiết</a>
                        <a href="index.php?controller=sinhvien&action=edit&id=<?= $row['MaSV'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="index.php?controller=sinhvien&action=delete&id=<?= $row['MaSV'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'views/layouts/footer.php'; ?>