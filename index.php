<?php
session_start();
include 'db.php';

$isAdmin = isset($_SESSION['admin']);

$result = $conn->query("SELECT * FROM items");
$items = $result->fetch_all(MYSQLI_ASSOC);
?>

<h1>ระบบเบิกวัตถุดิบ</h1>

<?php if ($isAdmin): ?>
    <p><a href="register_user.php">สมัครผู้ใช้ใหม่</a></p>
<?php endif; ?>

<form method="post" action="add_item.php">
    <input type="text" name="uid" placeholder="UID ผู้ใช้"><br>
    <input type="text" name="item_name" placeholder="ชื่อวัตถุดิบ"><br>
    <input type="number" name="quantity" placeholder="จำนวน"><br>
    <button type="submit">เพิ่มวัตถุดิบ</button>
</form>

<h2>รายการวัตถุดิบ</h2>
<ul>
<?php foreach ($items as $item): ?>
    <li>
        <?= htmlspecialchars($item['name']) ?> - คงเหลือ <?= $item['quantity'] ?>
        <form method="post" action="withdraw_item.php" style="display:inline;">
            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
            <input type="text" name="uid" placeholder="UID">
            <button type="submit">เบิก 1</button>
        </form>
    </li>
<?php endforeach; ?>
</ul>