<?php

include 'connect.php';
$select_matches = $conn->prepare("SELECT * FROM matches");
$select_matches->execute();
$fetch_matche = $select_matches->fetch(PDO::FETCH_ASSOC);

$link = $fetch_matche['link'];
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>المباريات المباشرة</title>
    <style>
        /* إضافة أنماط CSS هنا */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .live-video {
            margin: 20px 0;
            text-align: center;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .live {
            font-weight: bold;
            color: red;
            padding: 5px;
            border-radius: 3px;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .match-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .match-details {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .prediction {
            margin-top: 15px;
            text-align: center;
        }

        .prediction select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            background: white;
            transition: border 0.2s;
        }

        .prediction select:hover {
            border-color: #007bff;
        }

        .title {
            margin: 15px 0;
            font-size: 18px;
            text-align: center;
            color: #333;
        }

        .match-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .league {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #777;
        }

        .league img {
            width: 25px;
            margin-right: 5px;
        }

        .match-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            background-color: #f9f9f9;
            /* لون خلفية خفيف */
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }


        .team-logo {
            height: 40px;
            border-radius: 50%;
            transition: transform 0.2s;
        }

        .team-logo:hover {
            transform: scale(1.1);
            /* تكبير الشعار عند التحويم */
        }

        .match-score {
            font-size: 24px;
            /* حجم خط أكبر للنتيجة */
            font-weight: bold;
            color: #333;
            /* لون داكن */
        }

        .match-details {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
            padding: 10px;
            /* padding حول التفاصيل */
            background-color: #fff;
            /* خلفية بيضاء */
            border-radius: 8px;
            /* زوايا دائرية */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            /* ظل */
        }

        .referee {
            font-weight: bold;
            /* جعل اسم الحكم بالخط العريض */
            color: #007bff;
            /* لون أزرق */
        }

        .location-name {
            font-weight: bold;
            /* جعل اسم الموقع بالخط العريض */
            color: #333;
            /* لون داكن */
        }

        .share-buttons {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .share-button {
            padding: 10px 15px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .facebook {
            background-color: #3b5998;
            /* لون فيسبوك */
        }

        .twitter {
            background-color: #1da1f2;
            /* لون تويتر */
        }

        .share-button:hover {
            opacity: 0.8;
            /* تأثير عند التحويم */
        }

        .whatsapp {
            background-color: #25D366;
            /* لون واتساب */
        }

        .telegram {
            background-color: #0088cc;
            /* لون تيليجرام */
        }


        /* تنسيق الفرق */
        .match-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .team-section {
            flex: 1;
            padding: 10px;
            margin: 0 10px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .team {
            margin: auto 225px;
            text-align: center;
        }

        .team-name {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }

        /* النتيجة */
        .match-score {
            font-size: 2em;
            font-weight: bold;
            color: #555;
            margin: 0 20px;
        }

        /* قسم اللاعبين */
        .players-section {
            margin-top: 10px;
        }

        .players-section h4 {
            font-size: 1.1em;
            color: #444;
        }

        .players-section ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }

        .players-section ul li {
            background-color: #f1f1f1;
            padding: 5px;
            margin-bottom: 5px;
            border-radius: 5px;
            color: #333;
        }

        /* قسم الكروت */
        .cards-section h4 {
            font-size: 1.1em;
            margin-top: 10px;
            color: #d32f2f;
            /* لون عنوان الكروت */
        }

        .yellow-cards li {
            background-color: #ffeb3b;
            padding: 5px;
            margin-bottom: 5px;
            border-radius: 5px;
            color: #333;
        }

        .red-cards li {
            display: flex;
            justify-content: space-between;
            background-color: #f44336;
            padding: 5px;
            margin-bottom: 5px;
            border-radius: 5px;
            color: white;
        }

        /* تفاصيل المباراة */
        .match-details {
            margin-top: 15px;
        }

        .match-time,
        .location,
        .status {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 5px
        }

        .team1-players li,
        .team2-players li {
            display: flex;
            justify-content: space-between;
        }

        ul.team1-players,
        ul.team2-players {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        ul.team1-players li,
        ul.team2-players li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        ul.team1-players li:hover,
        ul.team2-players li:hover {
            background-color: red;

        }

        ul.team1-players li:last-child,
        ul.team2-players li:last-child {
            border-bottom: none;
        }

        .player-number {
            width: 30px;
            text-align: center;
            font-weight: bold;
        }

        .player-name {
            flex-grow: 2;
            /* يوسع الاسم ليشغل المساحة الوسطى */
            padding-left: 10px;
            text-align: left;
        }

        .player-position {
            width: 100px;
            text-align: right;
            font-weight: bold;
            color: #555;
        }
    </style>
</head>

<body>
    <h1>المباريات المباشرة</h1>
    <?php
include 'connect.php';
$select_live = $conn->prepare("SELECT * FROM `matches` LIMIT 1");
$select_live->execute();
if($select_live->rowCount() > 0) {
    while($fetch_live = $select_live->fetch(PDO::FETCH_ASSOC)) {
?>
    <div class="live-video">
        <iframe width="640" height="360" src="https://www.youtube.com/embed/<?= $link; ?>" frameborder="0"
            allowfullscreen></iframe>

        <div class="title">من الفريق الذي سيحقق الفوز؟</div>
        <div class="prediction">
            <select id="team-prediction">
                <option value="">اختر فريقًا</option>
                <option value="team1"><?= $fetch_live['my_team'];?></option>
                <option value="team2"><?= $fetch_live['opponent_team'];?></option>
            </select>
            <div class="share-buttons">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.youtube.com/watch?v=<?= urlencode($link); ?>" target="_blank"
                    class="share-button facebook">مشاركة على فيسبوك</a>
                <a href="https://twitter.com/intent/tweet?url=رابط_المباراة&text=نص_التغريدة" target="_blank"
                    class="share-button twitter">مشاركة على تويتر</a>
                <a href="https://wa.me/?text=شاهد مباراة ESD ضد Chelsea: رابط_المباراة" target="_blank"
                    class="share-button whatsapp">مشاركة على واتساب</a>
                <a href="https://telegram.me/share/url?url=رابط_المباراة&text=شاهد مباراة ESD ضد Chelsea"
                    target="_blank" class="share-button telegram">مشاركة على تيليجرام</a>
            </div>

        </div>

    </div>
    <div class="match-body">
        <!-- فريق 1 -->
        <div class="team-section">
            <div class="team">
                <img src="img/esd.jpg" alt="Team 1 Logo" class="team-logo">
                <div class="team-name"><?= $fetch_live['opponent_team'];?></div>
            </div>
            <div class="players-section">
                <h4>Players <?= $fetch_live['opponent_team'];?></h4>
                <ul class="team1-players">
                <?php  $select_player = $conn->prepare("SELECT * FROM `players` WHERE category = 'U17' AND titulaire = 1 AND club = 'MCA'");
$select_player->execute();
if($select_player->rowCount() > 0) {
    while($fetch_player = $select_player->fetch(PDO::FETCH_ASSOC)) {
        $i = 1;
?>
    <li><span class="player-number"><?= $i ?></span><span class="player-name"><?= $fetch_player['ferstname']; ?> <?= $fetch_player['lastname']; ?></span><span class="player-position"><?= $fetch_player['place']; ?></span></li>
    <?php 
    $i++;
}} ?>
</ul>

            </div>
            <div class="cards-section">
                <h4>Cartons jaunes</h4>
                <ul class="yellow-cards team1-yellow-cards">
                     <li><span class="player-number"></span><span class="player-time"></span></li>
                </ul>
                <h4>Cartons rouges</h4>
                <ul class="red-cards team1-red-cards">
                     <li><span class="player-number">Soufiane Hammadi   </span><span class="player-time">A 15m</span></li>
                </ul>
            </div>
        </div>

        <!-- النتيجة -->
        <div class="match-score"><?= $fetch_live['opponent_scor'];?> - <?= $fetch_live['my_scor'];?></div>

        <!-- فريق 2 -->
        <div class="team-section">
            <div class="team">
                <img src="img/esd.jpg" alt="Team 2 Logo" class="team-logo">
                <div class="team-name"><?= $fetch_live['my_team'];?></div>
            </div>
            <div class="players-section">
                <h4>Players <?= $fetch_live['my_team'];?></h4>
                       <ul class="team2-players">
                       <?php  $select_player = $conn->prepare("SELECT * FROM `players` WHERE category = 'U17' AND titulaire = 1 AND club = 'ESD'");
$select_player->execute();
if($select_player->rowCount() > 0) {
    while($fetch_player = $select_player->fetch(PDO::FETCH_ASSOC)) {
        $i = 1;
?>
    <li><span class="player-number"><?= $i ?></span><span class="player-name"><?= $fetch_player['ferstname']; ?> <?= $fetch_player['lastname']; ?></span><span class="player-position"><?= $fetch_player['place']; ?></span></li>
    <?php 
    $i++;
}} ?>
</ul>
            </div>
            <div class="cards-section">
                <h4>Cartons jaunes</h4>
                <ul class="yellow-cards team2-yellow-cards">
                                          <?php  $select_player = $conn->prepare("SELECT * FROM `player_cards`");
$select_player->execute();
if($select_player->rowCount() > 0) {
    while($fetch_player = $select_player->fetch(PDO::FETCH_ASSOC)) {
?>
                     <li><span class="player-number"><?= $fetch_player['player_id']; ?></span><span class="player-time">A <?= $fetch_player['card_time']; ?></span></li>

                     <?php 
}} ?>
                </ul>
                <h4>Cartons rouges</h4>
                <ul class="red-cards team2-red-cards">
                                          <?php  $select_player = $conn->prepare(
                                            "SELECT * 
                                            FROM `player_cards`
                                            JOIN players p ON player_cards.player_id = p.player_id 
                                            ");
$select_player->execute();
if($select_player->rowCount() > 0) {
    while($fetch_player = $select_player->fetch(PDO::FETCH_ASSOC)) {
?>
                     <li><span class="player-number"><?= $fetch_player['ferstname']; ?> <?= $fetch_player['lastname']; ?> </span><span class="player-time">A <?= $fetch_player['card_time']; ?></span></li>
                     <?php 
}} ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- تفاصيل المباراة -->
    <div class="match-details">
        <p class="match-time"><?= $fetch_live['time'];?> - الحكم: <span class="referee"><?= $fetch_live['referee'];?> AND <?= $fetch_live['refere'];?></span></p>
        <p class="location">الموقع: <span class="location-name"><?= $fetch_live['location'];?></span></p>
    </div>
    <?php }} ?>
    <div id="live-matches-container">
        <!-- المباريات المباشرة ستظهر هنا -->
    </div>

   <script>
        matchCard.innerHTML = `
    <div class="match-body">
        ...
    </div>
    <div class="share-buttons">
        <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(matchLink)}" target="_blank" class="share-button facebook">مشاركة على فيسبوك</a>
        <a href="https://twitter.com/intent/tweet?url=${encodeURIComponent(matchLink)}&text=شاهد مباراة ${match.team1} ضد ${match.team2}" target="_blank" class="share-button twitter">مشاركة على تويتر</a>
        <a href="https://wa.me/?text=شاهد مباراة ${match.team1} ضد ${match.team2}: ${encodeURIComponent(matchLink)}" target="_blank" class="share-button whatsapp">مشاركة على واتساب</a>
        <a href="https://telegram.me/share/url?url=${encodeURIComponent(matchLink)}&text=شاهد مباراة ${match.team1} ضد ${match.team2}" target="_blank" class="share-button telegram">مشاركة على تيليجرام</a>
    </div>
`;

    </script>
</body>

</html>