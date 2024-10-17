<?php     
    include '../../connect.php';
    include '../../user_id.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $object = $_POST['object'];
        $message = $_POST['message'];
        
    
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'docx'];
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
            if (in_array($fileExtension, $allowedExtensions)) {
                $fileDestination = '../../uploads/' . $fileName;
                move_uploaded_file($fileTmpPath, $fileDestination);
            } else {
                echo "الملف غير مسموح به.";
            }
        }
        
    
    
        $stmt = $conn->prepare("INSERT INTO messages (object, message, file) VALUES (?, ?, ?)");
        $stmt->execute([$object, $message, $fileName]);
    }
    
    
    
    $stmt = $conn->query("SELECT messages.*, actors.*
    FROM messages 
    LEFT JOIN actors ON messages.id = actors.id 
    ORDER BY messages.id DESC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    h1 {
        color: #333;
        text-align: center;
    }

    form {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 500px;
        margin: auto;
    }

    label {
        display: block;
        margin: 10px 0 5px;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
        height: 100px;
    }

    input[type="submit"],
    select {
        width: 100%;
        background-color: #0359e2;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .message-container {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
        margin: 20px 0;
    }

    .message-container strong {
        display: block;
        margin-bottom: 5px;
    }

    .message-container a {
        color: #007bff;
        text-decoration: none;
    }

    .message-container a:hover {
        text-decoration: underline;
    }

.asider {
    direction: ltr;
    width: 250px;
    background-color: #fff;
    padding: 15px;
    grid-area: aside;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    transition: all 0.3s ease;
}

.asider img {
    width: 100px;
    margin-bottom: 10px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    border-radius: 50%;
}

.asider ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.asider li {
    margin: 15px 0;
    text-align: center;
}

.asider li a {
    text-decoration: none;
    color: #333;
    font-size: 18px;
    display: block;
    padding: 10px;
    background-color: #f4f4f4;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.asider li a:hover {
    background-color: #ddd;
}

h4 {
    text-align: center;
    margin: 0;
}

ul a {
    display: flex;
    justify-content: center;
    text-decoration: none;
}

.email:hover {
    color: red;
}
.sect{
margin-left: 266px;
}

/* Mobile Styles */

@media (max-width: 768px) {
    .asider {
        width: 200px;
        height: 100vh;
        position: fixed;
        left: -250px; 
        transition: left 0.3s ease;
    }

    .asider.show {
        left: 0; 
    }

    .sect{
margin-left: 0;
}
}


.menu-toggle {
    display: none;
}

</style>

<?php 
include '../asider.php';
include '../../message_net.php'; ?>
<section class="sect">

<h1>إرسال رسالة</h1>
    <form action="send_message.php" method="POST" enctype="multipart/form-data">
        <label for="id_receiver">To:</label>
        <?php

            $stmt = $conn->query("SELECT id, email FROM actors WHERE email != 'sofiane@gmail.com'");
$emails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <select name="id_receiver" id="id_receiver" required>
            <option value="">--Select Email--</option>
            <?php foreach ($emails as $email) {
                echo "<option value=". htmlspecialchars($email['id']).">" . htmlspecialchars($email['email']). "</option>";
            }
                ?>

        </select>
        <label for="object">Object:</label><br>
        <input type="text" id="object" name="object" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <label for="file">File:</label>
        <input type="file" id="file" name="file"><br><br>

        <input type="submit" value="Send">
    </form>

    <?php

echo "<h1>الرسائل المستقبلة</h1>";

if (empty($messages)) {
    echo "Do not have message.";
} else {
    foreach ($messages as $message) {
        echo "<div style='border-bottom: 1px solid #444; padding: 10px 0; display: flex; align-items: center;'>";
        
        if (!empty($message['img'])) {
            echo "<div class='messa' style='margin-right: 15px;'>";
            echo "<img src='../../img/Profile/" . htmlspecialchars($message['img']) . "' alt='Profile Image' style='width: 40px; height: 40px; border-radius: 50%; object-fit: cover;'>";
            echo "</div>";
        } else {
            echo "<div class='messa' style='margin-right: 15px;'>";
            echo "<img src='../../img/esd.png' alt='Default Profile Image' style='width: 40px; height: 40px; border-radius: 50%; object-fit: cover;'>";
            echo "</div>";
        }
    
        echo "<div class='messa_info' style='flex-grow: 1;'>";
        echo "<p style='color: #ddd; font-size: 14px; margin: 0;'>@". htmlspecialchars($message['username']) ."</p>";
        echo "<p style='color: #bbb; font-size: 12px; margin: 0;'>" . htmlspecialchars($message['object']) . "</p>";
        echo "<p style='color: #bbb; font-size: 13px; margin: 5px 0;' max='160';>" . nl2br(htmlspecialchars($message['message'])) . "</p>";
    
        if (!empty($message['file'])) {
            echo "<a href='../../uploads/" . htmlspecialchars($message['file']) . "' style='color: #1a73e8; text-decoration: none;'>تحميل</a>";
        }
    
        echo "</div>";
        echo "</div><hr style='border-color: #555;'>";
    }
    
}

  $role = $actor['roles'];


?>
    </section>
<script>
    function toggleMenu() {
    const asider = document.querySelector('.asider');
    asider.classList.toggle('show');
}
</script>