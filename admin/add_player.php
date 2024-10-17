<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // استلام البيانات من النموذج
    $farstname = htmlspecialchars($_POST['farstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $position = htmlspecialchars($_POST['position']);
    $category = htmlspecialchars($_POST['category']);
    $coach = htmlspecialchars($_POST['coach']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    // الاتصال بقاعدة البيانات
    $dsn = 'mysql:host=localhost;dbname=esd';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // إدخال البيانات في قاعدة البيانات
        $sql = "INSERT INTO players (farstname, lastname, place, category, coach, email, phone) VALUES (?,?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$farstname, $lastname, $position, $category, $coach, $email, $phone]);
        $message_success[] = 'تم التسجيل بنجاح!';

        header('Location:add_player.php');
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
    <title>تسجيل نادي كرة اليد</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            animation: backgroundAnimation 10s infinite;
        }

        @keyframes backgroundAnimation {
            0% { background-color: #f4f4f4; }
            50% { background-color: #e9ecef; }
            100% { background-color: #f4f4f4; }
        }

        .registration-form {
            background-color: #fff;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            transform: scale(0);
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

        .form-button{
            display: flex;
            margin-bottom: 15px;
            opacity: 0;
            animation: fadeI 8s forwards;
        }
        @keyframes fadeI {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .form-button a{
            text-align: center;
            text-decoration: none;
            width: 40%;
        }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.4s; }
        .form-group:nth-child(4) { animation-delay: 0.6s; }
        .form-group:nth-child(5) { animation-delay: 0.8s; }
        .form-group:nth-child(6) { animation-delay: 1.0s; }
        .form-group:nth-child(7) { animation-delay: 1.2s; }



        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        .form-group input, .form-group select, .form-button input, .form-button a{
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        select .place{
            width: 105%;
        }

        .form-group input:focus, .form-group select:focus, .form-button input:focus, .form-button a:focus{
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
            outline: none;
        }

        .form-button input[type="submit"] {
            margin: 2px;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s, transform 0.2s;
            animation: bounceIn 3s forwards;
        }

        .form-button input[type="submit"]:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .form-button input[type="submit"]:active {
            background-color: #1e7e34;
            transform: translateY(2px);
        }

        .form-button a{
            margin: 2px;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s, transform 0.2s;
            animation: bounceIn 3s forwards;
        }
       

        @keyframes bounceIn {
            0% { transform: scale(0.9); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        } 
        .form-button a:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .form-button a:active {
            background-color: #1e7e34;
            transform: translateY(2px);
        }
    </style>
</head>
<body>
<?php include '../message_net.php'; ?>

    <div class="registration-form">
        <h2>Add Player..</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="farstname">LastName</label>
                <input type="text" id="farstname" name="farstname" placeholder="أدخل اسم الاعب" required>
            </div>
            <div class="form-group">
                <label for="lastname">FarstName</label>
                <input type="text" id="lastname" name="lastname" placeholder="أدخل لقب الاعب" required>
            </div>

            <div class="form-group">
            <label for="position">Post</label>
            <select name="position" id="position" style="width: 105.5%;">
                <option value="goalkeeper">Goalkeeper</option>
                <option value="pivot">Pivot</option>
                <option value="center">Center</option>
                <option value="left">Left</option>
                <option value="right">Right</option>
                </select>
            </div>

            <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" style="width: 105.5%;">
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
               <select name="coach" id="coach" style="width: 105.5%;">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="أدخل بريد الالكتروني اللاعب">
            </div>

            <div class="form-group">
                <label for="phone">phone</label>
                <input type="tel" id="phone" name="phone" placeholder="أدخل رقم هاتف للاعب" required>
            </div>

            <div class="form-button">
                <input type="submit" value="Send">
                <a href="members.php">Back</a>
            </div>

        </form>
    </div>
</body>
</html>
