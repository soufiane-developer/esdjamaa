<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $customerId = $_GET['id'];
    $stmt = $conn->prepare("SELECT name_customar AS name, phone, address, name_product AS product FROM customar WHERE id = :id");
    $stmt->bindParam(':id', $customerId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($customer);
    } else {
        echo json_encode([]);
    }
}
?>
