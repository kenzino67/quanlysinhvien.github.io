<?php
$conn = new mysqli("localhost", "root", "", "qlsinhvien");
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

$malop = $_GET['malop'];
$result = $conn->query("SELECT * FROM tblop WHERE malop = '$malop'");
$lop = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenlop = $_POST['tenlop'];
    $sosv = $_POST['sosv'];

    $sql = "UPDATE tblop SET tenlop='$tenlop', sosv='$sosv' WHERE malop='$malop'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cập nhật lớp thành công!'); window.location.href='qllop.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa lớp học</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 shadow rounded">
        <h2 class="text-xl font-bold text-center text-green-700 mb-4">SỬA LỚP HỌC</h2>
        <form method="POST">
            <input class="w-full mb-3 p-2 border rounded bg-gray-200" value="<?= $lop['malop'] ?>" readonly>
            <input name="tenlop" class="w-full mb-3 p-2 border rounded" value="<?= $lop['tenlop'] ?>" required>
            <input name="sosv" class="w-full mb-3 p-2 border rounded" type="number" value="<?= $lop['sosv'] ?>" required>
            <div class="text-center">
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Cập nhật</button>
                <a href="qllop.php" class="ml-4 text-red-500 hover:underline">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
