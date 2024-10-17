<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المباريات</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <style>
body {
    font-family: 'Cairo', sans-serif;
    direction: rtl;
    background-color: #f0f4f8;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    color: #333;
}

.container {
    width: 90%;
    margin: 0 auto;
    padding: 30px;
}

h1 {
    text-align: center;
    font-size: 36px;
    color: #007bff;
    margin-bottom: 40px;
    letter-spacing: 1.5px;
}

.match-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    margin-bottom: 30px;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
}

.match-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.team {
    width: 150px;
    text-align: center;
}

.team img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid #007bff;
    transition: border-color 0.3s ease;
}

.team img:hover {
    border-color: #28a745;
}

.team h2 {
    font-size: 20px;
    margin-top: 10px;
    color: #333;
    transition: color 0.3s ease;
}

.team h2:hover {
    color: #28a745;
}

.match-details {
    text-align: center;
    flex-grow: 1;
    padding: 0 20px;
}

.match-details h2 {
    font-size: 28px;
    margin: 10px 0;
    color: #28a745;
    font-weight: bold;
}

.match-details h3 {
    font-size: 18px;
    color: #555;
    margin-bottom: 10px;
    font-weight: bold;
}

.match-details p {
    font-size: 16px;
    color: #666;
    margin-bottom: 10px;
}

.match-details a {
    display: inline-block;
    padding: 10px 25px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.match-details a:hover {
    background-color: #0056b3;
}

/* تصميم خاص للمباراة التي تقام الآن */
.match-card.live {
    background: linear-gradient(135deg, #ffeb3b, #ff9800);
    border-left: 8px solid #d32f2f;
}

.match-card.live h3 {
    color: #d32f2f;
    font-size: 20px;
    font-weight: bold;
}

/* تصميم خاص للمباراة القريبة */
.match-card.upcoming {
    background: linear-gradient(135deg, #e3f2fd, #2196f3);
    border-left: 8px solid #2196f3;
}

.match-card.upcoming h3 {
    color: #1565c0;
    font-weight: bold;
}

/* التأثيرات عند مرور الفأرة */
.match-card.upcoming:hover, .match-card.live:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.match-card.upcoming:hover .match-details h3, 
.match-card.live:hover .match-details h3 {
    color: #ffffff;
}

.match-card.upcoming:hover .team img, 
.match-card.live:hover .team img {
    border-color: #ffffff;
}

/* تصميم خاص للمباراة التي انتهت */
.match-card.finished {
    background-color: #f0f0f0; /* لون رمادي خفيف */
    border-left: 8px solid #9e9e9e; /* شريط جانبي رمادي */
    filter: grayscale(100%); /* تحويل الصور إلى درجات الرمادي */
}

.match-card.finished h3, .match-card.finished h2 {
    color: #757575; /* لون رمادي للنص */
}

.match-card.finished p {
    color: #9e9e9e; /* لون أخف للشرح */
}

.match-card.finished a {
    background-color: #bdbdbd; /* لون زر رمادي */
    color: white;
    cursor: not-allowed; /* يظهر أن الرابط غير نشط */
}

.match-card.finished a:hover {
    background-color: #9e9e9e; /* لا تتغير عند المرور */
}


@media (max-width: 768px) {
    .match-card {
        flex-direction: column;
        text-align: center;
    }

    .match-details {
        padding: 20px 0;
    }

    .team {
        width: 100%;
        margin-bottom: 20px;
    }
}


    </style>
</head>
<body>
<!-- <?php include 'header.php'; ?> -->

    <div class="container">
        <h1>المباريات</h1>

        <div class="match-card live" data-datetime="2024-09-18T14:00">
            <div class="team team1">
                <img src="img/esd.jpg" alt="فريق 3">
                <h2>فريق 3</h2>
            </div>
            
            <div class="match-details">
                <h3>الآن</h3> <!-- سيتم تمييز المباراة الآن -->
                <h2>0 - 0</h2>
                <p>المباراة جارية الآن</p>
                <a href="view_matche.php">عرض تفاصيل المباراة</a>
            </div>

            <div class="team team2">
                <img src="img/esd.jpg" alt="فريق 4">
                <h2>فريق 4</h2>
            </div>
        </div>
        
        <div class="match-card upcoming" data-datetime="2024-09-19T15:00">
            <div class="team team1">
                <img src="img/esd.jpg" alt="فريق 1">
                <h2>فريق 1</h2>
            </div>
            
            <div class="match-details">
                <h3>15:00</h3> <!-- سيعرض الوقت بدل التاريخ -->
                <h2>لم تبدأ بعد</h2>
                <p>مباراة حماسية قريب موعدها</p>
                <a href="#">عرض تفاصيل المباراة</a>
            </div>

            <div class="team team2">
                <img src="img/esd.jpg" alt="فريق 2">
                <h2>فريق 2</h2>
            </div>
        </div>

        <div class="match-card finished" data-datetime="2024-09-19T15:00">
    <div class="team team1">
        <img src="img/esd.jpg" alt="فريق 1">
        <h2>فريق 1</h2>
    </div>
    
    <div class="match-details">
        <h3></h3>
        <h2>انتهت</h2>
        <h2>21 - 32</h2>
        <p>مباراة فات موعدها</p>
        <a href="#">عرض تفاصيل المباراة</a>
    </div>

    <div class="team team2">
        <img src="img/esd.jpg" alt="فريق 2">
        <h2>فريق 2</h2>
    </div>
</div>
    </div>

    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const matchCards = document.querySelectorAll('.match-card');

    matchCards.forEach(card => {
        const matchDateTime = new Date(card.dataset.datetime);
        const now = new Date();

        // إذا كانت المباراة الآن
        if (now >= matchDateTime && now <= new Date(matchDateTime.getTime() + 2 * 60 * 60 * 1000)) {
            card.classList.add('live');
            card.querySelector('h3').innerText = 'الآن';
        } 
        // إذا كانت المباراة اليوم
        else if (now.toDateString() === matchDateTime.toDateString()) {
            card.classList.add('upcoming');
            card.querySelector('h3').innerText = matchDateTime.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
        }
    });
});

    </script>
</body>
</html>
