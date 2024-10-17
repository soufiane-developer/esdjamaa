<?php
session_start();
include '../../connect.php';

if (isset($_POST['acpt'])) {

    $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);

    if (!is_numeric($id)) {
        $message_warning[] = 'Invalid ID!';
        return;
    }

    $select_waiting = $conn->prepare("SELECT * FROM `actor_waitin` WHERE id = ?");
    $select_waiting->execute([$id]);

    if ($select_waiting->rowCount() > 0) {
        $fetch_waiting = $select_waiting->fetch(PDO::FETCH_ASSOC);

        $firstname = filter_var($fetch_waiting['ferstname'], FILTER_SANITIZE_STRING);
        $lastname = filter_var($fetch_waiting['lastname'], FILTER_SANITIZE_STRING);
        $roles = filter_var($fetch_waiting['roles'], FILTER_SANITIZE_STRING);
        $email = filter_var($fetch_waiting['email'], FILTER_SANITIZE_EMAIL);
        $password = $fetch_waiting['password']; // Assuming the password is already hashed

        $verify_tutor = $conn->prepare("SELECT * FROM `actors` WHERE email = ?");
        $verify_tutor->execute([$email]);

        if ($verify_tutor->rowCount() == 0) {
            $insert_tutor = $conn->prepare("INSERT INTO `actors` (ferstname, lastname, roles, email, password) VALUES (?, ?, ?, ?, ?)");
            $insert_tutor->execute([$firstname, $lastname, $roles, $email, $password]);

            $delete_waiting = $conn->prepare("DELETE FROM `actor_waitin` WHERE id = ?");
            $delete_waiting->execute([$id]);

            $message_success[] = 'The teacher has been successfully accepted and removed from the waiting list!';
        } else {
            $message_warning[] = 'Teacher is already in the system!';
        }
    } else {
        $message_warning[] = 'Teacher has already been removed from the waiting list!';
    }
}

if (isset($_POST['cancel'])) {

    $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);

    if (!is_numeric($id)) {
        $message_warning[] = 'Invalid ID!';
        return;
    }

    $select_waiting = $conn->prepare("SELECT * FROM `actor_waitin` WHERE id = ?");
    $select_waiting->execute([$id]);

    if ($select_waiting->rowCount() > 0) {
        $fetch_waiting = $select_waiting->fetch(PDO::FETCH_ASSOC);
        $email = filter_var($fetch_waiting['email'], FILTER_SANITIZE_EMAIL);

        $verify_tutor = $conn->prepare("SELECT * FROM `actors` WHERE email = ?");
        $verify_tutor->execute([$email]);

        if ($verify_tutor->rowCount() == 0) {
            $delete_waiting = $conn->prepare("DELETE FROM `actor_waitin` WHERE id = ?");
            $delete_waiting->execute([$id]);

            $message_success[] = 'The teacher has been successfully removed from the waiting list!';
        } else {
            $message_warning[] = 'Teacher is already in the system!';
        }
    } else {
        $message_warning[] = 'Teacher has already been removed from the waiting list!';
    }
}

?>


<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .new_c{
            width: clamp(50%, 97% - 20%, 100%);
            margin-left: 23%;
        }
         .new-customers ul {
        list-style-type: none;
        padding: 0;
    }

    .new-customers ul li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #f1f1f1;
    }

    .customer-name {
        font-size: 16px;
        color: #333;
        flex: 1;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        /* Space between buttons */
    }

    .accept-btn,
    .reject-btn,
    .view-btn {
        padding: 5px 10px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        /* Transition for hover effects */
    }

    .accept-btn {
        background-color: #28a745;
        color: #fff;
    }

    .accept-btn:hover {
        background-color: #218838;
        /* Darker shade on hover */
    }

    .reject-btn {
        background-color: #dc3545;
        color: #fff;
    }

    .reject-btn:hover {
        background-color: #c82333;
        /* Darker shade on hover */
    }

    .view-btn{
        background-color: #2872e0;
        color: #fff;
    }
    .view-btn:hover{
        background-color: #2c60ad;
    }



    .modal {
    display: none; /* مخفية بشكل افتراضي */
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0, 0, 0, 0.4); /* خلفية داكنة */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* عرض النافذة */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}


.modal {
    display: none; /* مخفية بشكل افتراضي */
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0, 0, 0, 0.7); /* لون خلفية أكثر قتامة */
}

.modal-content {
    background-color: #ffffff; /* لون الخلفية */
    margin: 10% auto; /* تغيير الموضع */
    padding: 30px; /* زيادة المساحة الداخلية */
    border: 2px solid #888; /* إضافة إطار */
    border-radius: 10px; /* زوايا مستديرة */
    width: 80%; /* عرض النافذة */
    max-width: 500px; /* الحد الأقصى للعرض */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* إضافة ظل */
}

.close {
    color: #333; /* تغيير لون زر الإغلاق */
    float: right;
    font-size: 30px; /* زيادة حجم الخط */
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #e74c3c; /* تغيير لون عند التحويم */
    text-decoration: none;
    cursor: pointer;
}

h2 {
    color: #2872e0; /* تغيير لون العنوان */
    text-align: center; /* توسيط العنوان */
}



    @media (max-width: 768px) {

        .recent-projects,
        .new-customers {
            width: 100%;

        }
    }
    </style>
    <title>Waitting</title>
</head>

<body>
  <?php  include '../asider.php'; ?>
  <section class="new_c">
  <div class="new-customers">
        <h2>New Actors</h2>
        <ul>
            <?php

            $rows = $conn->prepare("SELECT * FROM actor_waitin");
            $rows->execute();
            if ($rows->rowCount() > 0) {
                while ($fetch_customar = $rows->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <li>
                        <span class="customer-name"><?= $fetch_customar['ferstname']; ?> <?= $fetch_customar['lastname']; ?></span>
                        <span class="customer-name"><?= $fetch_customar['email']; ?></span>
                        <span class="customer-name"><?= $fetch_customar['roles']; ?></span>
                        <div class="action-buttons">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $fetch_customar['id']; ?>">
                            <button class="accept-btn" name="acpt" onclick="return confirm('You Accept <?= $fetch_customar['ferstname']; ?> <?= $fetch_customar['lastname']; ?>?');">Accept</button>
                            <button class="reject-btn" name="cancel" onclick="return confirm('Are You sure you want to cancel the order <?= $fetch_customar['ferstname']; ?> <?= $fetch_customar['lastname']; ?>?');">Cancel</button>
                            </form>
                        </div>
                    </li>
                    <?php
                }
            }else {
                echo '<li>No results found</li>';
            }
            ?>
        </ul>
    </div>
  </section>

</body>
<script>
    setTimeout(function() {
    alert("لقد كنت هنا لمدة ساعة! هل ترغب في الاستمرار؟");
}, 3600000);
</script>
</html>