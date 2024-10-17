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
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            grid-area: body;
            margin-left: 5%;
            width: 92%;
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
    $stmt = $conn->query("SELECT COUNT(*) FROM players");
    $count = $stmt->fetchColumn();
} catch (PDOException $e) {
    echo "فشل في جلب البيانات: " . $e->getMessage();
}
include 'asider.php'; 
?>
<div class="dashboard-container">
        <h2>لوحة التحكم - الأعضاء المسجلين</h2>
        <p>إجمالي الأعضاء: <?php echo htmlspecialchars($count); ?></p>

        <form method="GET" action="">
            <input type="text" name="search" placeholder="ابحث عن عضو..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <input type="submit" value="بحث">
        </form>

        <form method="GET" action="">
            <label for="place">تصفية حسب المركز:</label>
            <select name="place" id="place">
                <option value="">الجميع</option>
                <option value="GK" <?php echo isset($_GET['place']) && $_GET['place'] == 'حارس' ? 'selected' : ''; ?>>حارس</option>
                <option value="مهاجم" <?php echo isset($_GET['place']) && $_GET['place'] == 'مهاجم' ? 'selected' : ''; ?>>مهاجم</option>
                <!-- أضف خيارات أخرى حسب الحاجة -->
            </select>
            <input type="submit" value="تصفية">
        </form>

        <?php include 'view_players.php'; ?>
    </div>