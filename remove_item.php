<?php
// بدء الجلسة
session_start();

// الاتصال بقاعدة البيانات
try {
    $db = new PDO('mysql:host=localhost;dbname=esd', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'خطأ في الاتصال بقاعدة البيانات: ' . $e->getMessage()]);
    exit;
}

// الحصول على بيانات المنتج المرسل من الجهة الأمامية
$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['product_id'] ?? null;

if (!$productId) {
    echo json_encode(['success' => false, 'message' => 'لم يتم توفير معرف المنتج']);
    exit;
}

// التحقق من تسجيل دخول المستخدم
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'يجب تسجيل الدخول لحذف المنتج من السلة']);
    exit;
}

try {
    // حذف المنتج من سلة المستخدم
    $stmt = $db->prepare('DELETE FROM cart WHERE user_id = ? AND id_product = ?');
    $stmt->execute([$userId, $productId]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'تم حذف المنتج بنجاح من السلة']);
    } else {
        echo json_encode(['success' => false, 'message' => 'المنتج غير موجود في السلة']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'خطأ أثناء حذف المنتج: ' . $e->getMessage()]);
}
?>
