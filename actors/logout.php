<?php
session_start();

// إزالة جميع متغيرات الجلسة
session_unset();

// تدمير الجلسة
session_destroy();

include '../../connect.php';

   setcookie('actor_id', '', time() - 1, '/');

   header('location:../home.php');

?>