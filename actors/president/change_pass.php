<?php 
session_start();

include '../../connect.php';

$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = htmlspecialchars($_POST['current_password'] ?? null);
    $new_password = htmlspecialchars($_POST['new_password'] ?? null);
    $confirm_password = htmlspecialchars($_POST['confirm_password'] ?? null);
    $max_attempts = 3;

    $admin_id = $_SESSION['actor_id'];

    $stmt = $conn->prepare("SELECT password, failed_attempts, locked FROM actors WHERE id = :actor_id LIMIT 1");
    $stmt->bindParam(':actor_id', $admin_id);
    $stmt->execute();
    
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        if ($admin['locked'] == 1) {
            $message = "حسابك مقفل. الرجاء الاتصال بالإدارة.";
        } else {
            $hashed_current_password = $admin['password'];

            if (password_verify($current_password, $hashed_current_password)) {
                $stmt = $conn->prepare("UPDATE actors SET failed_attempts = 0 WHERE id = :actor_id");
                $stmt->bindParam(':actor_id', $admin_id);
                $stmt->execute();

                if (!empty($new_password) && $new_password === $confirm_password) {
                    $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);
                    $update_stmt = $conn->prepare("UPDATE actors SET password = :new_password WHERE id = :actor_id");
                    $update_stmt->bindParam(':new_password', $hashed_new_password);
                    $update_stmt->bindParam(':actor_id', $admin_id);

                    if ($update_stmt->execute()) {
                        // Optionally redirect after success
                        header("Location: success_page.php");
                        exit();
                    } else {
                        $message = "حدث خطأ أثناء التحديث.";
                    }
                } else {
                    $message = "كلمة السر الجديدة وتأكيدها غير متطابقتين.";
                }
            } else {
                $failed_attempts = $admin['failed_attempts'] + 1;

                if ($failed_attempts >= $max_attempts) {
                    $stmt = $conn->prepare("UPDATE actors SET failed_attempts = :failed_attempts, locked = 1 WHERE id = :actor_id");
                    $stmt->bindParam(':failed_attempts', $failed_attempts);
                    $stmt->bindParam(':actor_id', $admin_id);
                    $stmt->execute();
                    $message = "تم قفل حسابك بعد $max_attempts محاولات فاشلة.";
                } else {
                    $stmt = $conn->prepare("UPDATE actors SET failed_attempts = :failed_attempts WHERE id = :actor_id");
                    $stmt->bindParam(':failed_attempts', $failed_attempts);
                    $stmt->bindParam(':actor_id', $admin_id);
                    $stmt->execute();
                    $message = "كلمة السر القديمة غير صحيحة. لديك " . ($max_attempts - $failed_attempts) . " محاولات متبقية.";
                }
            }
        }
    } else {
        $message = "المستخدم غير موجود.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الحساب</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            text-align: right;
            margin: 16% auto;
            max-width: 600px;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include '../asider.php'; ?>
<?php include '../../message_net.php'; ?>

<h2>Update Password</h2>

<!-- Display messages -->
<?php if (!empty($message)): ?>
    <div class="message"><?php echo $message; ?></div>
<?php endif; ?>

<form action="" method="POST">
    <label for="current_password">كلمة السر القديمة:</label>
    <input type="password" id="current_password" name="current_password" placeholder="ادخل كلمة السر القديمة">

    <label for="new_password">كلمة السر الجديدة:</label>
    <input type="password" id="new_password" name="new_password" placeholder="ادخال كلمة السر الجديدة">

    <label for="confirm_password">تأكيد كلمة السر الجديدة:</label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="تحقق من كلمة السر الجديدة">

    <input type="submit" value="حفظ التعديلات">
</form>

</body>
</html>
