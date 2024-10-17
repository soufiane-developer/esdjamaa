<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];

    // معالجة الصورة
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;
        $uploadFileDir = '../img/news/';
        $dest_path = $uploadFileDir . $newImageName;

        // رفع الصورة إلى المجلد
        if (move_uploaded_file($imageTmpPath, $dest_path)) {
            // إدخال البيانات في قاعدة البيانات
            $stmt = $conn->prepare("INSERT INTO news (title, content, date, image) VALUES (:title, :content, :date, :image)");
            $stmt->execute([
                ':title' => $title,
                ':content' => $content,
                ':date' => $date,
                ':image' => $newImageName,
            ]);

            $message_success[] = "تم إضافة الخبر بنجاح!";
        } else {
            $message_error[] = "حدث خطأ أثناء رفع الصورة.";
        }
    } else {
        $message_warning[] = "الرجاء اختيار صورة.";
    }
}

// عرض الأخبار من قاعدة البيانات
$stmt = $conn->query("SELECT * FROM news ORDER BY date DESC");
$newsList = $stmt->fetchAll();



// افتراضياً، سنرتب حسب التاريخ
$orderBy = 'date DESC';
$searchQuery = '';

if (isset($_GET['sort'])) {
    if ($_GET['sort'] === 'title') {
        $orderBy = 'title ASC';
    } elseif ($_GET['sort'] === 'date') {
        $orderBy = 'date DESC';
    }
}

// معالجة البحث
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $searchQuery = " WHERE title LIKE :search ";
}

// عرض الأخبار من قاعدة البيانات مع ترتيب حسب المتغير
$stmt = $conn->prepare("SELECT * FROM news $searchQuery ORDER BY $orderBy");
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

.search-form button {
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


    </style>
</head>
<body>
<?php 

include 'message_net.php'; ?>

            <div class="news-form-container">
        <h2>إضافة خبر جديد</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">العنوان:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="image">الصورة:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="date">التاريخ:</label>
                <input type="date" id="date" name="date" required>
            </div>

            <div class="form-group">
                <label for="content">الوصف:</label>
                <textarea id="content" name="content" rows="5" required></textarea>
            </div>

            <button type="submit">إضافة الخبر</button>
        </form>
    </div>

    <!-- جدول عرض الأخبار -->
    <div class="news-list-container">
    <h2>الأخبار المضافة</h2>

    <div class="sort-buttons">
        <a href="?sort=title" class="sort-button">فرز حسب العنوان</a>
        <a href="?sort=date" class="sort-button">فرز حسب التاريخ</a>
    </div>

    <form class="search-form">
    <input type="text" id="search-input" placeholder="ابحث عن خبر..." required>
</form>
 

    <table>
        <thead>
            <tr>
                <th>العنوان</th>
                <th>التاريخ</th>
                <th>الصورة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody id="news-table-body">
    <?php foreach ($newsList as $news) : ?>
        <tr>
            <td><?= htmlspecialchars($news['title']) ?></td>
            <td><?= htmlspecialchars($news['date']) ?></td>
            <td><img src="../img/news/<?= htmlspecialchars($news['image']) ?>" alt="news image" width="100"></td>
            <td>
                <a href="edit_news.php?id=<?= $news['id'] ?>" class="edit">تعديل</a>
                <a href="delete_news.php?id=<?= $news['id'] ?>" class="delete" onclick="return confirm('هل أنت متأكد من حذف هذا الخبر؟')">حذف</a>
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

