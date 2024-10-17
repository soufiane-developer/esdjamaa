<?php
// الاتصال بقاعدة البيانات
$pdo = new PDO('mysql:host=localhost;dbname=esd', 'root', '');

// التحقق من وجود تعليق
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["comment"]) && !empty($_POST["rating"])) {
    $comment = $_POST["comment"];
    $author = $_POST["name"];
    $rating = (int)$_POST["rating"]; 
    $date = date("Y-m-d");

    $stmt = $pdo->prepare("INSERT INTO comments (author, comment, rating, date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$author, $comment, $rating, $date]);

    header("Location: like.php");
    exit();
}

// استرجاع التعليقات (آخر 10 تعليقات فقط)
$stmt = $pdo->query("SELECT * FROM comments ORDER BY date DESC LIMIT 10");
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// استرجاع عدد الإعجابات
$stmt = $pdo->query("SELECT * FROM likes WHERE id = 1");
$likes_count = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>صفحة التقييمات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            direction: rtl;
            text-align: right;
            margin: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .likes {
            text-align: center;
            margin-bottom: 20px;
        }

        .likes span {
            font-size: 24px;
            color: #333;
        }

        .comment-form {
            margin-bottom: 30px;
        }

        .comment-form input[type="text"],
        .comment-form textarea,
        .comment-form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .comment-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .comments {
            margin-top: 30px;
        }

        .comment {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .comment .author {
            font-weight: bold;
            color: #333;
        }

        .comment .date {
            font-size: 12px;
            color: #777;
        }

        .stars {
            color: #FFD700;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- عرض عدد الإعجابات -->
    <div class="likes">
        <span>عدد الإعجابات: <?= $likes_count ?></span>
    </div>

    <!-- نموذج لإضافة تعليق -->
    <div class="comment-form">
        <h3>أضف تعليقك:</h3>
        <form action="" method="POST">
            <input type="text" name="name" placeholder=" ادخل اسمك..." required>
            <textarea name="comment" rows="4" placeholder="أدخل تعليقك هنا..." required></textarea>
            <label for="rating">التقييم:</label>
            <select name="rating" required>
                <option value="5">⭐⭐⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="2">⭐⭐</option>
                <option value="1">⭐</option>
            </select>
            <input type="submit" value="إرسال">
        </form>
    </div>

    <!-- عرض التعليقات السابقة (آخر 10 تعليقات فقط) -->
    <div class="comments">
        <h3>التعليقات:</h3>

        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <p class="author"><?= htmlspecialchars($comment['author']) ?>
                    <!-- عرض التقييم كنجوم -->
                    <span class="stars">
                        <?php for ($i = 0; $i < $comment['rating']; $i++): ?>
                            ⭐
                        <?php endfor; ?>
                    </span>
                </p>
                <p><?= htmlspecialchars($comment['comment']) ?></p>
                <p class="date"><?= htmlspecialchars($comment['date']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
