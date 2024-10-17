<?php

$host = 'localhost'; 
$db   = 'esd'; 
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $object = trim($_POST['object']);
    $message = trim($_POST['message']);

    if (empty($object) || empty($message)) {
        die("الرجاء ملء جميع الحقول المطلوبة.");
    }

    $fileName = null; 

    // التحقق من وجود ملف مرفق
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileDestination = '../../uploads/' . $fileName;

        // تحقق من نوع الملف
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedTypes = ['pdf', 'doc', 'docx']; // أنواع الملفات المسموح بها

        if (in_array($fileType, $allowedTypes)) {
            // نقل الملف إلى الدليل المستهدف
            if (!move_uploaded_file($fileTmpPath, $fileDestination)) {
                die("فشل في تحميل الملف.");
            }
        } else {
            die("نوع الملف غير مدعوم. يُسمح بتحميل ملفات PDF و Word فقط.");
        }
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO messages (object, message, file) VALUES (?, ?, ?)");
        $stmt->execute([$object, $message, $fileName]);

        echo "تم إرسال الرسالة بنجاح!";
    } catch (PDOException $e) {
        die("فشل في إدخال البيانات: " . $e->getMessage());
    }
}
?>
