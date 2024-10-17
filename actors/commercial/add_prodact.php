<?php
include '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name_product = $_POST['name_product'];
    $type = $_POST['type'];
    $prix = $_POST['prix'];
    $quantity = $_POST['quantity'];

    // معالجة الصورة
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;
        $uploadFileDir = '../../img/products/';
        $dest_path = $uploadFileDir . $newImageName;

        // رفع الصورة إلى المجلد
        if (move_uploaded_file($imageTmpPath, $dest_path)) {
            // إدخال البيانات في قاعدة البيانات
            $stmt = $conn->prepare("INSERT INTO product (name_product, type, prix, quantity, image) VALUES (:name_product, :type, :prix, :quantity, :image)");
            $stmt->execute([
                ':name_product' => $name_product,
                ':type' => $type,
                ':quantity' => $quantity,
                ':prix' => $prix,
                ':image' => $newImageName,
            ]);

            $message_success[] = "تم إضافة منتج بنجاح!";
        } else {
            $message_error[] = "حدث خطأ أثناء رفع الصورة.";
        }
    } else {
        $message_warning[] = "الرجاء اختيار صورة.";
    }
}


$stmt = $conn->query("SELECT * FROM product ORDER BY date DESC");
$productList = $stmt->fetchAll();

// افتراضياً، سنرتب حسب التاريخ
$orderBy = 'date DESC';
$searchQuery = '';

if (isset($_GET['sort'])) {
    if ($_GET['sort'] === 'name_product') {
        $orderBy = 'name_product ASC';
    } elseif ($_GET['sort'] === 'date') {
        $orderBy = 'date DESC';
    }
}

// معالجة البحث
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $searchQuery = " WHERE name_product LIKE :search ";
}

// عرض الأخبار من قاعدة البيانات مع ترتيب حسب المتغير
$stmt = $conn->prepare("SELECT * FROM product $searchQuery ORDER BY $orderBy");
if ($searchQuery) {
    $stmt->execute([':search' => "%$searchTerm%"]);
} else {
    $stmt->execute();
}
$newsList = $stmt->fetchAll();

?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة خبر</title>
    <link rel="stylesheet" href="style.css">
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
input[type="file"],
input[type="number"],
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



/* تنسيق الجدول */
.news-form-container {
    width: 50%;
    margin: 50px auto 20px; /* تقليل المسافة السفلية بين النموذج وجدول الأخبار */
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}


.news-list-container {
    width: 90%;
    margin: 20px auto 50px; /* توحيد المسافات العلوية والسفلية */
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

thead {
    background-color: #f8f8f8;
}

th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #28a745;
    color: white;
}

td img {
    width: 80px;
    height: auto;
    border-radius: 5px;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}

.actions a {
    display: inline-block;
    margin: 0 5px;
    padding: 5px 10px;
    border-radius: 5px;
}

.actions a.edit {
    background-color: #ffc107;
    color: white;
}

.actions a.delete {
    background-color: #dc3545;
    color: white;
}

.actions a.edit:hover {
    background-color: #e0a800;
}

.actions a.delete:hover {
    background-color: #c82333;
}

.sort-buttons {
    text-align: center;
    margin-bottom: 20px;
}

.sort-button {
    display: inline-block;
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin: 0 5px;
}

.sort-button:hover {
    background-color: #0056b3;
}






.search-form {
    text-align: center;
    margin-bottom: 20px;
}

.search-form input[type="text"] {
    padding: 10px;
    width: 300px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.search-form button{
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.search-form button:hover {
    background-color: #0056b3;
}

.btn_add{
display: flex;
justify-content: space-around;
text-align: center;

}
.btn_add button, .btn_add a{
    width: 30%;
    padding: 10px;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
.btn_add button{
    background-color: #28a745;
}
.btn_add a{
    text-decoration: none;
    background-color: #ff0c0c;
}
.btn_add button:hover, .btn_add a:hover{
    opacity: .7;
}
.btn_opt{
}
.btn_opt .delete, .btn_opt .edit{
    width: 30%;
    padding: 10px;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
}
.btn_opt .edit{
    background-color: #28a745;
}
.btn_opt .delete{
    background-color: #ff0c0c;
    
}
.btn_opt .delete:hover, .btn_opt .edit:hover{
    opacity: .7;
}
    </style>
</head>
<body>
<?php include '../../message_net.php'; ?>

            <div class="news-form-container">
        <h2>Add New Prodact</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name_product">Name Prodact:</label>
                <input type="text" id="name_product" name="name_product" required>
            </div>

            <div class="form-group">
                <label for="content">Type:</label>
                <select name="type" id="">
                    <option value="ball">Ball</option>
                    <option value="shoes">Shoes</option>
                    <option value="shirt">Shirt</option>
                    <option value="pants">Pants</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="prix">Prix:</label>
                <input type="number" id="prix" name="prix" rows="5" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" rows="5" required>
            </div>

            <div class="form-group">
                <label for="content">Bio:</label>
                <textarea id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="btn_add">
            <button type="submit">Add</button>
            <a href="dashboard.php">Back</a>
            </div>
        </form>
    </div>

    <!-- جدول عرض الأخبار -->
    <div class="news-list-container">
    <h2>List Prodact</h2>

    <div class="sort-buttons">
        <a href="?sort=name_product" class="sort-button">فرز حسب العنوان</a>
        <a href="?sort=date" class="sort-button">فرز حسب التاريخ</a>
    </div>

    <form class="search-form">
    <input type="text" id="search-input" placeholder="ابحث عن منتوج..." required>
</form>
 

    <table>
        <thead>
            <tr>
                <th>Name Prodact</th>
                <th>Prix</th>
                <th>Image</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody id="news-table-body">
    <?php foreach ($productList as $news) : ?>
        <tr>
            <td><?= htmlspecialchars($news['name_product']) ?></td>
            <td><?= htmlspecialchars($news['prix']) ?> DA</td>
            <td><img src="../../img/products/<?= htmlspecialchars($news['image']) ?>" alt="news image" width="100"></td>
            <td class="btn_opt">
                <a href="edit_prodact.php?id=<?= $news['id_product'] ?>" class="edit">تعديل</a>
                <a href="delete_prodact.php?id=<?= $news['id_product'] ?>" class="delete" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">حذف</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

    </table>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#search-input').on('input', function() {
        const searchTerm = $(this).val();
        $.ajax({
            url: 'search_news.php', // اسم ملف PHP للتعامل مع البحث
            type: 'GET',
            data: { search: searchTerm },
            success: function(data) {
                $('#news-table-body').html(data);
            }
        });
    });
});
</script>

</html>

