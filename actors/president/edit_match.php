<?php
include '../../connect.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM matches WHERE id = :id");
$stmt->execute([':id' => $id]);
$news = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $link = $_POST['link'];
    $match_rank = $_POST['match_rank'];
    $opponent_team = $_POST['opponent_team'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $refere = $_POST['refere'];
    $referee = $_POST['referee'];


    $stmt = $conn->prepare("UPDATE matches SET link = :link, match_rank = :match_rank, opponent_team = :opponent_team, date = :date, time = :time, location = :location, refere = :refere, referee = :referee WHERE id = :id");
    $stmt->execute([
        ':link' => $link,
        ':match_rank' => $match_rank,
        ':opponent_team' => $opponent_team,
        ':date' => $date,
        ':time' => $time,
        ':location' => $location,
        ':refere' => $refere,
        ':referee' => $referee,
        ':id' => $id,
    ]);

    header('Location: add_match.php');
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
input[type="time"],
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
    <title>تعديل المبارات</title>
</head>
<body>
<div class="news-form-container">
        <h2>تعديل مبارات</h2>
        <form action="" method="post">

        <div class="form-group">
                <label for="link">رابط المبارات:</label>
                <input type="text" id="link" name="link" value="<?= htmlspecialchars($news['link']) ?>" required>
            </div>
            <div class="form-group">
                <label for="match_rank">رتبة المبارات:</label>
                <input type="text" id="match_rank" name="match_rank" value="<?= htmlspecialchars($news['match_rank']) ?>" required>
            </div>

            <div class="form-group">
                <label for="opponent_team">اسم الفريق الخصم:</label>
                <input type="text" id="opponent_team" name="opponent_team" value="<?= htmlspecialchars($news['opponent_team']) ?>" required>
            </div>
            <div class="form-group">
                <label for="my_team">اسم الفريقي:</label>
                <input type="text" id="my_team" name="my_team" value="<?= htmlspecialchars($news['my_team']) ?>" required>
            </div>

            <div class="form-group">
                <label for="date">التاريخ:</label>
                <input type="date" id="date" name="date" value="<?= htmlspecialchars($news['date']) ?>" required>
            </div>

            <div class="form-group">
                <label for="time">الوقت:</label>
                <input type="time" id="time" name="time" value="<?= htmlspecialchars($news['time']) ?>" required>
            </div>
            <div class="form-group">
                <label for="location">مكان المقابلة:</label>
                <input type="text" id="location" name="location" value="<?= htmlspecialchars($news['location']) ?>" required>
            </div>
            <div class="form-group">
                <label for="refere">الحكم الأول: </label>
                <input type="text" id="refere" name="refere" value="<?= htmlspecialchars($news['refere']) ?>" required>
            </div>

            <div class="form-group">
                <label for="referee">الحكم الثاني: </label>
                <input type="text" id="referee" name="referee" value="<?= htmlspecialchars($news['referee']) ?>" required>
            </div>

            <button type="submit">تحديث</button>
        </form>
    </div>
</body>
</html>
