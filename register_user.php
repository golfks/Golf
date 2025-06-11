<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    die("เฉพาะแอดมินเท่านั้น");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $uid = $_POST['uid'] ?? '';
    if ($name && $uid) {
        $stmt = $conn->prepare("INSERT INTO users (name, uid) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $uid);
        $stmt->execute();
        echo "สมัครเรียบร้อยแล้ว <a href='index.php'>กลับ</a>";
        exit;
    }
}
?>

<h2>สมัครผู้ใช้ใหม่</h2>
<form method="post">
    <input type="text" name="name" placeholder="ชื่อผู้ใช้"><br>
    <input type="text" name="uid" placeholder="UID"><br>
    <button type="submit">สมัคร</button>
</form>