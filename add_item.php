<?php
include 'db.php';

$uid = $_POST['uid'] ?? '';
$name = $_POST['item_name'] ?? '';
$quantity = intval($_POST['quantity']);

if ($uid && $name && $quantity > 0) {
    $stmt = $conn->prepare("INSERT INTO items (name, quantity) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $quantity);
    $stmt->execute();
    $item_id = $stmt->insert_id;

    $log = $conn->prepare("INSERT INTO item_logs (item_id, uid, action, quantity) VALUES (?, ?, 'add', ?)");
    $log->bind_param("isi", $item_id, $uid, $quantity);
    $log->execute();

    header("Location: index.php");
    exit;
} else {
    echo "ข้อมูลไม่ครบ";
}
?>