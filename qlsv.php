<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Lớp</title>
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
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-white bg-green-700 px-4 py-2 w-full"> ➤ Menu</h2>
                    <ul class="mt-2 space-y-2">
                        <li><a href="themsv.php" class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Thêm sinh viên</a></li>
                        <li><a href="qlsv.php" class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Quản lý sinh viên</a></li>
                        <li><a href="themlop.php" class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Thêm lớp</a></li>
                        <li><a href="qllop.php" class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Quản lý lớp</a></li>
                        <li><a href="danhsach.php" class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Xem DSSV theo lớp</a></li>
                        <li><a href="qltk.php" class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white rounded">▦ Quản lý tài khoản</a></li>
                    </ul>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white bg-green-700 px-4 py-2 w-full mt-6"> ➤ Liên hệ</h2>
                    <p class="mt-2 text-gray-700">Trang quản lý lớp học</p>
                    <p class="text-gray-700">Điện thoại: 099 9999999</p>
                    <p class="text-gray-700">Email: truongquockiet@gmail.com</p>
                </div>
            </div>


            <!-- Main Section -->
            <div class="w-3/4 bg-green-50 p-4 shadow-md">
                <div class="text-center mb-4">
                    <h2 class="text-xl font-bold text-green-700">THÔNG TIN SINH VIÊN</h2>
                </div>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Mã Sv</th>
                            <th class="py-2 px-4 border-b">Tên Sv</th>
                            <th class="py-2 px-4 border-b">Giới tính</th>
                            <th class="py-2 px-4 border-b">Điện thoại</th>
                            <th class="py-2 px-4 border-b">Địa chỉ</th>
                            <th class="py-2 px-4 border-b">Mã lớp</th>
                            <th class="py-2 px-4 border-b">Hình ảnh</th>
                            <th class="py-2 px-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
$limit = 5; // số SV mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Truy vấn dữ liệu sinh viên với giới hạn
$sql = "SELECT * FROM tbsinhvien LIMIT $start_from, $limit";
$result = $conn->query($sql);

// Hiển thị dữ liệu
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='py-2 px-4 border-b'>" . $row["masv"] . "</td>";
        echo "<td class='py-2 px-4 border-b'>" . $row["tensv"] . "</td>";
        echo "<td class='py-2 px-4 border-b'>" . $row["gioitinh"] . "</td>";
        echo "<td class='py-2 px-4 border-b'>" . $row["dienthoai"] . "</td>";
        echo "<td class='py-2 px-4 border-b'>" . $row["diachi"] . "</td>";
        echo "<td class='py-2 px-4 border-b'>" . $row["malop"] . "</td>";
        echo "<td class='py-2 px-4 border-b'>
                <img src='" . $row["hinhanh"] . "' alt='Hình SV' class='w-10 h-10 object-cover rounded-full'>
              </td>";
        echo "<td class='py-2 px-4 border-b space-x-2'>
                <a href='edit.php?masv=" . $row["masv"] . "' class='text-blue-500'><i class='fas fa-edit'></i> Sửa</a>
                <a href='delete.php?masv=" . $row["masv"] . "' class='text-red-500' onclick=\"return confirm('Xóa sinh viên này?');\"><i class='fas fa-trash'></i> Xóa</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center py-4'>Không có sinh viên nào.</td></tr>";
}

// Tính tổng số sinh viên để phân trang
$sql_total = "SELECT COUNT(*) AS total FROM tbsinhvien";
$total_result = $conn->query($sql_total);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row["total"];
$total_pages = ceil($total_records / $limit);

// Đóng kết nối
$conn->close();
?>

</tbody>
                </table>
                <div class="flex justify-between items-center mt-4">
    <div class="flex space-x-2">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $page) ? "bg-green-500 text-white" : "bg-gray-200 text-gray-700";
            echo "<a href='?page=$i' class='px-3 py-1 rounded $active'>$i</a>";
        }
        ?>
    </div>
    <a href="add.php" class="text-blue-500">+ Thêm sinh viên</a>
</div>

            </div>
        </div>
    </div>
</body>
</html>