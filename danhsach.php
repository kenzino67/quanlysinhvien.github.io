<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "qlsinhvien");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách lớp
$lop_result = $conn->query("SELECT * FROM tblop");

// Xử lý chọn lớp
$selected_class = isset($_GET['malop']) ? $_GET['malop'] : '';
$sql = "SELECT * FROM tbsinhvien";
if ($selected_class != '') {
    $sql .= " WHERE malop = '$selected_class'";
}
$sv_result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên theo lớp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto">

        <!-- Header -->
        <div class="bg-cover bg-center py-8 text-white shadow-md" style="background-image: url('images/anhnen.jpg');">
            <div class="bg-green-900 bg-opacity-60 py-4">
                <div class="text-center">
                    <h1 class="text-2xl font-bold">TRANG QUẢN LÝ SINH VIÊN</h1>
                    <p class="text-sm">Trường Cao đẳng Sư Phạm Tây Ninh</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="bg-green-900 border border-black py-2">
            <div class="flex justify-between items-center px-4">
                <div class="flex space-x-4">
                    <a href="ttsv.php" class="text-white hover:underline">Trang chủ</a>
                    <a href="#" class="text-white hover:underline">Giới thiệu</a>
                    <a href="logout.php" class="text-white hover:underline">Đăng xuất</a>
                </div>
                <div class="flex items-center space-x-3">
    <i class="fas fa-user text-white"></i>
    <a href="login.php" class="bg-white text-green-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-green-100 transition duration-200 shadow">
        admin
    </a>
</div>

            </div>
        </div>

        <!-- Main Content -->
        <div class="flex mt-4">
            <!-- Sidebar -->
            <div class="w-1/4 bg-green-100 p-4">
                <h2 class="text-lg font-bold text-white bg-green-700 px-4 py-2">   ➤ Menu</h2>
                <ul class="mt-2 space-y-2">
                    <li><a href="themsv.php" class="flex items-center px-4 py-2 hover:bg-green-600 hover:text-white rounded">▦ Thêm sinh viên</a></li>
                    <li><a href="qlsv.php" class="flex items-center px-4 py-2 hover:bg-green-600 hover:text-white rounded">▦ Quản lý sinh viên</a></li>
                    <li><a href="themlop.php" class="flex items-center px-4 py-2 hover:bg-green-600 hover:text-white rounded">▦ Thêm lớp</a></li>
                    <li><a href="qllop.php" class="flex items-center px-4 py-2 hover:bg-green-600 hover:text-white rounded">▦ Quản lý lớp</a></li>
                    <li><a href="danhsach.php" class="flex items-center px-4 py-2 hover:bg-green-600 hover:text-white rounded bg-green-600 text-white">▦ Xem DSSV theo lớp</a></li>
                    <li><a href="qltk.php" class="flex items-center px-4 py-2 hover:bg-green-600 hover:text-white rounded">▦ Quản lý tài khoản</a></li>
                </ul>
                <h2 class="text-lg font-bold text-white bg-green-700 px-4 py-2 mt-6">  ➤ Liên hệ</h2>
                <p class="mt-2 text-gray-700">Trang quản lý sinh viên</p>
                <p class="text-gray-700">Điện thoại: 099 9999999</p>
                <p class="text-gray-700">Email: truongquockiet@gmail.com</p>
            </div>

            <!-- Main Section -->
            <div class="w-3/4 bg-green-50 p-4 shadow-md">
                <div class="text-center mb-6">
                    <h2 class="text-xl font-bold text-green-700">DANH SÁCH SINH VIÊN THEO LỚP</h2>
                </div>

                <!-- Combo Box -->
                <form method="GET" class="mb-4 flex space-x-4 items-center">
                    <label class="text-gray-700 font-semibold">Chọn lớp:</label>
                    <select name="malop" onchange="this.form.submit()" class="border border-gray-300 rounded px-3 py-2">
                        <option value="">-- Tất cả lớp --</option>
                        <?php while ($lop = $lop_result->fetch_assoc()) : ?>
                            <option value="<?= $lop['Malop'] ?>" <?= ($selected_class == $lop['Malop']) ? 'selected' : '' ?>>
                                <?= $lop['Tenlop'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </form>

                <!-- Bảng sinh viên -->
                <table class="min-w-full bg-white text-sm">
                    <thead>
                        <tr class="bg-gray-200 text-center">
                            <th class="py-2 px-4 border">Mã SV</th>
                            <th class="py-2 px-4 border">Tên SV</th>
                            <th class="py-2 px-4 border">Giới tính</th>
                            <th class="py-2 px-4 border">Điện thoại</th>
                            <th class="py-2 px-4 border">Địa chỉ</th>
                            <th class="py-2 px-4 border">Mã lớp</th>
                            <th class="py-2 px-4 border">Hình ảnh</th>
                            <th class="py-2 px-4 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($sv_result->num_rows > 0): ?>
                            <?php while ($row = $sv_result->fetch_assoc()): ?>
                                <tr class="text-center">
                                    <td class="py-2 px-4 border"><?= $row['masv'] ?></td>
                                    <td class="py-2 px-4 border"><?= $row['tensv'] ?></td>
                                    <td class="py-2 px-4 border"><?= $row['gioitinh'] ?></td>
                                    <td class="py-2 px-4 border"><?= $row['dienthoai'] ?></td>
                                    <td class="py-2 px-4 border"><?= $row['diachi'] ?></td>
                                    <td class="py-2 px-4 border"><?= $row['malop'] ?></td>
                                    <td class="py-2 px-4 border">
                                        <img src="<?= $row['hinhanh'] ?>" alt="Hình SV" class="w-10 h-10 object-cover rounded-full mx-auto">
                                    </td>
                                    <td class="py-2 px-4 border space-x-2">
                                        <a href="suasv.php?masv=<?= $row['masv'] ?>" class="text-blue-500 hover:underline"><i class="fas fa-edit"></i> Sửa</a>
                                        <a href="xoasv.php?masv=<?= $row['masv'] ?>" class="text-red-500 hover:underline" onclick="return confirm('Xóa sinh viên này?');"><i class="fas fa-trash"></i> Xóa</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-red-500">Không có sinh viên nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Nút thêm sinh viên -->
                <div class="flex justify-end mt-4">
                    <a href="themsv.php" class="text-blue-600 font-medium hover:underline"><i class="fas fa-plus-circle"></i> Thêm sinh viên</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
