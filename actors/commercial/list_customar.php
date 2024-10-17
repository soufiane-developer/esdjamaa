<?php
// الاتصال بقاعدة البيانات
// include '../connect.php';

// استعلام لجلب بيانات العملاء من قاعدة البيانات
$query = $conn->prepare("SELECT * FROM customar");
$query->execute();
$customers = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض العملاء</title>
    <style>
        .container {
            /* width: 1010px; */
            margin: 50px auto;
            margin-left: 280px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2872e0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background-color: #2872e0;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>قائمة العملاء</h1>
    <table>
        <thead>
            <tr>
                <th>رقم العميل</th>
                <th>الاسم</th>
                <!-- <th>البريد الإلكتروني</th> -->
                <th>رقم الهاتف</th>
                <th>العنوان</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= $customer['id']; ?></td>
                    <td><?= $customer['name_customar']; ?></td>
                    <!-- <td><?= $customer['email']; ?></td> -->
                    <td><?= $customer['phone']; ?></td>
                    <td><?= $customer['address']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
