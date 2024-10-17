<?php 
session_start();

include '../../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'] ?? null; // كلمة السر القديمة
    $new_password = $_POST['new_password'] ?? null;         // كلمة السر الجديدة
    $confirm_password = $_POST['confirm_password'] ?? null; // تأكيد كلمة السر الجديدة
    $max_attempts = 3; // أقصى عدد من المحاولات المسموح بها قبل قفل الحساب

    // Assuming you have a logged-in user and their ID is stored in the session
    $admin_id = $_SESSION['id_admin'];

    // استرجاع معلومات المستخدم من قاعدة البيانات
    $stmt = $conn->prepare("SELECT password, failed_attempts, locked FROM admin WHERE id = :id_admin LIMIT 1");
    $stmt->bindParam(':id_admin', $admin_id);
    $stmt->execute();
    
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // تحقق مما إذا كان الحساب مقفلًا
        if ($admin['locked'] == 1) {
            $message_warning[] = "حسابك مقفل. الرجاء الاتصال بالإدارة.";
        } else {
            $hashed_current_password = $admin['password'];

            // تحقق من أن كلمة السر القديمة صحيحة
            if (password_verify($current_password, $hashed_current_password)) {
                // إذا كانت كلمة السر القديمة صحيحة، إعادة تعيين المحاولات الفاشلة
                $stmt = $conn->prepare("UPDATE admin SET failed_attempts = 0 WHERE id = :id_admin");
                $stmt->bindParam(':id_admin', $admin_id);
                $stmt->execute();

                // تحقق من أن كلمتي السر الجديدتين متطابقتان
                if (!empty($new_password) && $new_password === $confirm_password) {
                    $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);
                    
                    // تحديث كلمة السر في قاعدة البيانات
                    $update_stmt = $conn->prepare("UPDATE admin SET password = :new_password WHERE id = :id_admin");
                    $update_stmt->bindParam(':new_password', $hashed_new_password);
                    $update_stmt->bindParam(':id_admin', $admin_id);

                    if ($update_stmt->execute()) {
                        $message_success[] = "تم تحديث كلمة السر بنجاح!";
                    } else {
                        $message_warning[] = "حدث خطأ أثناء التحديث.";
                    }
                } else {
                    $message_warning[] = "كلمة السر الجديدة وتأكيدها غير متطابقتين.";
                }
            } else {
                // إذا كانت كلمة السر القديمة غير صحيحة، زيادة عدد المحاولات الفاشلة
                $failed_attempts = $admin['failed_attempts'] + 1;

                if ($failed_attempts >= $max_attempts) {
                    // قفل الحساب إذا تجاوز عدد المحاولات الفاشلة الحد المسموح به
                    $stmt = $conn->prepare("UPDATE admin SET failed_attempts = :failed_attempts, locked = 1 WHERE id = :id_admin");
                    $message_warning[] = "تم قفل حسابك بعد $max_attempts محاولات فاشلة.";
                } else {
                    // تحديث عدد المحاولات الفاشلة
                    $stmt = $conn->prepare("UPDATE admin SET failed_attempts = :failed_attempts WHERE id = :id_admin");
                    $message_warning[] = "كلمة السر القديمة غير صحيحة. لديك " . ($max_attempts - $failed_attempts) . " محاولات متبقية.";
                }

                $stmt->bindParam(':failed_attempts', $failed_attempts);
                $stmt->bindParam(':id_admin', $admin_id);
                $stmt->execute();
            }
        }
    } else {
        $message_warning[] = "المستخدم غير موجود.";
    }
}
?>



</html>
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

<h2>تعديل الحساب</h2>
<form action="" method="POST">

    <label for="password">كلمة السر القديمة:</label>
    <input type="password" id="password" name="pass" placeholder="ادخل كلمة السر القديمة">

    <label for="">كلمة السر الجديدة:</label>
    <input type="password" id="" name="cpass" placeholder="ادخال كلمة السر الجديدة">

    <label for="">تأكيد كلمة السر الجديدة:</label>
    <input type="password" id="" name="cؤpass" placeholder="تحقق من كلمة السر الجديدة">

    <input type="submit" value="حفظ التعديلات">
</form>

</body>
</html>
