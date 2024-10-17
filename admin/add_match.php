<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $match_rank  = $_POST['match_rank '];
    $my_team = $_POST['my_team'];
    $opponent = $_POST['opponent'];

    $date = $_POST['date'];
    $time = $_POST['time']; // Added capturing time from POST

    // Processing the opponent's image
    $newImageNameConter = null;
    if (isset($_FILES['image_conter']) && $_FILES['image_conter']['error'] === UPLOAD_ERR_OK) {
        $imageConterTmpPath = $_FILES['image_conter']['tmp_name'];
        $imageConterName = $_FILES['image_conter']['name'];
        $imageConterExtension = pathinfo($imageConterName, PATHINFO_EXTENSION);
        $newImageNameConter = uniqid() . '.' . $imageConterExtension;
        $uploadFileDirConter = '../img/match/';
        $dest_path_conter = $uploadFileDirConter . $newImageNameConter;

        if (!move_uploaded_file($imageConterTmpPath, $dest_path_conter)) {
            $message_error[] = "حدث خطأ أثناء رفع صورة الفريق الخصم.";
        }
    } else {
        $message_warning[] = "الرجاء اختيار صورة لفريق الخصم.";
    }

    // Processing the main image
    $newImageName = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;
        $uploadFileDir = '../img/match/';
        $dest_path = $uploadFileDir . $newImageName;

        if (!move_uploaded_file($imageTmpPath, $dest_path)) {
            $message_error[] = "حدث خطأ أثناء رفع صورة فريقي.";
        }
    } else {
        $message_warning[] = "الرجاء اختيار صورة.";
    }

    // Check if both images were uploaded successfully before inserting into the database
    if ($newImageName && $newImageNameConter) {
        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO matches (match_rank , date, time, image, image_conter) VALUES (:match_rank , :date, :time, :image, :image_conter)");
        $stmt->execute([
            ':match_rank ' => $match_rank ,
            ':date' => $date,
            ':time' => $time,
            ':image' => $newImageName,
            ':image_conter' => $newImageNameConter
        ]);
        header('Location: add_match.php');
        exit; // Ensure script stops executing after redirect
    }
}

// عرض الأخبار من قاعدة البيانات
$stmt = $conn->query("SELECT * FROM matches ORDER BY date DESC");
$newsList = $stmt->fetchAll();

// افتراضياً، سنرتب حسب التاريخ
$orderBy = 'date DESC';
$searchQuery = '';

if (isset($_GET['sort'])) {
    if ($_GET['sort'] === 'match_rank ') {
        $orderBy = 'match_rank  ASC';
    } elseif ($_GET['sort'] === 'date') {
        $orderBy = 'date DESC';
    }
}

// معالجة البحث
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $searchQuery = " WHERE match_rank  LIKE :search ";
}

// عرض الأخبار من قاعدة البيانات مع ترتيب حسب المتغير
$stmt = $conn->prepare("SELECT * FROM matches $searchQuery ORDER BY $orderBy");
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
    margin-left: 280px;
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
input[type="time"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}
input[type="time"] {
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
include 'asider.php';
include '../message_net.php'; ?>

            <div class="news-form-container">
        <h2>إضافة مبارات جديد</h2>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
                <label for="title">رتبة المبارات:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="my_team">اسم فريقي:</label>
                <input type="text" id="my_team" name="my_team" required>
            </div>

            <div class="form-group">
                <label for="opponent">اسم فريق الخصم:</label>
                <input type="text" id="opponent" name="opponent" required>
            </div>
            
        <div class="form-group">
    <label for="image_conter">فريق الخصم:</label>
    <input type="file" id="image_conter" name="image_conter" accept="image/*" required>
</div>

<div class="form-group">
    <label for="image">فريقي:</label>
    <input type="file" id="image" name="image" accept="image/*" required>
</div>

<div class="form-group">
    <label for="date">التاريخ المبارات :</label>
    <input type="date" id="date" name="date" required>
</div>

<div class="form-group">
    <label for="time">ساعة المبارات :</label>
    <input type="time" id="time" name="time" required>
</div>


            <button type="submit">إضافة المبارات</button>
        </form>
    </div>

    <!-- جدول عرض الأخبار -->
    <div class="news-list-container">
    <h2>المباريات</h2>

    <div class="sort-buttons">
        <a href="?sort=title" class="sort-button">فرز حسب العنوان</a>
        <a href="?sort=date" class="sort-button">فرز حسب التاريخ</a>
    </div>

    <form class="search-form">
    <input type="text" id="search-input" placeholder="ابحث عن مبارات..." required>
</form>
 

    <table>
        <thead>
            <tr>
                <th>رتبة المبارات</th>
                <th>فريقي</th>
                <th>فريق الخصم</th>
                <th>التاريخ</th>
                <th>الوقت</th>
                <th>الاجراءات</th>
            </tr>
        </thead>
        <tbody id="news-table-body">
    <?php foreach ($newsList as $news) : ?>
        <tr>
            <td><?= htmlspecialchars($news['match_rank']) ?></td>
            <td><?= htmlspecialchars($news['my_team']) ?><br> <img src="../img/match/<?= htmlspecialchars($news['image']) ?>" alt="news image" width="100"></td>
            <td><?= htmlspecialchars($news['opponent_team']) ?><br> <img src="../img/match/<?= htmlspecialchars($news['image_opponent']) ?>" alt="news image" width="100"></td>
            <td><?= htmlspecialchars($news['date']) ?></td>
            <td><?= htmlspecialchars($news['time']) ?></td>
            <td>
                <a href="edit_match.php?id=<?= $news['id'] ?>" class="edit">تعديل</a>
                <a href="delete_match.php?id=<?= $news['id'] ?>" class="delete" onclick="return confirm('هل أنت متأكد من حذف هذه المبارات?')">حذف</a>
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
            url: 'search_match.php', // اسم ملف PHP للتعامل مع البحث
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

