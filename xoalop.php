<?php
$conn = new mysqli("localhost", "root", "", "qlsinhvien");
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

if (isset($_GET['malop'])) {
    $malop = $_GET['malop'];

    // Kiểm tra có sinh viên trong lớp không?
    $check = $conn->query("SELECT COUNT(*) AS total FROM tbsinhvien WHERE malop = '$malop'");
    $count = $check->fetch_assoc()['total'];

    if ($count > 0) {
        echo "<script>alert('Không thể xóa lớp vì có sinh viên đang học.'); window.location.href='qllop.php';</script>";
    } else {
        $conn->query("DELETE FROM tblop WHERE malop = '$malop'");
        echo "<script>alert('Xóa lớp thành công!'); window.location.href='qllop.php';</script>";
    }
}
$conn->close();
?>
