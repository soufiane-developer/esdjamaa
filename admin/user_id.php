<?php

include '../connect.php';

if (isset($_COOKIE['admin_id'])) {

    $admin_id = filter_var($_COOKIE['admin_id'], FILTER_SANITIZE_STRING);


    if (empty($admin_id)) {
        header('location:login.php');
        exit();
    }


    $select_admin = $conn->prepare("SELECT * FROM admin WHERE id = ? LIMIT 1");
    $select_admin->execute([$admin_id]);

} else {


    header('location:login.php');
    exit();
}
?>