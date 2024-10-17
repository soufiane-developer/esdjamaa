<?php
session_start();

// include 'user_id.php';

include '../../connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }
    </style>
    <title>Home Commercial</title>
</head>
<body>
    <?php

    include 'commercial_asider.php';
    include 'commercial.php';
    include 'footer.php';

    ?>
</body>
<script>
    setTimeout(function() {
    alert("لقد كنت هنا لمدة ساعة! هل ترغب في الاستمرار؟");
}, 3600000);
</script>
</html>