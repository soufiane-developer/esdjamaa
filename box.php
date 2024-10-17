<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
div.box {
    display: flex;
    flex-wrap: wrap; 
    padding: 10px;
    width: 98vw; 
    /* max-width: 1500px;  */
    box-sizing: border-box;
    text-align: center;
    align-items: center; 
    justify-content: center; 
    border-radius: 10px; 
}

.box-item {
    display: flex; 
    flex-direction: column; 
    align-items: center; 
    justify-content: center; 
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 5px;
    height: 20vh;
    width: calc(25% - 20px); 
    margin: 10px;
    box-sizing: border-box;
    border-bottom: 7px solid #007bff;
    transition: background-color 0.3s, border-color 0.3s;
}

.box-item:hover {
    background-color: #007bff;
    border-color: #007bff;
    cursor: pointer;
}

.box-item .icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: 1px solid #0359e2;
    width: 50px; 
    height: 50px; 
    margin-bottom: 10px; 
    transition: border 0.3s; 
}

.box-item:hover .icon-wrapper {
    border: none; 
}

i {
    font-size: 24px;
    color: #bbb;
}

h6 {
    margin: 0;
    font-size: 16px;
    color: #333;
}

@media (max-width: 600px) {
    .box-item {
        width: calc(50% - 20px); /
    }

    .box-item .icon-wrapper {
        margin-bottom: 5px; 
    }
}

</style>
<div class="box">
    <div class="box-item" id="likeSection">
        <div class="icon-wrapper"><i class="fa-solid fa-thumbs-up"></i></div>
        <h6>J'aime</h6>
    </div>

    <div class="box-item" id="navigateToAchievements">
        <div class="icon-wrapper"><i class="fas fa-medal"></i></div>
        <h6>Achievements</h6>
    </div>

    <div class="box-item" id="sportsSection">
        <div class="icon-wrapper"><i class="fa-solid fa-baseball"></i></div>
        <h6>juaer</h6>
    </div>

    <div class="box-item" id="managementSection">
        <div class="icon-wrapper"><i class="fa-solid fa-headset"></i></div>
        <h6>management</h6>
    </div>
</div>
<script>
    document.getElementById('likeSection').addEventListener('click', function() {
    window.location.href = 'like.php';
});

document.getElementById('navigateToAchievements').addEventListener('click', function() {
    window.location.href = 'achievements.php';
});

document.getElementById('sportsSection').addEventListener('click', function() {
    window.location.href = 'players_.php';
});

document.getElementById('managementSection').addEventListener('click', function() {
    window.location.href = 'management.php';
});

</script>