<?php
include '../connect.php';

$searchTerm = $_GET['search'] ?? '';
$searchQuery = '';

if ($searchTerm) {
    $searchQuery = " WHERE title LIKE :search ";
}

$stmt = $conn->prepare("SELECT * FROM news $searchQuery ORDER BY date DESC");
if ($searchTerm) {
    $stmt->execute([':search' => "%$searchTerm%"]);
} else {
    $stmt->execute();
}
$newsList = $stmt->fetchAll();

foreach ($newsList as $news) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($news['title']) . '</td>';
    echo '<td>' . htmlspecialchars($news['date']) . '</td>';
    echo '<td><img src="../img/news/' . htmlspecialchars($news['image']) . '" alt="news image" width="100"></td>';
    echo '<td>';
    echo '<a href="edit_news.php?id=' . $news['id'] . '" class="edit">تعديل</a>';
    echo ' ';
    echo '<a href="delete_news.php?id=' . $news['id'] . '" class="delete" onclick="return confirm(\'هل أنت متأكد من حذف هذا الخبر؟\')">حذف</a>';
    echo '</td>';
    echo '</tr>';
}
?>
