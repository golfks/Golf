<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
    }
}
?>

<h2>เข้าสู่ระบบแอดมิน</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
    <input type="text" name="username" placeholder="ชื่อผู้ใช้"><br>
    <input type="password" name="password" placeholder="รหัสผ่าน"><br>
    <button type="submit">เข้าสู่ระบบ</button>
</form>