<?php
include '../connect.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM news WHERE id = :id");
$stmt->execute([':id' => $id]);
$news = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE news SET title = :title, content = :content, date = :date WHERE id = :id");
    $stmt->execute([
        ':title' => $title,
        ':content' => $content,
        ':date' => $date,
        ':id' => $id
    ]);

    header('Location: add_news.php');
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    direction: rtl;
    text-align: right;
    margin: 0;
    padding: 0;
}

.news-form-container {
    width: 50%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input[type="text"],
input[type="date"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #218838;
}

    </style>
    <title>تعديل الخبر</title>
</head>
<body>
<div class="news-form-container">
        <h2>تعديل الخبر</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="title">العنوان:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($news['title']) ?>" required>
            </div>

            <div class="form-group">
                <label for="date">التاريخ:</label>
                <input type="date" id="date" name="date" value="<?= htmlspecialchars($news['date']) ?>" required>
            </div>

            <div class="form-group">
                <label for="content">الوصف:</label>
                <textarea id="content" name="content" rows="5" required><?= htmlspecialchars($news['content']) ?></textarea>
            </div>

            <button type="submit">تحديث</button>
        </form>
    </div>
</body>
</html>
