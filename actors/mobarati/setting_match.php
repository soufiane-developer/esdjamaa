<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معلومات الفريقين</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            direction: rtl;
        }
        .team {
            display: inline-block;
            width: 40%;
            margin: 20px;
            border: 2px solid #000;
            padding: 20px;
            border-radius: 10px;
        }
        .team h2 {
            margin-bottom: 10px;
        }
        .score {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .actions {
            margin-top: 15px;
        }
        .actions button {
            padding: 10px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .red-card {
            background-color: red;
            color: white;
        }
        .yellow-card {
            background-color: yellow;
            color: black;
        }
        .player-name {
            margin-top: 10px;
        }
        #playerName-team1, #playerName-team2{
            padding: 11px;
            width: 94%;
        }

@media (max-width: 768px) {
    .team {
    width: 100%;
}
}
    </style>
</head>
<body>

    <h1>معلومات الفريقين</h1>

    <div class="team" id="team1">
        <h2>الفريق الأول</h2>
        <div class="score" id="score1">0</div>
        <div class="actions">
            <button onclick="increaseScore('team1')">+1 هدف</button>
            <button onclick="decreaseScore('team1')">-1 هدف</button>
            <div class="player-name">
                <input type="text" id="playerName-team1" placeholder="اسم اللاعب">
            </div>
            <button class="yellow-card" onclick="addYellowCard('team1')">إضافة بطاقة صفراء</button>
            <button class="red-card" onclick="addRedCard('team1')">إضافة بطاقة حمراء</button>
        </div>
        <div id="cards-team1"></div>
    </div>

    <div class="team" id="team2">
        <h2>الفريق الثاني</h2>
        <div class="score" id="score2">0</div>
        <div class="actions">
            <button onclick="increaseScore('team2')">+1 هدف</button>
            <button onclick="decreaseScore('team2')">-1 هدف</button>
            <div class="player-name">
                <input type="text" id="playerName-team2" placeholder="اسم اللاعب">
            </div>
            <button class="yellow-card" onclick="addYellowCard('team2')">إضافة بطاقة صفراء</button>
            <button class="red-card" onclick="addRedCard('team2')">إضافة بطاقة حمراء</button>
        </div>
        <div id="cards-team2"></div>
    </div>

    <script>
        function increaseScore(teamId) {
    const scoreElement = document.getElementById(`score${teamId.slice(-1)}`);
    let score = parseInt(scoreElement.textContent);
    scoreElement.textContent = score + 1;


    sendScoreToServer(teamId, score + 1);
}

function decreaseScore(teamId) {
    const scoreElement = document.getElementById(`score${teamId.slice(-1)}`);
    let score = parseInt(scoreElement.textContent);
    if (score > 0) {
        scoreElement.textContent = score - 1;
        sendScoreToServer(teamId, score - 1);
    }
}

function sendScoreToServer(teamId, score) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_score.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`teamId=${teamId}&score=${score}`);
}

function addYellowCard(teamId) {
    const playerName = document.getElementById(`playerName-${teamId}`).value;
    if (playerName.trim() !== "") {
        const cardsElement = document.getElementById(`cards-${teamId}`);
        const yellowCard = document.createElement('div');
        yellowCard.textContent = `بطاقة صفراء - ${playerName}`;
        yellowCard.className = 'yellow-card';
        cardsElement.appendChild(yellowCard);


        sendCardToServer(teamId, playerName, 'yellow');
    } else {
        alert('الرجاء إدخال اسم اللاعب');
    }
}

function addRedCard(teamId) {
    const playerName = document.getElementById(`playerName-${teamId}`).value;
    if (playerName.trim() !== "") {
        const cardsElement = document.getElementById(`cards-${teamId}`);
        const redCard = document.createElement('div');
        redCard.textContent = `بطاقة حمراء - ${playerName}`;
        redCard.className = 'red-card';
        cardsElement.appendChild(redCard);


        sendCardToServer(teamId, playerName, 'red');
    } else {
        alert('الرجاء إدخال اسم اللاعب');
    }
}

function sendCardToServer(teamId, playerName, cardType) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_card.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`teamId=${teamId}&playerName=${playerName}&cardType=${cardType}`);
}

    </script>

</body>
</html>
