<?php

$pdo = new PDO('mysql:host=localhost;dbname=esd', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teamId = $_POST['teamId'];
    $score = $_POST['my_scor'];
    

    $stmt = $pdo->prepare("UPDATE matches SET score = :my_scor WHERE team_name = :team");
    $stmt->execute([':my_scor' => $score, ':team' => $teamId]);
}
?>
