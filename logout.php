<?php
session_start();

// إزالة جميع متغيرات الجلسة
session_unset();

// تدمير الجلسة
session_destroy();

// إزالة ملفات تعريف الارتباط الخاصة بالمستخدم (إذا تم تعيينها)
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, '/'); // تعيين مدة انتهاء الصلاحية في الماضي لحذف ملف تعريف الارتباط
}

// إعادة التوجيه إلى صفحة تسجيل الدخول
header('Location: home.php');
exit();
?>
