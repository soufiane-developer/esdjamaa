<?php

include '../../connect.php';

   setcookie('actor_id', '', time() - 1, '/');

   header('location:../../home.php');

?>