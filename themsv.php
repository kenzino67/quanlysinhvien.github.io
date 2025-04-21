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
                    <h1 class="text-2xl font-bold">TRANG QUẢN LÝ LỚP</h1>
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
                
                <table class="min-w-full bg-white">
                  
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

// Xử lý form khi người dùng nhấn "Thêm"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $masv = $_POST['masv'];
    $tensv = $_POST['tensv'];
    $gioitinh = $_POST['gioitinh'];
    $dienthoai = $_POST['dienthoai'];
    $diachi = $_POST['diachi'];
    $malop = $_POST['malop'];
    
    // Xử lý upload hình ảnh
    $hinhanh = "";
    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0) {
        $hinhanh = 'images/' . basename($_FILES['hinhanh']['name']);
        move_uploaded_file($_FILES['hinhanh']['tmp_name'], $hinhanh);
    }

    // Thêm dữ liệu vào CSDL
    $sql = "INSERT INTO tbsinhvien (masv, tensv, gioitinh, dienthoai, diachi, malop, hinhanh)
            VALUES ('$masv', '$tensv', '$gioitinh', '$dienthoai', '$diachi', '$malop', '$hinhanh')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm sinh viên thành công!'); window.location.href = 'qlsv.php';</script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
    <div class="w-3/4 mx-auto bg-green-900 py-4 text-white text-center shadow-md rounded-t">
    <h1 class="text-2xl font-bold">Thêm Thông Tin Sinh Viên</h1>
</div>


        <!-- Form Thêm Sinh Viên -->
        <div class="w-3/4 mx-auto bg-green-50 p-6 shadow-md rounded-b">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-1">Mã Sinh Viên</label>
                <input type="text" name="masv" required class="w-full px-3 py-2 border rounded focus:ring focus:border-green-500">
            </div>
            <div>
                <label class="block font-medium mb-1">Tên Sinh Viên</label>
                <input type="text" name="tensv" required class="w-full px-3 py-2 border rounded focus:ring focus:border-green-500">
            </div>
            <div>
                <label class="block font-medium mb-1">Giới Tính</label>
                <select name="gioitinh" required class="w-full px-3 py-2 border rounded focus:ring focus:border-green-500">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div>
                <label class="block font-medium mb-1">Điện Thoại</label>
                <input type="text" name="dienthoai" required class="w-full px-3 py-2 border rounded focus:ring focus:border-green-500">
            </div>
            <div class="col-span-2">
                <label class="block font-medium mb-1">Địa Chỉ</label>
                <input type="text" name="diachi" required class="w-full px-3 py-2 border rounded focus:ring focus:border-green-500">
            </div>
            <div>
                <label class="block font-medium mb-1">Mã Lớp</label>
                <input type="text" name="malop" required class="w-full px-3 py-2 border rounded focus:ring focus:border-green-500">
            </div>
            <div>
                <label class="block font-medium mb-1">Hình Ảnh</label>
                <input type="file" name="hinhanh" class="w-full px-3 py-2 border rounded">
            </div>
        </div>

        <p class="text-sm text-gray-600 mt-2 text-center w-full"> Lưu ý: Chỉ cho phép .jpg, .jpeg, .png, .gif. Kích thước tối đa 2MB.</p>
        <div class="pt-6">
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded font-semibold transition duration-200">
                Thêm Sinh Viên
            </button>
        </div>
    </form>
        </div>
    </div>
</div>
</body>
</html>