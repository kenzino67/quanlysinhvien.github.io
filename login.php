<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $pass = $_POST["pass"];

    $conn = new mysqli("localhost", "root", "", "qlsinhvien");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM tbuser WHERE name='$name' AND pass='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user;
        header("Location: qltk.php");
        exit();
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-green-700 text-center mb-6">Đăng Nhập Hệ Thống</h2>
        
        <?php if (!empty($error)): ?>
            <div class="bg-red-100 text-red-700 border border-red-400 px-4 py-2 rounded mb-4 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
            <div>
                <label class="block text-green-700 font-semibold mb-1">Tên đăng nhập</label>
                <input type="text" name="name" required
                       class="w-full border border-green-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
            <div>
                <label class="block text-green-700 font-semibold mb-1">Mật khẩu</label>
                <input type="password" name="pass" required
                       class="w-full border border-green-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
            <div class="flex justify-between">
                <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200">
                    Đăng nhập
                </button>
                <a href="ttsv.php"
                   class="bg-green-300 text-white px-4 py-2 rounded hover:bg-green-400 transition duration-200">
                    Trang chủ
                </a>
            </div>
        </form>
    </div>
</body>
</html>
