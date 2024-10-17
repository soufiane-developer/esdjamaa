<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <title>Team Members</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, rgba(238, 249, 255, 1) 0%, rgba(251, 251, 251, 1) 0%, rgba(215, 240, 246, 1) 37%, rgba(202, 243, 255, 1) 56%, rgba(93, 221, 247, 1) 100%);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .team {
            display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 200px 0;
    gap: 62px 12px;
        }
        .list_titel{
            background-color: aliceblue;
    width: 50%;
    position: absolute;
    top: 62px;
    color: #6dc4dd;
    text-align: center;
    padding: 15px;
    border-radius: .5rem;
    font-size: x-large;
        }

        .member {
            background-color: #1f1f1f;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            width: 250px;
            margin: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 1s forwards;
        }

        .member:nth-child(1) {
            animation-delay: 0.2s;
        }

        .member:nth-child(2) {
            animation-delay: 0.4s;
        }

        .member:nth-child(3) {
            animation-delay: 0.6s;
        }

        .member:nth-child(4) {
            animation-delay: 0.8s;
        }

        .member:nth-child(5) {
            animation-delay: 1s;
        }

        .member:nth-child(6) {
            animation-delay: 1.2s;
        }

        .member:nth-child(7) {
            animation-delay: 1.4s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-pic {
            width: 150px;
            height: 175px;
            object-fit: contain;
            position: absolute;
            top: -85px;
            left: 50%;
            transform: translateX(-50%);
            transition: transform 0.3s ease;
        }

        .profile-pic:hover {
            transform: translateX(-50%) scale(1.1);
        }

        .member h2 {
            color: #ffc107;
            margin-top: 80px;
        }

        .member p {
            margin-bottom: 5px;
            color: #aaa;
        }

        .role {
            font-weight: bold;
            font-size: 1em;
            color: #eee;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            margin: 0 10px;
            color: #fff;
            font-size: 1.5em;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-icons a:hover {
            transform: scale(1.2);
        }

        .fa-facebook-f:hover {
            color: #0047ff;
        }

        .fa-twitter:hover {
            color: #477aff;
        }

        .fa-instagram:hover {
            color: #ff8500;
        }

        @media (max-width: 768px) {
            .team {
                flex-direction: column;
                align-items: center;
            }

            .member {
                width: 90%;
                margin: 20px 0;
            }
        }
     
    </style>
</head>
<body>
<div class="list_titel">
<h3>List Players</h3>
</div>
    <div class="team">
    <?php
                // جلب المنتجات من قاعدة البيانات
                $db = new PDO('mysql:host=localhost;dbname=esd', 'root', '');
                $stmt = $db->query('SELECT * FROM players');
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
        <div class="member">
            <img src="img/players/<?= $row['img'];?>" alt="Misha" class="profile-pic">
            <h2>"<?= $row['club'];?>"</h2>
            <p><?= $row['ferstname'];?> <?= $row['lastname'];?></p>
            <p class="role">Team Captain</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <?php
    }
    ?>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const members = document.querySelectorAll('.member');
    members.forEach((member, index) => {
        const delay = (index + 1) * 0.2; // Increase delay by 0.2s for each member
        member.style.animationDelay = `${delay}s`;
    });
});

</script>
</html>
