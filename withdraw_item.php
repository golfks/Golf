<?php
include 'db.php';

$item_id = intval($_POST['item_id']);
$uid = $_POST['uid'] ?? '';

if ($item_id && $uid) {
    $conn->query("UPDATE items SET quantity = quantity - 1 WHERE id = $item_id");
    $log = $conn->prepare("INSERT INTO item_logs (item_id, uid, action, quantity) VALUES (?, ?, 'withdraw', 1)");
    $log->bind_param("is", $item_id, $uid);
    $log->execute();
}
header("Location: index.php");
exit;
?>