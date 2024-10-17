<?php
include '../../connect.php';

$roles = "president";

$stmt = $conn->prepare("SELECT * FROM actors WHERE roles != ?");
$stmt->execute([$roles]);
$newsList = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    text-align: right;
    margin-left: 280px;
    padding: 0;
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

.sth2{
    text-align: center;
    background-color: #0359e278;
    padding: 6px;
    border-radius: .5rem;
    width: 50%;
    margin: 41px 20%;
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
    <title>الاعظاء</title>
</head>

<body>
  <?php  include '../asider.php'; ?>
  <section>
    <h2 class="sth2">List Members</h2>
  <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Roles</th>
                <th>Email</th>
                <th>Image</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody id="news-table-body">
    <?php foreach ($newsList as $news) : ?>
        <tr>
            <td><?= htmlspecialchars($news['ferstname']) ?> <?= htmlspecialchars($news['lastname']) ?></td>
            <td><?= htmlspecialchars($news['roles']) ?></td>
            <td><?= htmlspecialchars($news['email']) ?></td>
            <td><img src="../../img/match/<?= htmlspecialchars($news['img']) ?>" alt="news image" width="100"></td>
            <td>
                <a href="edit_member.php?id=<?= $news['id'] ?>" class="edit" onclick="return confirm('أنت على وشك تعديل معلومات')">Edit</a>
                <a href="" class="delete"  onclick="return confirm('مازالت هذه الخاصية قيد التنفيذ')">Delete</a>
                <!-- delete_match.php?id=<?= $news['id'] ?> -->
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

    </table>
  </section>

</body>

</html>