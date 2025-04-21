<?php
$conn = new mysqli("localhost", "root", "", "qlsinhvien");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$id = $_GET["id"];
$sql = "SELECT * FROM tbuser WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $sql_update = "UPDATE tbuser SET name='$name', pass='$pass' WHERE id=$id";
    if ($conn->query($sql_update) === TRUE) {
        header("Location: qltk.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Tài Khoản</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-green-700 text-center mb-6">Sửa Tài Khoản</h2>
        <form method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow-md space-y-4">
            <div>
                <label class="block font-medium text-gray-700">Tên đăng nhập</label>
                <input type="text" name="name" value="<?= $row["name"] ?>" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Mật khẩu</label>
                <input type="text" name="pass" value="<?= $row["pass"] ?>" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cập nhật</button>
                <a href="qltk.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
