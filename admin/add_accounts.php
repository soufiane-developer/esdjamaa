<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ferstname = $_POST['ferstname'];
    $lastname = $_POST['lastname'];
    $date = $_POST['date'];
    $roles = $_POST['roles'];

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
            $stmt = $conn->prepare("INSERT INTO news (ferstname, lastname, roles, date, image) VALUES (:ferstname, :lastname, :roles, :date, :image)");
            $stmt->execute([
                ':farstname' => $farstname,
                ':lestname' => $lestname,
                ':roles' => $roles,
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
$stmt = $conn->prepare("SELECT * FROM actors $searchQuery ORDER BY $orderBy");
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
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

select {
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
    height: 50px;
    border-radius: 50%;
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
        <h2>إضافة حساب جديد</h2>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
                <label for="ferstname">اللقب:</label>
                <input type="text" id="ferstname" name="ferstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">الاسم:</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>

            <div class="form-group">
                <label for="image">الصورة:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <!-- <div class="form-group">
                <label for="date">التاريخ:</label>
                <input type="date" id="date" name="date" required>
            </div> -->

            <div class="form-group">
    <label for="roles">المهنة:</label>
    <select name="roles" id="">
        <option value="">--Select roles--</option>
        <?php
        // استعلام جلب الأدوار من الجدول
        $query = "SELECT roles FROM actors"; // تأكد من أن العمود اسمه roles في جدول actors
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // عرض الأدوار في القائمة المنسدلة
        foreach ($roles as $role): ?>
            <option value="<?= htmlspecialchars($role['roles']) ?>"><?= htmlspecialchars($role['roles']) ?></option>
        <?php endforeach; ?>
    </select>
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
                <th>الاسم الكامل</th>
                <th>المنصب</th>
                <th>التاريخ</th>
                <th>الصورة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody id="news-table-body">
    <?php foreach ($newsList as $news) : ?>
        <tr>
            <td><?= htmlspecialchars($news['ferstname']) ?> - <?= htmlspecialchars($news['lastname']) ?></td>
            <td><?= htmlspecialchars($news['roles']) ?></td>
            <td><?= htmlspecialchars($news['date']) ?></td>
            <td><img src="../img/Profile/<?= htmlspecialchars($news['img']) ?>" alt="news image" width="100"></td>
            <td>
    <?php
    // Determine the button label based on the current status
    $statusLabel = $news['locked'] == 1 ? 'Unlock' : 'Lock';
    $statusClass = $news['locked'] == 1 ? 'unlock' : 'lock';
    ?>

    <!-- Button for toggling status -->
    <button class="toggle-status <?= $statusClass ?>" 
            data-id="<?= $news['id'] ?>" 
            data-status="<?= $news['locked'] ?>">
        <?= $statusLabel ?>
    </button>
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



document.querySelectorAll('.toggle-status').forEach(function(button) {
    button.addEventListener('click', function() {
        var newsId = this.getAttribute('data-id');
        var currentStatus = this.getAttribute('data-status');

        // Send AJAX request to update the status
        fetch('toggle_news_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: newsId,
                status: currentStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update button text and status
                this.textContent = data.newStatus == 1 ? 'Unlock' : 'Lock';
                this.setAttribute('data-status', data.newStatus);
                this.classList.toggle('lock');
                this.classList.toggle('unlock');
            } else {
                alert('Error updating status.');
            }
        });
    });
});

</script>

</html>

