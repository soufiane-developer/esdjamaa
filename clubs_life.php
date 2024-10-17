<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(90deg, rgba(238, 249, 255, 1) 0%, rgba(251, 251, 251, 1) 0%, rgba(215, 240, 246, 1) 37%, rgba(202, 243, 255, 1) 56%, rgba(93, 221, 247, 1) 100%);
        }

        .container {
            /* width: 80%; */
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
            padding: 20px;
        }

        header {
            grid-column: 1 / span 2;
            background: #004080;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
            border-bottom: #92f3ff 3px solid;
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        .img_info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            grid-gap: 20px;
        }

        .img_info img {
            width: 100%;
            border-radius: 0.7rem;
            transition: .5s width ;
        }

        .image_3{
            position: relative;
            top: -60px;
        }
        .image_2{
            margin: 15% 0;
        }

        .img_info img:hover {
            width: 98%;
        }

        .club-info {
            padding: 20px;
            /* background-color: #f4f4f4; */
            border-radius: 10px;
            text-align: center;
        }

        .club-info h2 {
            color: #35424a;
            margin-bottom: 15px;
        }

        .club-info p {
            color: #333;
            line-height: 1.6;
            text-align: right;
        }

        .events {
            grid-column: 1 / span 2;
            margin-top: 40px;
            text-align: center;
        }

        .events h2 {
            color: #35424a;
        }

        .events ul {
            list-style-type: none;
            padding: 0;
        }

        .events ul li {
            background: #004080;
            color: white;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
    <title>حياة النادي</title>
</head>
<body>

<div class="container">
    <header>
        <h1>حياة النادي</h1>
    </header>
    
    <div class="img_info">
        <img src="img/ads/img1.jpg" alt="Image 1">
        <img src="img/ads/img2.jpg" alt="Image 2" class="image_2">
        <img src="img/ads/img2.jpg" alt="Image 4" class="image_2">
        <img src="img/ads/img1.jpg" alt="Image 3" class="image_3">
    </div>

    <section class="club-info">
        <h2>نبذة عن النادي</h2>
        <p>نادي الرياضة يقدم العديد من الأنشطة الرياضية والترفيهية التي تهدف إلى تعزيز صحة الجسم والعقل. النادي مجهز بأحدث الأجهزة ويقدم برامج تدريبية مخصصة لكل الأعمار.</p>
    </section>

    <section class="events">
        <h2>الفعاليات القادمة</h2>
        <ul>
            <li>بطولة كرة اليد - 15 أكتوبر 2024</li>
            <li>سباق الماراثون - 22 نوفمبر 2024</li>
            <li>يوم الصحة العالمي - 10 ديسمبر 2024</li>
        </ul>
    </section>
</div>

</body>
</html>
