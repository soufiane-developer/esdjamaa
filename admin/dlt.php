<?php
include '../connect.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM news WHERE id = :id");
$stmt->execute([':id' => $id]);

header('Location: add_news.php');
?>
