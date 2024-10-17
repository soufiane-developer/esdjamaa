<?php
include '../connect.php';

try {
    // تأكد من وجود معرف لاعب في الطلب
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("معرف اللاعب غير موجود.");
    }

    $playerId = $_GET['id'];

    // جلب تفاصيل اللاعب من قاعدة البيانات
    $stmt = $conn->prepare("SELECT player_id, ferstname, lastname, email, phone, place FROM players WHERE player_id = :id");
    $stmt->bindParam(':id', $playerId, PDO::PARAM_INT);
    $stmt->execute();
    $player = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$player) {
        throw new Exception("لا يوجد لاعب بهذا المعرف.");
    }
} catch (Exception $e) {
    echo "فشل في جلب البيانات: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل اللاعب</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .player-card {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .player-card h2 {
            margin-bottom: 20px;
            font-size: 28px;
        }
        .player-card p {
            font-size: 18px;
            margin: 10px 0;
        }
        .player-card a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            margin: 10px;
        }
        .back-btn {
            background-color: #007bff;
        }
        .back-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="player-card">
        <h2>تفاصيل اللاعب</h2>
        <p><strong>رقم العضو:</strong> <?php echo htmlspecialchars($player['player_id']); ?></p>
        <p><strong>الاسم:</strong> <?php echo htmlspecialchars($player['ferstname']); ?> <?php echo htmlspecialchars($player['lastname']); ?></p>
        <p><strong>البريد الإلكتروني:</strong> <?php echo htmlspecialchars(string: $player['email']); ?></p>
        <p><strong>رقم الهاتف:</strong> <?php echo htmlspecialchars(string: $player['phone']); ?></p>
        <p><strong>المركز المفضل:</strong> <?php echo htmlspecialchars($player['place']); ?></p>
        <a href="members.php" class="back-btn">العودة إلى قائمة الأعضاء</a>
    </div>
</body>
</html>
