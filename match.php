
<style>
.match-card {
    width: 95%%;
    margin: 35px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
    font-family: 'Arial', sans-serif;
}

.match-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 2px solid #eee;
    font-size: 1.2em;
    font-weight: bold;
    color: #333;
}

.match-header .live {
    background-color: #a07b7b; /**#ff4d4d*/
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
}

.match-header .league {
    font-size: 1em;
    color: #555;
    align-items: center;
    display: flex;
    margin-right: 7%;
}

.match-header i:hover{
    color: red;
}

.match-body {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 20px 0;
}

.team {
    text-align: center;
}

.team img {
    width: 80px;
    height: 80px;
}

.team-name {
    margin-top: 10px;
    font-size: 1.2em;
    font-weight: bold;
}

.match-score {
    font-size: 3em;
    font-weight: bold;
    color: #333;
}

.match-details {
    font-size: 1.1em;
    margin-top: 10px;
    color: #777;
}
.location{
    color:red;
}
.live_match{
    padding: 10px;
    background-color: red;
    margin: 16px auto;
    text-decoration: none;
    border-radius: 1.5rem;
    width: 30%;
    text-align: center;
    display: flex;
    justify-content: center;
}
.live_match:hover{
   opacity: .5;
}
.live_match a{
    text-decoration: none;
}
/* .match-score{
     animation: blink 1s infinite; 
}
@keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0; }
    100% { opacity: 1; }
} */

</style>
<?php
include 'connect.php';
$select_matches = $conn->prepare("SELECT * FROM `matches` LIMIT 1");
$select_matches->execute();
if($select_matches->rowCount() > 0) {
    while($fetch_matches = $select_matches->fetch(PDO::FETCH_ASSOC)) {
        $match_time = $fetch_matches['time'];
        $match_date = $fetch_matches['date']; // Match date
        $match_duration = 90; // Match duration in minutes (can be adjusted)
        
        // Combine date and time
        $match_start = strtotime("$match_date $match_time");
        $match_end = strtotime("+$match_duration minutes", $match_start);
        $current_time = time(); // Current time
        
        // Check if the current time is within the match duration
        $is_live = ($current_time >= $match_start && $current_time <= $match_end);
?>
<div class="match-card">
    <div class="match-header">
        <?php if ($is_live): ?>
            <span class="live">Live</span>
        <?php endif; ?>
        <span class="league"><img src="img/esd.jpg" alt="League Logo" style="width: 25px;"><?= htmlspecialchars($fetch_matches['match_rank']); ?></span>
        <i class="fa-regular fa-star"></i>
    </div>
    <div class="match-body">
        <div class="team">
            <img src="img/match/<?= htmlspecialchars($fetch_matches['image']); ?>" alt="<?= htmlspecialchars($fetch_matches['opponent_team']); ?>">
            <div class="team-name"><?= htmlspecialchars($fetch_matches['opponent_team']); ?></div>
        </div>
        <div class="match-score" id="score"><?= htmlspecialchars($fetch_matches['opponent_scor']); ?> - <?= htmlspecialchars($fetch_matches['my_scor']); ?></div>
        <div class="team">
            <img src="img/match/<?= htmlspecialchars($fetch_matches['image_opponent']); ?>" alt="<?= htmlspecialchars($fetch_matches['my_team']); ?>">
            <div class="team-name"><?= htmlspecialchars($fetch_matches['my_team']); ?></div>
        </div>
    </div>
    <div class="match-details">
        <p id="match-time"><?= htmlspecialchars($fetch_matches['date']); ?> at <?= htmlspecialchars($match_time); ?></p>
        <p>Referee: <?= htmlspecialchars($fetch_matches['referee']); ?></p>
        <p class="location">Location: <?= htmlspecialchars($fetch_matches['location']); ?></p>
    </div>

    <a class="live_match" href="live.php" id="watch" >Live..</a>
</div>
<?php }} ?>


<script>
    // Define match date and time
    const matchDateTime = new Date('<?= htmlspecialchars($fetch_matches['date'] . ' ' . $match_time); ?>');

    const scoreElement = document.getElementById('score');
    const liveStatusElement = document.getElementById('live-status');
    const matchTimeElement = document.getElementById('match-time');
    const livewatchElement = document.getElementById('watch');

    function updateMatchStatus() {
        const currentDateTime = new Date(); // Get the current time

        if (currentDateTime >= matchDateTime && currentDateTime < new Date(matchDateTime.getTime() + 90 * 60000)) {
            scoreElement.textContent = 'جارية الأن'; 
            scoreElement.classList.add('blink');
            liveStatusElement.textContent = 'Live'; 
            liveStatusElement.style.backgroundColor = 'red';
        } else if (currentDateTime >= new Date(matchDateTime.getTime() + 90 * 60000)) {
            liveStatusElement.textContent = 'المباراة انتهت'; 
            livewatchElement.style.display = 'none';
        } else {
            liveStatusElement.textContent = 'مازالت';
            livewatchElement.style.display = 'none';
            matchTimeElement.textContent = `تاريخ: ${matchTimeElement.textContent}`; 
        }
    }

    setInterval(updateMatchStatus, 60000);
    updateMatchStatus(); 
</script>

