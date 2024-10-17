<?php

session_start();


try {
    $db = new PDO('mysql:host=localhost;dbname=esd', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'خطأ في الاتصال بقاعدة البيانات: ' . $e->getMessage()]);
    exit;
}


$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data) || empty($data)) {
    echo json_encode(['success' => false, 'message' => 'لم يتم استلام أي بيانات']);
    exit;
}


$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'يجب تسجيل الدخول لإتمام الشراء']);
    exit;
}

try {

    $db->beginTransaction();


    $stmt = $db->prepare('INSERT INTO orders (user_id, order_date) VALUES (?, NOW())');
    $stmt->execute([$userId]);
    

    $orderId = $db->lastInsertId();


    $stmt = $db->prepare('INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)');

    foreach ($data as $item) {
        $stmt->execute([$orderId, $item['id'], $item['quantity']]);
    }

    // إتمام المعاملة
    $db->commit();

    // الرد بنجاح
    echo json_encode(['success' => true, 'message' => 'تم إتمام الطلب بنجاح!']);

} catch (PDOException $e) {
    // في حالة حدوث خطأ، إلغاء المعاملة
    $db->rollBack();
    echo json_encode(['success' => false, 'message' => 'خطأ أثناء إتمام الطلب: ' . $e->getMessage()]);
}
?>
