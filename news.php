<?php
include 'connect.php'; 

$dsn = 'mysql:host=localhost;dbname=esd';
$username = 'root';
$password = '';
$options = [];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'الاتصال فشل: ' . $e->getMessage();
}

// جلب الأخبار من قاعدة البيانات
$sql = "SELECT title, content, date, image FROM news ORDER BY date DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أخبار النادي</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            direction: rtl;
            text-align: right;
        }

        header {
            background-color: #0066cc;
            color: white;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        .news {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .news-item {
            display: flex;
            flex-direction: column;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            padding: 10px;
        }

        .news-item:hover {
            transform: translateY(-5px);
        }

        .news-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-item-content {
            padding: 10px;
            flex: 1;
        }

        .news-item h2 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #333;
        }

        .news-item p {
            margin: 10px 0;
            color: #555;
            line-height: 1.6;
        }

        .news-item small {
            color: #888;
        }
    </style>
</head>
<body>
    <header>
        <h1>أخبار النادي</h1>
    </header>

    <section class="news">
    <?php foreach ($news as $item): ?>
    <div class="news-item">
        <img src="img/news/<?= htmlspecialchars($item['image']) ?>" alt="صورة الخبر">
        <div class="news-item-content">
            <h2><?= htmlspecialchars($item['title']) ?></h2>
            <p><?= htmlspecialchars($item['content']) ?></p>
            <p><small>تاريخ النشر: <?= htmlspecialchars($item['date']) ?></small></p>
        </div>
    </div>
    <?php endforeach; ?>
    </section>
</body>
</html>
