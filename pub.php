
<?php
// Database connection
$host = 'localhost';
$db = 'esd';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Fetch ads from the database
$stmt = $pdo->query("SELECT * FROM ads ");
$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
    .ads-pub {
        width: 250px;
        margin: 20px;
        border-radius: 10px;
        position: fixed;
        top: 25%;
        right: 0;
        z-index: 1000;
        overflow: hidden;
    }

    @keyframes slideIn {
        from {
            transform: translateX(300px); /* ابدأ من خارج الشاشة */
            opacity: 0;
        }
        to {
            transform: translateX(0); /* إلى الموضع الطبيعي */
            opacity: 1;
        }
    }

    .ad-card {
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 5px;
        background: #fff;
        opacity: 0; 
        animation: slideIn 1s ease-out forwards;
    }

    /* إضافة تأخير تدريجي لكل إعلان */
    .ad-card:nth-child(1) {
        animation-delay: 10s;
    }

    .ad-card:nth-child(2) {
        animation-delay: 20s;
    }

    .ad-card:nth-child(3) {
        animation-delay: 1.5s;
    }

    .ad-card:nth-child(4) {
        animation-delay: 2s;
    }

    .ad-card:nth-child(5) {
        animation-delay: 2.5s;
    }

    .image-pub img {
        width: 100%;
        height: 147px;
        object-fit: cover;
        border-radius: 5px;
    }

    .ad-title {
        font-size: 20px;
        color: #2980b9;
        margin: 0 0 10px;
    }

    .ad-card p {
        font-size: 14px;
        color: #666;
        margin: 0;
    }

    .ad-card .price {
        font-size: 18px;
        color: #e74c3c;
        font-weight: bold;
    }

    .ad-card .date {
        font-size: 12px;
        color: #95a5a6;
    }
</style>

</head>
<main>

    <div class="ads-pub">
        <?php foreach ($ads as $ad): ?>
            <article class="ad-card">
                <div class="text-pub">
                    <header>
                        <h2 class="ad-title"><?php echo htmlspecialchars($ad['title']); ?></h2>
                    </header>
                </div>
                <div class="image-pub">
                    <img src="img/ads/<?php echo htmlspecialchars($ad['img']); ?>" alt="الإعلان" class="ad-image">
                </div>
                <p class="price"><?php echo htmlspecialchars($ad['object']); ?></p>
                <p class="date"><?php echo htmlspecialchars($ad['date']); ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</main>

<script>
    window.addEventListener('load', function () {
        setTimeout(function() {
            document.querySelector('.ads-pub').classList.add('active');
        }, 9000); 
    });
</script>
