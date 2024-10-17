<style>
        body {
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            direction: rtl;
            display: grid;
            grid-template-areas:
                "body aside"
                "body aside";
            background-color: #f4f4f4;
            padding: 20px;
        }

        


        .dashboard-container {
            flex-grow: 1;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            grid-area: body;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        .action-buttons a {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }

        .edit-btn {
            background-color: #007bff;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .add-member {
            display: inline-block;
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .add-member:hover {
            background-color: #218838;
        }

        form {
            margin-bottom: 20px;
        }

        form input[type="text"],
        form select {
            padding: 8px;
            margin-right: 10px;
        }

        form input[type="submit"] {
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>

<?php 
// session_start();
include '../connect.php';
include 'user_id.php';

try {
    // Ensure proper use of PDO
    $stmt = $conn->query("SELECT COUNT(*) FROM admin");
    $count = $stmt->fetchColumn();
} catch (PDOException $e) {
    echo "فشل في جلب البيانات: " . $e->getMessage();
}
include 'asider.php'; 
?>
<div class="dashboard-container">
        <h2>لوحة التحكم - الأعضاء المسجلين</h2>
        <p>إجمالي الأعضاء: <?php echo htmlspecialchars($count); ?></p>
        <a href="add_administ.php" class="add-member">إضافة عضو جديد</a>

<table>
            <thead>
                <tr>
                    <th>رقم العضو</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>

            <?php

       
                try {
            
                    $stmt = $conn->query("SELECT * FROM actors WHERE roles = 'president'");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['ferstname'] .' '. $row['lastname'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        // echo "<td>" . $row['place'] . "</td>";
                        echo "<td class='action-buttons'>
                                <a href='edit_member.php?id=" . $row['id'] . "' class='edit-btn'>تعديل</a>
                                <a href='delete_member.php?id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"هل أنت متأكد من الحذف؟\");'>حذف</a>
                                <a href='view_member.php?id=" . $row['id'] . "' class='edit-btn'>تفاصيل</a>
                                </td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "فشل الاتصال بقاعدة البيانات: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>