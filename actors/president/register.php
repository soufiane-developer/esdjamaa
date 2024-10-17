<?php

include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['type']) && !empty($_POST['email']) && !empty($_POST['pass'])) {
        $username = htmlspecialchars($_POST['username']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $type = htmlspecialchars($_POST['type']);
        $email = htmlspecialchars($_POST['email']);
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        $select_admin = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        $select_admin->execute([$email]);
    
        if ($select_admin->rowCount() > 0) {
            $message_warning[] = 'Email already taken!';
        } else {
    
            if ($pass != $cpass) {
                $message_warning[] = 'Confirm password not matched!';
            } else {
    
                // $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
    
    
                $insert_admin = $conn->prepare("INSERT INTO admin (username, firstname, lastname, type, email, password) VALUES (?, ?, ?, ?, ?, ?)");
                $insert_admin->execute([$username, $firstname, $lastname, $type, $email, $hashed_pass]);
    
                header('Location: login.php');
                exit();
            }
            
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
    width: 350px;
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

.form-group input, 
.form-group select {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
}

.form-group input:focus, 
.form-group select:focus {
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
                <label for="">أدخل اسما تستخدمه لتسجيل الدخول مرة اخرى</label>
                <input type="text" id="" name="username" placeholder="أدخل اسم" required>
            </div>
            <div class="form-group">
                <label for="">الاسم الاول</label>
                <input type="text" id="" name="firstname" placeholder="أدخل اسم" required>
            </div>
            <div class="form-group">
                <label for="">الاسم العائلة</label>
                <input type="text" id="" name="lastname" placeholder="أدخل لقب" required>
            </div>
            <div class="form-group">
                <label for="">المنصب</label>
                <select name="type" id="">
                    <option value="admin">Admin</option>
                    <option value="merchant">Merchant</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">البريد الإلكتروني</label>
                <input type="email" id="" name="email" placeholder="أدخل بريدك الإلكتروني" required>
            </div>
            <div class="form-group">
                <label for="">كلمة المرور</label>
                <input type="password" id="" name="pass" placeholder="أدخل كلمة المرور" required>
            </div>
            <div class="form-group">
                <label for="">تأكد من كلمة المرور </label>
                <input type="password" id="" name="cpass" placeholder="تأكد من كلمة المرور" required>
            </div>
            <div class="form_btn">
                <input type="submit" value="تسجيل الدخول" name="submit">
            </div>
        </form>
    </div>
</body>

</html>
