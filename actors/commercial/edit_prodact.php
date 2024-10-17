<?php
include '../../connect.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM product WHERE id_product = :id");
$stmt->execute([':id' => $id]);
$news = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name_product = $_POST['name_product'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $qty = $_POST['quantity'];


    $stmt = $conn->prepare("UPDATE product SET name_product = :name_product, description = :description, quantity = :qty, date = :date WHERE id = :id");
    $stmt->execute([
        ':name_product' => $name_product,
        ':description' => $description,
        ':qty' => $qty,
        ':date' => $date,
        ':id' => $id
    ]);

    header('Location: add_prodact.php');
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
input[type="number"],
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
</head>
<body>
<div class="news-form-container">
        <h2>تعديل معلومات المنتج</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="name_product">اسم المنتج:</label>
                <input type="text" id="name_product" name="name_product" value="<?= htmlspecialchars($news['name_product']) ?>" required>
            </div>

            <div class="form-group">
                <label for="qty">الكمية:</label>
                <input type="number" id="qty" name="qty" value="<?= htmlspecialchars($news['quantity']) ?>" required>
            </div>

            <div class="form-group">
                <label for="date">التاريخ:</label>
                <input type="date" id="date" name="date" value="<?= htmlspecialchars($news['date']) ?>" required>
            </div>

            <div class="form-group">
                <label for="description">الوصف:</label>
                <textarea id="description" name="description" rows="5" required><?= htmlspecialchars($news['description']) ?></textarea>
            </div>

            <button type="submit">تحديث</button>
        </form>
    </div>
</body>
</html>
