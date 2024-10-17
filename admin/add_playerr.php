<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // استلام البيانات من النموذج
    $farstname = htmlspecialchars($_POST['farstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $position = htmlspecialchars($_POST['position']);
    $category = htmlspecialchars($_POST['category']);
    $coach = htmlspecialchars($_POST['coach']);
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
        $sql = "INSERT INTO players (farstname, lastname, place, category, coach, email, password) VALUES (?,?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$farstname, $lastname, $position, $category, $coach, $email, $password]);
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
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    animation: backgroundAnimation 10s infinite;
}

@keyframes backgroundAnimation {
    0% { background-color: #f4f4f4; }
    50% { background-color: #e9ecef; }
    100% { background-color: #f4f4f4; }
}

.scrollable-content {
    height: auto; /* Set to auto for dynamic content */
    background-color: #fff;
    font-size: 24px;
    text-align: center;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: #333;
    margin: 2% 23%;
    width: 50%;
    border-radius: .5rem;
}

.scrollable-content img {
    max-width: 25%; /* Ensure image scales responsively */
    height: auto; /* Maintain aspect ratio */
}

.registration-form {
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    width: 100%;
    animation: popUp 0.5s ease-in-out forwards;
}

@keyframes popUp {
    0% { transform: scale(0); }
    100% { transform: scale(1); }
}

.registration-form h2 {
    margin-bottom: 20px;
    font-size: 24px;
    text-align: center;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
    opacity: 0;
    animation: fadeIn 1s forwards;
}

@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
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

.form-button {
    display: flex;
    justify-content: center;
    margin-top: 15px;
}

.form-button input[type="submit"] {
    background-color: #28a745;
    color: #fff;
    cursor: pointer;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.2s;
}

.form-button input[type="submit"]:hover {
    background-color: #218838;
    transform: translateY(-2px);
}

.form-button input[type="submit"]:active {
    background-color: #1e7e34;
    transform: translateY(2px);
}

/* Responsive design adjustments */
@media (max-width: 768px) {
    .registration-form {
        padding: 20px;
    }
    .registration-form input, 
    .registration-form select {
        padding: 8px;
        font-size: 14px;
    }
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
        <div class="login-section">
        <h2>Hello! <span class="highlight">Good Morning</span></h2>
        <p>Login to your account</p>
        <p>If you would like to join the Al-Wefaq University Sports Club, this is a good thing. Fill in your information and visit the office for more information.</p>        <form action="/login" method="POST">
            <div class="form-group">
                <label for="position">Position</label>
                <select name="position" id="position">
                    <option value="goalkeeper">Goalkeeper</option>
                    <option value="pivot">Pivot</option>
                    <option value="center">Center</option>
                    <option value="left">Left</option>
                    <option value="right">Right</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category">
                    <option value="u23">U23</option>
                    <option value="u21">U21</option>
                    <option value="u19">U19</option>
                    <option value="u17">U17</option>
                    <option value="u15">U15</option>
                    <option value="u13">U13</option>
                </select>
            </div>
            <div class="form-group">
    <label for="coach">Coach</label>
    <select name="coach" id="coach" required>
        <option value="">--Select Coach--</option>
        <?php
        include 'connect.php';
        $rows = $conn->prepare("SELECT * FROM actors WHERE roles = 'coach'");
        $rows->execute();
        if ($rows->rowCount() > 0) {
            while ($fetch_roles = $rows->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option value="<?= htmlspecialchars($fetch_roles['id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($fetch_roles['firstname'], ENT_QUOTES, 'UTF-8'); ?> <?= htmlspecialchars($fetch_roles['lastname'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
                <?php
            }
        }
        ?>
    </select>
</div>

        </div>
        <div class="login-section">         
            <div class="form-group">
                <label for="farstname">Farstname</label>
                <input type="text" id="farstname" name="farstname" placeholder="Enter Farstname" required>
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
                <button type="submit" class="submit-btn">Submit</button>
                <a href="login.php" class="create-account">I have account</a>
            </form>
        </div>
    </div>
</body>
</html>
