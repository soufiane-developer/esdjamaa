<?php
session_start();


include '../../connect.php';

// try {
//     // Ensure proper use of PDO
//     $stmt = $conn->query("SELECT COUNT(*) FROM players");
//     $count = $stmt->fetchColumn();
// } catch (PDOException $e) {
//     echo "فشل في جلب البيانات: " . $e->getMessage();
// }
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة التحكم</title>
</head>

<body>
  <?php  include '../asider.php'; ?>
  <section>
 <?php include 'ads.php'; ?>
  </section>

</body>
<script>
    setTimeout(function() {
    alert("لقد كنت هنا لمدة ساعة! هل ترغب في الاستمرار؟");
}, 3600000);
</script>
</html>