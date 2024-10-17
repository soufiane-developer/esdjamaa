<?php

session_start();

include '../connect.php';

if (isset($_POST['submit'])) {


    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);


    if (empty($email) || empty($password)) {
        $message_warning[] = 'An error occurred. You cannot complete the procedure because the information you entered is incomplete.';
    } else {


        $select_admin = $conn->prepare("SELECT * FROM admin WHERE email = ? LIMIT 1");
        $select_admin->execute([$email]);


        if ($select_admin->rowCount() > 0) {
            $admin = $select_admin->fetch(PDO::FETCH_ASSOC);
            $hashed_pass = $admin['password'];


            if (password_verify($password, $hashed_pass)) {
                setcookie('admin_id', $admin['id'], time() + 60 * 60 * 24 * 30, '/', '', true, true);

                $_SESSION['admin_id'] = $admin['id'];

                header('Location: dashboard.php');
                    exit();

            } else {
                $message_error[] = 'Incorrect password!';
            }
        } else {
            $message_error[] = 'Email not found!';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .registration-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .registration-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .form_btn {
            text-align: center;
            margin-top: 20px;
        }

        .form_btn input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form_btn input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 400px) {
            .registration-form {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <?php include '../message_net.php'; ?>

    <div class="registration-form">
        <h2>تسجيل الدخول</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" placeholder="أدخل بريدك الإلكتروني" required>
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" name="pass" placeholder="أدخل كلمة المرور" required>
            </div>
            <div class="form_btn">
                <input type="submit" value="تسجيل الدخول" name="submit">
            </div>
        </form>
    </div>
</body>
<script>
    setTimeout(function() {
    alert("لقد كنت هنا لمدة ساعة! هل ترغب في الاستمرار؟");
}, 3600000);

</script>
</html>