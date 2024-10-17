<?php
// الاتصال بقاعدة البيانات
$dsn = 'mysql:host=localhost;dbname=esd';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // التحقق من وجود ID في الرابط
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        // حذف العضو بناءً على ID
        $stmt = $pdo->prepare("DELETE FROM matches WHERE id = ?");
        $stmt->execute([$id]);
        header('Location:add_match.php');

    } else {
        die('ID غير موجود.');
    }
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>
