<?php
// session_start();

include 'connect.php';
// $actor['roles']
if (isset($_COOKIE['actor_id'])) {

  $actor_id = filter_var($_COOKIE['actor_id'], FILTER_SANITIZE_STRING);
  $role = filter_var($_COOKIE['roles'], FILTER_SANITIZE_STRING);



  if (empty($actor_id)) {
    header('location:../login.php');
    exit();
  }


  $select_actor = $conn->prepare("SELECT * FROM actors WHERE id = ? AND roles = ? LIMIT 1");
  $select_actor->execute([$actor_id, $role]);
  echo $actor_id;
  echo $role;
  echo 'fi';

  if ($select_actor->rowCount() > 0) {
    $actor = $select_actor->fetch(PDO::FETCH_ASSOC);


    if ($actor['locked'] == 1) {

      setcookie('actor_id', '', time() - 3600, '/'); // Remove the cookie
      setcookie('roles', '', time() - 3600, '/'); // Remove the cookie

      session_unset(); // Clear session data
      session_destroy(); // Destroy session


      header('location:../login.php?account_locked=true');
      exit();
    }
    

  } else {

    header('location:../../login.php');
    exit();
  }

} else {


  header('location:../../login.php');
  exit();
}
?>
