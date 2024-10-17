<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // $admin_id = $_SESSION['id_admin'];

    // Initialize an array to hold the SQL updates
    $updates = [];
    $params = [':id_admin' => $admin_id];

    // Add fields to update only if they are not empty
    if (!empty($username)) {
        $updates[] = 'username = :username';
        $params[':username'] = $username;
    }
    if (!empty($first_name)) {
        $updates[] = 'firstname = :first_name';
        $params[':first_name'] = $first_name;
    }
    if (!empty($last_name)) {
        $updates[] = 'lastname = :last_name';
        $params[':last_name'] = $last_name;
    }

    // Proceed only if there are updates to apply
    if (count($updates) > 0) {
        $sql = "UPDATE admin SET " . implode(', ', $updates) . " WHERE id = :id_admin";

        $stmt = $conn->prepare($sql);

        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value);
        }

        if ($stmt->execute()) {
            $message_success[] = "تم تحديث الحساب بنجاح!";
        } else {
            $message_warning[] = "حدث خطأ أثناء التحديث.";
        }
    } else {
        $message_warning[] = "لا توجد تغييرات لتحديثها.";
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
        input[type="submit"]{
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover{
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include '../asider.php'; ?>
<?php include '../../message_net.php'; ?>

<h2>Update Account</h2>
<form action="" method="POST">

    <label for="first_name">اللقب:</label>
    <input type="text" id="first_name" name="first_name" placeholder="ادخل لقبك">

    <label for="last_name">الاسم:</label>
    <input type="text" id="last_name" name="last_name" placeholder="ادخل اسمك">

    <label for="username">اسم المستخدم:</label>
    <input type="text" id="username" name="username" placeholder="ادخل اسم المستخدم">

    <input type="submit" value="حفظ التعديلات">
    <a href="change_pass.php">تغيير كلمة السر</a>
</form>

</body>
</html>
