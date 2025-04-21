<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "qlsinhvien");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Phân trang
$limit = 8; // số SV mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Truy vấn dữ liệu sinh viên với giới hạn
$sql = "SELECT * FROM tbsinhvien LIMIT $start_from, $limit";
$result = $conn->query($sql);

// Tính tổng số sinh viên để phân trang
$sql_total = "SELECT COUNT(*) AS total FROM tbsinhvien";
$total_result = $conn->query($sql_total);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row["total"];
$total_pages = ceil($total_records / $limit);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Lớp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Sử dụng CSS Grid để hiển thị danh sách sinh viên dưới dạng ô lưới */
        .student-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 cột cho mỗi hàng */
            gap: 16px; /* Khoảng cách giữa các ô */
        }
        .student-card {
            background-color: #fff;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .student-card:hover {
            transform: translateY(-5px); /* Khi hover sẽ đẩy ô lên một chút */
        }
        .student-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        /* Responsive: khi màn hình nhỏ hơn 768px, hiển thị 2 cột */
        @media (max-width: 768px) {
            .student-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        /* Responsive: khi màn hình nhỏ hơn 480px, hiển thị 1 cột */
        @media (max-width: 480px) {
            .student-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto">
        <!-- Header -->
        <div class="bg-cover bg-center py-8 text-white shadow-md" style="background-image: url('images/anhnen.jpg');">
            <div class="bg-green-900 bg-opacity-60 py-4">
                <div class="text-center">
                    <h1 class="text-2xl font-bold">TRANG CHỦ</h1>
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
                    <p class="text-gray-700">Điện thoại: 099 9999999</p>
                    <p class="text-gray-700">Email: truongquockiet@gmail.com</p>
                </div>
            </div>

            <!-- Main content (Danh sách sinh viên theo dạng lưới) -->
            <div class="w-3/4 p-4">
                <h2 class="text-2xl font-bold text-green-700 text-center mb-6">Danh sách sinh viên</h2>

                <!-- Lưới sinh viên -->
                <div class="student-grid">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="student-card">
                                <img src="<?= $row['hinhanh'] ?>" alt="Hình ảnh sinh viên" class="student-img">
                                <h3 class="font-semibold text-lg"><?= $row['tensv'] ?></h3>
                                <p class="text-gray-600">Mã SV: <?= $row['masv'] ?></p>
                                <p class="text-gray-600">Mã Lớp: <?= $row['malop'] ?></p>
                                <div class="mt-4">
                                    <a href="suasv.php?masv=<?= $row['masv'] ?>" class="text-blue-500 hover:underline">Sửa</a> | 
                                    <a href="xoasv.php?masv=<?= $row['masv'] ?>" class="text-red-500 hover:underline" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xóa</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="col-span-4 text-center text-red-500">Không có sinh viên nào.</p>
                    <?php endif; ?>
                </div>

                <!-- Phân trang -->
                <div class="flex justify-center mt-6">
                    <div class="flex space-x-2">
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active = ($i == $page) ? "bg-green-500 text-white" : "bg-gray-200 text-gray-700";
                            echo "<a href='?page=$i' class='px-3 py-1 rounded $active'>$i</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
