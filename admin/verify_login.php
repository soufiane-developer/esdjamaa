<?php
session_start();

// إعداد الوقت لنهاية صلاحية الرمز
$expiry_time = 300; // 5 دقائق

// تحقق مما إذا كان رمز التحقق قد تم إنشاؤه
if (!isset($_SESSION['verification_code'])) {
    // توليد وإرسال رمز تحقق جديد
    $verification_code = rand(100000, 999999);
    $_SESSION['verification_code'] = $verification_code;
    $_SESSION['verification_code_time'] = time(); // تحديث وقت توليد الرمز
    send_verification_code($verification_code);
}

// معالجة نموذج التحقق
$messages = []; // مصفوفة لتخزين الرسائل
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_code = $_POST['code']; // الرمز المدخل من قبل المستخدم

    // تحقق مما إذا كان رمز التحقق موجودًا قبل الوصول إليه
    if (isset($_SESSION['verification_code_time'])) {
        // التحقق من انتهاء صلاحية الرمز
        if (time() - $_SESSION['verification_code_time'] > $expiry_time) {
            $messages[] = "الرمز قد انتهت صلاحيته.";
            unset($_SESSION['verification_code']); // حذف الرمز إذا انتهت صلاحيته
            unset($_SESSION['verification_code_time']); // حذف وقت توليد الرمز
        } else {
            // التحقق من الرمز المدخل
            if ($user_code == $_SESSION['verification_code']) {
                unset($_SESSION['verification_code']);
                unset($_SESSION['verification_code_time']);
                header('Location: dashboard.php');
                exit(); // تأكد من الخروج بعد التوجيه
            } else {
                $messages[] = "الرمز غير صحيح.";
            }
        }
    } else {
        $messages[] = "الرمز غير موجود. يرجى إعادة إرسال رمز التحقق.";
    }
}

// إعادة إرسال الرمز
if (isset($_POST['resend'])) {
    $verification_code = rand(100000, 999999);
    $_SESSION['verification_code'] = $verification_code;
    $_SESSION['verification_code_time'] = time(); // تحديث وقت توليد الرمز
    send_verification_code($verification_code);
    $messages[] = "تم إرسال رمز تحقق جديد.";
}

function send_verification_code($code) {
    // قم بتعديل هذا الجزء لإرسال الرمز عبر SMS أو البريد الإلكتروني
    // يمكنك استبدال السطر التالي بطريقة الإرسال الفعلية
    return "تم إرسال رمز التحقق: " . $code; // فقط للعرض
}

// عرض الرسائل للمستخدم
include '../message_net.php';
foreach ($messages as $message) {
    echo "<p>$message</p>";
}
?>

<!-- نموذج التحقق -->
<form method="POST" action="">
    <input type="text" name="code" placeholder="أدخل رمز التحقق" required>
    <input type="submit" value="تحقق">
    <input type="submit" name="resend" value="إعادة إرسال الرمز">
</form>
