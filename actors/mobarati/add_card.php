<?php
// ربط بقاعدة البيانات
$pdo = new PDO('mysql:host=localhost;dbname=esd', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teamId = $_POST['teamId'];
    $playerName = $_POST['playerName'];
    $cardType = $_POST['cardType'];
    
    // إدراج البطاقة في قاعدة البيانات
    $stmt = $pdo->prepare("INSERT INTO player_cards (team_name, player_name, card_type) VALUES (:team, :player, :card)");
    $stmt->execute([':team' => $teamId, ':player' => $playerName, ':card' => $cardType]);
}
?>
