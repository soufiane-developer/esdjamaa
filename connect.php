<?php
$db_name = 'mysql:host=localhost;dbname=esd';
$user_name = 'root';
$user_password = '';

try {
    $conn = new PDO($db_name, $user_name, $user_password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "الاتصال بقاعدة البيانات ناجح!";
} catch (PDOException $e) {

    echo "فشل في الاتصال بقاعدة البيانات: " . $e->getMessage();
}
?>
