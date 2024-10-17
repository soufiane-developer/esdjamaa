<?php

session_start();

include 'connect.php';

if (isset($_POST['submit'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    if (empty($email) || empty($password)) {
        $message_warning[] = 'An error occurred. You cannot complete the procedure because the information you entered is incomplete.';
    } else {

        $select_actor = $conn->prepare("SELECT * FROM actors WHERE email = ? LIMIT 1");
        $select_actor->execute([$email]);

        if ($select_actor->rowCount() > 0) {
            $actor = $select_actor->fetch(PDO::FETCH_ASSOC);
            $hashed_pass = $actor['password'];

            if (password_verify($password, $hashed_pass)) {
                setcookie('actor_id', $actor['id'], time() + 60 * 60 * 24 * 30, '/', '', true, true);
                $_SESSION['actor_id'] = $actor['id'];
                $_SESSION['actor_role'] = $actor['roles'];


                if ($actor['roles'] == 'user') {

                    // $_SESSION['actor_id'] = $actor['id'];

                    header('Location: home.php');
                } elseif ($actor['roles'] == $actor['roles']) {
                    header('Location: actors/'.$actor['roles'].'/dashboard.php?rol ='.$actor['roles'].'');
                } else {
                    header('Location: 404.php');
                }
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
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="styles.css">
    <style>
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
    width: 100%;
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
    width: 50%;
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

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 5px;
}

.input-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
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
    margin: 0 121px;
    color: #666;
    font-size: 14px;
    text-decoration: none;
    transition: 1s text-decoration, 0.5s color;
}

.create-account:hover {
    color: #2575fc;
    text-decoration: underline;
}
.gradient-text {
    background: linear-gradient(90deg, rgb(175 207 224) 0%, rgb(255 71 71) 0%, rgb(162 212 224) 37%, rgb(0 147 190) 56%, rgba(93, 221, 247, 1) 100%);    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 48px; /* حجم النص */
    font-weight: bold; /* وزن الخط */
    text-align: center; /* محاذاة النص في المنتصف */
}


    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-section">
            <h1 class="gradient-text">Welcome Page</h1>
            <p>Sign In To Your Account</p>
            <img src="img/esd.png" alt="" style="    width: 63%;
    margin-top: 20px;">
        </div>
        <div class="login-section">
            <h2>You! <span class="highlight">Forgot Password</span></h2>
            <p>Enter New Password</p>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="oldpassword">Old Password</label>
                    <input type="password" id="oldpassword" name="oldpassword" placeholder="Enter old password" required>
                </div>
                <div class="input-group">
                    <label for="cnfpassword">Confirm Password</label>
                    <input type="password" id="cnfpassword" name="cnfpassword" placeholder="Confirm Password" required>
                </div>
                <div class="input-group">
                    <label for="newpassword">New Password</label>
                    <input type="password" id="newpassword" name="newpassword" placeholder="New Password" required>
                </div>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="remember"> Remember</label>
                </div>
                <button type="submit" class="submit-btn" name="submit">Submit</button>
                <a href="register.php" class="create-account">Create Account</a>
            </form>
        </div>
    </div>
</body>
<script>
    setTimeout(function() {
    alert("لقد كنت هنا لمدة ساعة! هل ترغب في الاستمرار؟");
}, 3600000);

</script>
</html>
