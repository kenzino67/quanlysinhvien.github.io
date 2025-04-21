<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $pass = $_POST["pass"];

    $conn = new mysqli("localhost", "root", "", "qlsinhvien");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $sql = "INSERT INTO tbuser (name, pass) VALUES ('$name', '$pass')";
    if ($conn->query($sql) === TRUE) {
        header("Location: qltk.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Tài Khoản</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-green-700 text-center mb-6">Thêm Tài Khoản</h2>
        <form method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow-md space-y-4">
            <div>
                <label class="block font-medium text-gray-700">Tên đăng nhập</label>
                <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Mật khẩu</label>
                <input type="text" name="pass" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lưu</button>
                <a href="qltk.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
