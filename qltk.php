<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsinhvien";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Phân trang
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Lấy danh sách tài khoản
$sql = "SELECT * FROM tbuser LIMIT $start_from, $limit";
$result = $conn->query($sql);

// Tính tổng số trang
$sql_total = "SELECT COUNT(*) AS total FROM tbuser";
$total_result = $conn->query($sql_total);
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row["total"] / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý tài khoản</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto">
        <!-- Header -->
        <div class="bg-cover bg-center py-8 text-white shadow-md" style="background-image: url('images/anhnen.jpg');">
            <div class="bg-green-900 bg-opacity-60 py-4">
                <div class="text-center">
                    <h1 class="text-2xl font-bold">TRANG QUẢN LÝ TÀI KHOẢN</h1>
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
                <h2 class="text-lg font-bold text-white bg-green-700 px-4 py-2">➤ Menu</h2>
                <ul class="mt-2 space-y-2">
                    <li><a href="themsv.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Thêm sinh viên</a></li>
                    <li><a href="qlsv.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Quản lý sinh viên</a></li>
                    <li><a href="themlop.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Thêm lớp</a></li>
                    <li><a href="qllop.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Quản lý lớp</a></li>
                    <li><a href="danhsach.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Xem DSSV theo lớp</a></li>
                    <li><a href="qltk.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Quản lý tài khoản</a></li>
                </ul>

                <h2 class="text-lg font-bold text-white bg-green-700 px-4 py-2 mt-6">➤ Liên hệ</h2>
                <p class="mt-2 text-gray-700">Trang quản lý sinh viên</p>
                <p class="text-gray-700">Điện thoại: 099 9999999</p>
                <p class="text-gray-700">Email: truongquockiet@gmail.com</p>
            </div>

            <!-- Main Section -->
            <div class="w-3/4 bg-green-50 p-4 shadow-md">
                <div class="text-center mb-4">
                    <h2 class="text-xl font-bold text-green-700">DANH SÁCH TÀI KHOẢN</h2>
                </div>

                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Tên đăng nhập</th>
                            <th class="py-2 px-4 border-b">Mật khẩu</th>
                            <th class="py-2 px-4 border-b">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border-b'>" . $row["id"] . "</td>";
                                echo "<td class='py-2 px-4 border-b'>" . $row["name"] . "</td>";
                                echo "<td class='py-2 px-4 border-b'>" . $row["pass"] . "</td>";
                                echo "<td class='py-2 px-4 border-b space-x-2'>
                                        <a href='suatk.php?id=" . $row["id"] . "' class='text-blue-500'><i class='fas fa-edit'></i> Sửa</a>
                                        <a href='xoatk.php?id=" . $row["id"] . "' class='text-red-500' onclick=\"return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');\"><i class='fas fa-trash'></i> Xóa</a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center py-4'>Không có tài khoản nào.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Pagination & Add -->
                <div class="flex justify-between items-center mt-4">
                    <div class="flex space-x-2">
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active = ($i == $page) ? "bg-green-500 text-white" : "bg-gray-200 text-gray-700";
                            echo "<a href='qltk.php?page=$i' class='px-3 py-1 rounded $active'>$i</a>";
                        }
                        ?>
                    </div>
                    <a href="themtk.php" class="text-blue-500">+ Thêm tài khoản</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
