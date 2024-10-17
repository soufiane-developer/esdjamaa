<style>
    .asider {
        direction: ltr;
        width: 250px;
        background-color: #fff;
        padding: 15px;
        grid-area: aside;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Adds shadow for a slight 3D effect */
        border-radius: 10px;
        /* Optional: to make the corners rounded */
        height: 100vh;
        /* Ensures the sidebar spans the full height of the viewport */
        position: fixed;
        /* Keeps the sidebar fixed in place */
        top: 0;
        left: 0;
    }

    .asider img {
        width: 100px;
        margin-bottom: 10px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        border-radius: 50%;
        /* Optional: Make the image circular if needed */
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
</style>
<?php
include 'user_id.php';
include '../connect.php';

    $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
    $select_profile->execute([$admin_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>
    <aside class="asider">
    <nav>
        <ul>
            <a href="dashboard.php"><img src="../img/esd.jpg" alt=""></a>
            <h4><?= $fetch_profile['ferstname'] . ' ' . $fetch_profile['lastname']?></h4>
            <a href="" class="email"><?= $fetch_profile['email'] ?></a>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="accounts.php">Accounts</a></li>
            <li><a href="list_administ.php">Administrator</a></li>
            <li><a href="add_match.php">Match</a></li>
            <li><a href="members.php">Nombers</a></li>
            <li><a href="add_news.php">News</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php" onclick="return confirm('logout from this website?');">Logout</a></li>

        </ul>
    </nav>
</aside>
<?php
 include '../message_net.php'; 
 ?>
