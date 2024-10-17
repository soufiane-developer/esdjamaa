<?php

include '../../connect.php';
// include '../connect.php';


if (isset($_COOKIE['actor_id'])) {

    $actor_id = filter_var($_COOKIE['actor_id'], FILTER_SANITIZE_STRING);
    $role = filter_var($_COOKIE['roles'], FILTER_SANITIZE_STRING);

    // Check if actor ID is empty
    if (empty($actor_id)) {
        header('location:login.php');
        exit();
    }


    $select_actor = $conn->prepare("SELECT * FROM actors WHERE id = ? LIMIT 1");
    $select_actor->execute([$actor_id]);

    if ($select_actor->rowCount() > 0) {
        $actor = $select_actor->fetch(PDO::FETCH_ASSOC);


        if ($actor['locked'] == 1) {

            setcookie('actor_id', '', time() - 3600, '/'); // Remove the cookie
            session_unset(); // Clear session data
            session_destroy(); // Destroy session


            header('location: 404.php');
            exit();
        }

        // // Check the actor's role and display content accordingly
        // if ($actor['roles'] == 'doctor') {
        //     echo "Welcome, Doctor!";
        //     // Display content for doctor
        // }  elseif ($actor['roles'] == 'technical') {
        //     echo "Welcome, Technical actor!";
        //     // Display content for technical actor
        // } elseif ($actor['roles'] == 'commercial') {
        //   echo "Welcome, Technical commercial!";

        // } elseif ($actor['roles'] == 'president') {
        //     echo "Welcome, Technical president!";
  
        //   } elseif ($actor['roles'] == 'mobarati') {
        //     echo "Welcome, Technical mobarati!";
  
        //   } else {
        //     echo "Welcome!";
        //     // Display default content
        // }

    } else {
        // If no actor found, redirect to login page
        header('location:login.php');
        exit();
    }

} else {

    // No cookie set, redirect to login page
    header('location:login.php');
    exit();
}
?>
