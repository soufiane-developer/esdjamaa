<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض اللاعبين</title>
<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f2f5;
    transition: background-color 0.5s ease-in-out;
}

header {
    background-color: #007bff;
    color: #fff;
    padding: 1rem;
    text-align: center;
    border-bottom: 5px solid #b8cce0;
    transition: background-color 0.3s ease;
}

main {
    padding: 2rem;
    opacity: 0;
    animation: fadeIn 1s forwards; /* تأثير عند تحميل الصفحة */
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}

/* تحسين شبكة اللاعبين */
.player-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 1.5rem;
    justify-content: center;
}

/* تأثيرات على بطاقات اللاعبين */
.player-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    align-items: center;
    padding: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 100%;
    max-width: 400px;
    margin: auto;
}

.player-card:hover {
    transform: translateY(-10px); /* تحريك البطاقة للأعلى قليلاً */
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); /* زيادة الظل */
    cursor: pointer;
}

.player-card img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 1rem;
    transition: transform 0.3s ease, border 0.3s ease;
}

.player-card:hover img {
    transform: scale(1.1); /* تكبير الصورة قليلاً عند مرور الفأرة */
    border: 2px solid #007bff; /* إضافة إطار للصورة */
}

.player-card-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.player-card-content h2 {
    font-size: 1.4rem;
    margin: 0 0 0.5rem 0;
    color: #333;
    transition: color 0.3s ease;
}

.player-card-content p {
    margin: 0.25rem 0;
    color: #555;
}

.player-card-content a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease, text-decoration 0.3s ease;
}

.player-card-content a:hover {
    color: #0056b3;
    text-decoration: underline;
}

/* تحسين الفوتر */
footer {
    background-color: #007bff;
    color: #fff;
    text-align: center;
    padding: 1rem;
    position: relative;
    bottom: 0;
    width: 100%;
    margin-top: 2rem;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* إضافة ظل للفوتر */
    transition: background-color 0.3s ease;
}

footer:hover {
    background-color: #0056b3; /* تغيير لون الفوتر عند مرور الفأرة */
}

    </style>
</head>
<body>
    <header>
        <h1>عرض اللاعبين</h1>
    </header>
    <main>
        <section class="player-list">
        <?php
            include 'connect.php';
            $players = $conn->prepare("SELECT * FROM `players`");
            $players->execute();
            if($players->rowCount() > 0){
              while($fetch_players = $players->fetch(PDO::FETCH_ASSOC)){
         ?>
            <article class="player-card">
                <img src="img/profile/<?= $fetch_players['img'] ?>" alt="اللاعب 1">
                <div class="player-card-content">
                    <h2><?= $fetch_players['farstname']. ' ' . $fetch_players['lastname'] ?></h2>
                    <p>Post: <?= $fetch_players['place'] ?></p>
                    <p>Club: <?= $fetch_players['club'] ?></p>
                    <p>Category: <?= $fetch_players['category'] ?></p>
                    <p>Coach: <?= $fetch_players['coach'] ?></p>
                    <p><a href="mailto:<?= $fetch_players['email'] ?>"><?= $fetch_players['email'] ?></a></p>
                </div>
            </article>
            <?php }} ?>
        </section>
    </main>
    <footer>
        <p>جميع الحقوق محفوظة &copy; 2024</p>
    </footer>
</body>
</html>
