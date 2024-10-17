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

    input[type="submit"] {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #218838;
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
</style>

<style>
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

/* Mobile Styles */
/* إخفاء القائمة بشكل افتراضي على الشاشات الصغيرة */
@media (max-width: 768px) {
    .asider {
        width: 200px;
        height: 100vh;
        position: fixed;
        left: -250px; /* إخفاء القائمة خارج الشاشة */
        transition: left 0.3s ease;
    }

    .asider.show {
        left: 0; /* إظهار القائمة عند إضافة كلاس "show" */
    }
}

/* زر القائمة */
.menu-toggle {
    display: none;
}

@media (max-width: 768px) {
    .menu-toggle {
        display: block;
        background-color: #333;
        color: #fff;
        padding: 10px;
        cursor: pointer;
        text-align: center;
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1000;
    }
    .team {
    width: 100%;
}
}


</style>
<?php
include '../../user_id.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $object = $_POST['object'];
    $message = $_POST['message'];
    

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileDestination = '../../uploads/' . $fileName;


        move_uploaded_file($fileTmpPath, $fileDestination);
    }

    include '../../connect.php';

    $stmt = $conn->prepare("INSERT INTO messages (object, message, file) VALUES (?, ?, ?)");
    $stmt->execute([$object, $message, $fileName]);

    echo "تم إرسال الرسالة بنجاح!";
}

include '../../connect.php';


$stmt = $conn->query("SELECT * FROM messages WHERE ORDER BY id DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h1>الرسائل المستقبلة</h1>";

if (empty($messages)) {
    echo "لا توجد رسائل.";
} else {
    foreach ($messages as $message) {
        echo "<div>";
        echo "<strong>إلى:</strong> " . htmlspecialchars($message['object']) . "<br>";
        echo "<strong>الرسالة:</strong> " . nl2br(htmlspecialchars($message['message'])) . "<br>";
        if ($message['file']) {
            echo "<strong>ملف مرفق:</strong> <a href='../../uploads/" . htmlspecialchars($message['file']) . "'>تحميل</a><br>";
        }
        echo "</div><hr>";
    }
}

  $role = $actor['roles'];

if ($role == 'president') {
    $select_profile = $conn->prepare("SELECT * FROM actors WHERE id = ? AND roles = 'president'");
    $select_profile->execute([$actor_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    echo '
    <aside class="asider">
    <nav>
            <div class="menu-toggle" onclick="toggleMenu()">☰ Menu</div>
        <ul>
            <a href="dashboard.php"><img src="../../img/esd.jpg" alt=""></a>
            <h4>'. $fetch_profile['firstname'] . ' ' . $fetch_profile['lastname'] .'</h4>
            <a href="" class="email">'. $fetch_profile['email'] .'</a>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="list_administ.php">Administrator</a></li>
            <li><a href="members.php">Nombers</a></li>
            <li><a href="add_news.php">News</a></li>
            <li><a href="add_match.php">Match</a></li>
            <li><a href="actor_waitting.php">Waitting</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="../../logout.php">Logout</a></li>
        </ul>
    </nav>
</aside>
    ';
} elseif ($role == 'commercial') {
    $select_profile = $conn->prepare("SELECT * FROM actors WHERE id = ? AND roles = 'commercial'");
    $select_profile->execute([$actor_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

    echo '
    <aside class="asider">
    <nav>
        <ul>
            <a href="dashboard.php"><img src="../../img/esd.jpg" alt=""></a>
            <h4>'. $fetch_profile['firstname'] . ' ' . $fetch_profile['lastname'] .'</h4>
            <a href="" class="email">'. $fetch_profile['email'] .'</a>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="list_administ.php">Administrator</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</aside>
    ';
} elseif ($role == 'mobarati') {
    $select_profile = $conn->prepare("SELECT * FROM actors WHERE id = ? AND roles = 'mobarati'");
    $select_profile->execute([$actor_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

    echo '
    <aside class="asider">
    <nav>
            <div class="menu-toggle" onclick="toggleMenu()">☰ Menu</div>
        <ul>
            <a href="dashboard.php"><img src="../../img/esd.jpg" alt=""></a>
            <h4>'. $fetch_profile['firstname'] . ' ' . $fetch_profile['lastname'] .'</h4>
            <a href="" class="email">'. $fetch_profile['email'] .'</a>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="add_match.php">Add</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>
</aside>
    ';
} elseif ($role == 'techninal') {
    $select_profile = $conn->prepare("SELECT * FROM actors WHERE id = ? AND roles = 'techninal'");
    $select_profile->execute([$actor_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);


} elseif ($role == 'doctor') {
    $select_profile = $conn->prepare("SELECT * FROM actors WHERE id = ? AND roles = 'doctor'");
    $select_profile->execute([$actor_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

    echo '
    <aside class="asider">
    <nav>
        <ul>
            <a href="dashboard.php"><img src="../../img/Profile/doctor.jpg" alt=""></a>
            <h4>'. $fetch_profile['firstname'] . ' ' . $fetch_profile['lastname'] .'</h4>
            <a href="" class="email">'. $fetch_profile['email'] .'</a>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="message_'.$fetch_profile['roles'].'.php">Messages</a></li>
            <li><a href="setting.php">Settings</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>
</aside>
    ';
} else{
    $message_error[] = 'error';
}
?>
    <?php include '../../message_net.php'; ?>
    <section>

    <h1>إرسال رسالة</h1>
    <form action="send_message.php" method="POST" enctype="multipart/form-data">
        <label for="object">إلى:</label>
        <input type="text" id="object" name="object" required><br><br>

        <label for="message">الرسالة:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <label for="file">إرفاق ملف:</label>
        <input type="file" id="file" name="file"><br><br>

        <input type="submit" value="إرسال">
    </form>

    </section>
<script>
    function toggleMenu() {
    const asider = document.querySelector('.asider');
    asider.classList.toggle('show');
}
</script>