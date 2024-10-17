<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خزانة الإنجازات</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* تنسيق العنوان الرئيسي */
        header {
            width: 100%;
            text-align: center;
            background-color: #333;
            padding: 20px;
            margin-bottom: 40px;
            color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            margin: 0;
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        /* تصميم الخزانة العامة */
        .cabinet {
            width: 100%;
            max-width: 1000px;
            background-color: #fff;
            border: 3px solid #ccc;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            padding: 30px;
            position: relative;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .cabinet:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .cabinet h1 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 30px;
        }

        /* تنسيق الرفوف */
        .shelf {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        /* تنسيق الإنجازات */
        .achievement {
            flex: 1;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .achievement:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            border-color: #333;
        }

        .achievement img {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            border-radius: 50%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .achievement:hover img {
            transform: scale(1.15);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .achievement .title {
            font-size: 18px;
            color: #555;
            margin-bottom: 8px;
        }

        .achievement .date {
            font-size: 14px;
            color: #888;
        }

        /* ألوان خاصة لكل قسم */
        .cabinet.republic h1 {
            color: #8b5a2b;
        }

        .cabinet.turn h1 {
            color: #2b5a8b;
        }

        .cabinet.state h1 {
            color: #5a8b2b;
        }

        /* تصميم شريط علوي */
        .cabinet::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 5px;
            background-color: #333;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    <!-- العنوان الرئيسي في أعلى الصفحة -->
    <header>
        <h1>خزانة الإنجازات</h1>
    </header>


    <div class="cabinet republic">
        <h1>Republic Cup</h1>
        <div class="shelf">
            <div class="achievement">
                <img src="img/cups/cups1.png" alt="تتويج 1">
                <p class="title">التتويج الأول</p>
                <p class="date">تاريخ: يناير 2023</p>
            </div>
            <div class="achievement">
                <img src="img/cups/cups2.png" alt="تتويج 2">
                <p class="title">التتويج الثاني</p>
                <p class="date">تاريخ: يونيو 2023</p>
            </div>
        </div>
    </div>

    <div class="cabinet turn">
        <h1>Turn</h1>
        <div class="shelf">
            <div class="achievement">
                <img src="img/cups/cups1.png" alt="إنجاز 1">
                <p class="title">الإنجاز الأول</p>
                <p class="date">تاريخ: مارس 2024</p>
            </div>
            <div class="achievement">
                <img src="img/cups/cups1.png" alt="إنجاز 2">
                <p class="title">الإنجاز الثاني</p>
                <p class="date">تاريخ: سبتمبر 2024</p>
            </div>
        </div>
    </div>

    <div class="cabinet state">
        <h1>State Cup</h1>
        <div class="shelf">
            <div class="achievement">
                <img src="img/cups/cups1.png" alt="إنجاز 1">
                <p class="title">الإنجاز الأول</p>
                <p class="date">تاريخ: مارس 2024</p>
            </div>
            <div class="achievement">
                <img src="img/cups/cups1.png" alt="إنجاز 2">
                <p class="title">الإنجاز الثاني</p>
                <p class="date">تاريخ: سبتمبر 2024</p>
            </div>
        </div>
    </div>

</body>

</html>