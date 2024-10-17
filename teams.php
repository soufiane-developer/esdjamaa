<?php
include 'connect.php';

// استرجاع جميع اللاعبين من قاعدة البيانات
$stmt = $conn->query("SELECT * FROM players ORDER BY category");
$playersList = $stmt->fetchAll();

// تجميع اللاعبين حسب الفئات
$playersByCategory = [];
foreach ($playersList as $player) {
    $playersByCategory[$player['category']][] = $player;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض اللاعبين</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* أضف هنا تنسيقات CSS الموجودة سابقًا */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            direction: rtl;
            text-align: right;
        }

        .category-container {
            margin: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .category-title {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .players-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .player-card {
            position: relative;
            margin: 10px;
            width: 150px;
            height: 200px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .player-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .player-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .player-card:hover {
            transform: scale(1.05);
        }

        .player-card:hover .player-name {
            opacity: 1;
        }
    </style>
</head>
<body>

<?php foreach ($playersByCategory as $category => $players) : ?>
    <div class="category-container">
        <div class="category-title"><?= htmlspecialchars($category) ?></div>
        <div class="players-container">
            <?php foreach ($players as $player) : ?>
                <div class="player-card">
                    <img src="img/players/<?= htmlspecialchars($player['img']) ?>" alt="<?= htmlspecialchars($player['farstname']) ?>">
                    <div class="player-name">
                        <?= htmlspecialchars($player['farstname']) ?> <?= htmlspecialchars($player['lastname']) ?>
                        <br>
                        <?= htmlspecialchars($player['club']) ?>
                        <br>
                        <?= htmlspecialchars($player['place']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

</body>
</html>
