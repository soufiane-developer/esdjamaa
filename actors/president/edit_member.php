<?php
session_start();
include '../../connect.php';
include '../../user_id.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM actors WHERE id = :id");
$stmt->execute([':id' => $id]);
$actor = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roles = $_POST['roles'];
    
    // Assuming you want to update more fields, uncomment the following lines and add them to the SQL statement
    // $match_rank = $_POST['match_rank'];
    // $opponent_team = $_POST['opponent_team'];
    // $date = $_POST['date'];
    // $time = $_POST['time'];
    // $location = $_POST['location'];
    // $referee = $_POST['referee'];

    $stmt = $conn->prepare("UPDATE actors SET roles = :roles WHERE id = :id");
    $stmt->execute([
        ':roles' => $roles,
        ':id' => $id,
    ]);

    header('Location: edit_member.php?id=' . $id); // Redirect to the same edit page for the actor
    exit; // Important to prevent further execution
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            direction: rtl;
            text-align: right;
            margin: 0;
            padding: 0;
        }
        .news-form-container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
    <title>تعديل الحسابات</title>
</head>
<body>
<div class="news-form-container">
    <h2>تعديل الحساب</h2>
    <form action="" method="post">
        <?php
        $stmt = $conn->query("SELECT id, roles FROM actors WHERE email != 'sofiane@gmail.com'");
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="form-group">
            <label for="roles">Roles:</label>
            <select name="roles" id="roles" required>
                <option value="" disabled>Select a role</option>
                <?php 
                foreach ($roles as $role) {
                    $selected = ($role['roles'] == $actor['roles']) ? 'selected' : '';
                    echo "<option value='". htmlspecialchars($role['roles'])."' $selected>" . htmlspecialchars($role['roles']). "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit">تحديث</button>
    </form>
</div>
</body>
</html>
