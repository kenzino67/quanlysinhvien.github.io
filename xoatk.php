<?php
$conn = new mysqli("localhost", "root", "", "qlsinhvien");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$id = $_GET["id"];
$sql = "DELETE FROM tbuser WHERE id=$id";
$conn->query($sql);
$conn->close();

header("Location: qltk.php");
exit();
?>
