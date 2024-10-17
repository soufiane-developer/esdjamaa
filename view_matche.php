<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مشاهدة المباريات - نادي كرة اليد</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    text-align: center;
    margin: 0;
}

header {
    background-color: #006699;
    color: #fff;
    padding: 20px;
}

h1 {
    margin: 0;
    font-size: 2em;
}

p {
    font-size: 1.2em;
}

section {
    padding: 20px;
}

h2 {
    font-size: 1.8em;
    margin-bottom: 10px;
}

.stream-box iframe, .highlight-box iframe {
    width: 100%;
    height: 400px;
    max-width: 800px;
}

.highlight-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.highlight-box {
    background-color: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

footer {
    background-color: #006699;
    color: #fff;
    padding: 10px;
    margin-top: 20px;
}

    </style>
</head>
<body>
    <header>
        <h1>مشاهدة المباريات المباشرة</h1>
        <p>تابع مباريات فريقنا مباشرة أو شاهد ملخصات المباريات السابقة</p>
    </header>

    <section class="live-stream">
        <h2>المباريات المباشرة</h2>
        <div class="stream-box">
            <!-- يمكنك تضمين رابط البث المباشر هنا -->
            <iframe src="https://www.youtube.com/embed/البث_المباشر" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    </section>

    <section class="match-highlights">
        <h2>ملخصات المباريات السابقة</h2>
        <div class="highlight-grid">
            <!-- يمكنك تكرار هذا العنصر لكل مباراة -->
            <div class="highlight-box">
                <h3>اسم المباراة</h3>
                <iframe src="https://www.youtube.com/embed/رابط_الملخص" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <p>ملخص المباراة - تاريخ المباراة</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; نادي كرة اليد - جميع الحقوق محفوظة</p>
    </footer>
</body>
</html>
