<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // استلام البيانات من النموذج
    $firstname = htmlspecialchars($_POST['ferstname']); 
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // الاتصال بقاعدة البيانات
    $dsn = 'mysql:host=localhost;dbname=esd';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // إدخال البيانات في قاعدة البيانات
        $sql = "INSERT INTO actor_waitin (ferstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$firstname, $lastname, $email, $password]);
        $message_success[] = 'تم التسجيل بنجاح!';

        header('Location:login.php');
    } catch (PDOException $e) {
        echo "فشل الاتصال بقاعدة البيانات: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="styles.css">
<style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(90deg, rgba(238, 249, 255, 1) 0%, rgba(251, 251, 251, 1) 0%, rgba(215, 240, 246, 1) 37%, rgba(202, 243, 255, 1) 56%, rgba(93, 221, 247, 1) 100%);
}

.container {
    display: flex;
    max-width: 900px;
    width: 80%;
    background-color: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.welcome-section {
    width: 50%;
    padding: 40px;
    background: linear-gradient(90deg, rgba(238, 249, 255, 1) 0%, rgba(93, 221, 247, 1) 0%, rgba(202, 243, 255, 1) 37%, rgba(215, 240, 246, 1) 56%, rgba(251, 251, 251, 1) 100%);
    color: #fff;
    text-align: center;
}

.welcome-section h1 {
    font-size: 36px;
    margin-bottom: 10px;
}

.welcome-section p {
    font-size: 16px;
}

.login-section {
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

h2 {
    font-size: 28px;
    margin-bottom: 10px;
}

.highlight {
    color: #a145f7;
}

p {
    margin-bottom: 20px;
    color: #666;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
    color: #555;
}

.form-group input, 
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.form-group input:focus, 
.form-group select:focus {
    border-color: #28a745;
    box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
    outline: none;
}

.checkbox-group {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.checkbox-group a {
    color: #2575fc;
    text-decoration: none;
    font-size: 14px;
}

.submit-btn {
    background-color: #2575fc;
    color: white;
    padding: 12px 0;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    width: 100%;
    margin: 15px 0;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: #1a5dbd;
}

.create-account {
    color: #666;
    font-size: 14px;
    text-decoration: none;
    transition: 1s text-decoration, 0.5s color;
}

.create-account:hover {
    color: #2575fc;
    text-decoration: underline;
}

/* Responsive design adjustments */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        width: 90%;
    }

    .welcome-section {
        width: 100%;
        padding: 20px;
    }

    .login-section {
        width: 100%;
        padding: 20px;
    }

    .form-group input, 
    .form-group select {
        padding: 8px;
        font-size: 14px;
    }
}



    </style>
</head>
<body>
<div class="container">
        <div class="login-section">
            <h2>Hello! <span class="highlight">Good Morning</span></h2>
            <p>Login to your account</p>
            <p>If you would like to join the Al-Wefaq University Sports Club, fill in your information and visit the office for more information.</p>
            
            <form action="" method="POST"> <!-- Change action to point to this page -->
                <div class="form-group">
                    <label for="ferstname">Ferstname</label> <!-- Corrected label -->
                    <input type="text" id="ferstname" name="ferstname" placeholder="Enter Ferstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Enter Lastname" required>
                </div>
            
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="remember"> Remember</label>
                </div>
                <div style="text-align: center;">
                    <button type="submit" class="submit-btn">Submit</button>
                    <a href="login.php" class="create-account">I have an account</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>