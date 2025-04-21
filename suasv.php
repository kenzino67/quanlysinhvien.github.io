<?php
$conn = new mysqli("localhost", "root", "", "qlsinhvien");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['masv'])) {
    $masv = $_GET['masv'];

    // Lấy thông tin SV
    $sql = "SELECT * FROM tbsinhvien WHERE masv = '$masv'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $sv = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sinh viên.";
        exit;
    }
}

// Cập nhật sau khi gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tensv = $_POST['tensv'];
    $gioitinh = $_POST['gioitinh'];
    $dienthoai = $_POST['dienthoai'];
    $diachi = $_POST['diachi'];
    $malop = $_POST['malop'];

    $sql_update = "UPDATE tbsinhvien SET 
        tensv='$tensv', 
        gioitinh='$gioitinh', 
        dienthoai='$dienthoai', 
        diachi='$diachi',
        malop='$malop' 
        WHERE masv='$masv'";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='xemtheolop.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sinh viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white rounded shadow-md max-w-lg">
        <h2 class="text-xl font-bold text-center text-green-700 mb-6">SỬA THÔNG TIN SINH VIÊN</h2>
        <form method="POST">
            <div class="mb-4">
                <label class="block mb-1">Tên sinh viên:</label>
                <input type="text" name="tensv" value="<?= $sv['tensv'] ?>" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Giới tính:</label>
                <select name="gioitinh" class="w-full border px-3 py-2 rounded">
                    <option value="Nam" <?= $sv['gioitinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= $sv['gioitinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Điện thoại:</label>
                <input type="text" name="dienthoai" value="<?= $sv['dienthoai'] ?>" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Địa chỉ:</label>
                <input type="text" name="diachi" value="<?= $sv['diachi'] ?>" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Mã lớp:</label>
                <input type="text" name="malop" value="<?= $sv['malop'] ?>" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Cập nhật</button>
                <a href="ttsv.php" class="ml-4 text-red-500 hover:underline">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
