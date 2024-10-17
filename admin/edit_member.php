<?php
// الاتصال بقاعدة البيانات
$dsn = 'mysql:host=localhost;dbname=esd';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // التحقق من وجود ID في الرابط
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        // جلب بيانات العضو بناءً على ID
        $stmt = $pdo->prepare("SELECT * FROM players WHERE id = ?");
        $stmt->execute([$id]);
        $player = $stmt->fetch(PDO::FETCH_ASSOC);

        // التحقق من وجود العضو
        if (!$player) {
            die('العضو غير موجود.');
        }
    } else {
        die('ID غير موجود.');
    }
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}

// معالجة البيانات عند تقديم النموذج
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $farstname = htmlspecialchars($_POST['farstname']);
    $lastname = htmlspecialchars($_POST['lastname']);

    $email = htmlspecialchars($_POST['email']);
    $position = htmlspecialchars($_POST['position']);

    try {
        // تحديث بيانات العضو
        $sql = "UPDATE players SET farstname = ?, lastname = ?, email = ?, place = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$farstname, $lastname, $email, $position, $id]);

        echo "تم تحديث العضو بنجاح!";
    } catch (PDOException $e) {
        echo "فشل التحديث: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل العضو</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .edit-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .edit-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border: none;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .form-group input[type="submit"]:active {
            background-color: #00408a;
        }
    </style>
</head>
<body>
    <div class="edit-form">
        <h2>تعديل بيانات العضو</h2>
        <form action="edit_member.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label for="farstname">الاسم الكامل</label>
                <input type="text" id="farstname" name="farstname" value="<?php echo htmlspecialchars($player['farstname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="lastname">الاسم الكامل</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($player['lastname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($player['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="position">المركز المفضل</label>
                <input type="text" id="position" name="position" value="<?php echo htmlspecialchars($player['place']); ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="تحديث">
            </div>
        </form>
    </div>
</body>
</html>
