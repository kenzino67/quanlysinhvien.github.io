<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "qlsinhvien");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['masv'])) {
    $masv = $_GET['masv'];

    // Xóa sinh viên
    $sql = "DELETE FROM tbsinhvien WHERE masv = '$masv'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Xóa thành công!'); window.location.href='xemtheolop.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Không có mã sinh viên.";
}

$conn->close();
?>
