<?php session_start(); ?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>
<!DOCTYPE html> -->
 <html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
        <script src="https://kit.fontawesome.com/82d8a31c77.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Entante Djamaa</title>
        <link rel="stylesheet" href="style.css">

    </head>
    <style>
        .container .landingPage .ESD_text p{position: absolute;
  width: 50%;
  height: 106px;

  margin-top: 150px;
  justify-content: space-between;
 


  
  font-family: 'Inter';
  font-style: normal;
  font-weight: 400;
  font-size: 24px;
  line-height: 25px;  /* between line*/
  
  color: #000000;
  
  mix-blend-mode: normal;}

/* خصائص الصور */
.trophy_img img {
    cursor: pointer;
    transition: transform 0.3s ease;
}

.trophy_img img:hover {
    transform: scale(1.1);
}

/* خصائص النص والحركات */
.trophy_description_text {
    opacity: 1;
    transform: translateY(0);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

/* عند الانتقال: اخفاء النص */
.fade-out {
    opacity: 0;
    transform: translateY(20px);
}

/* عند إظهار النص */
.fade-in {
    opacity: 1;
    transform: translateY(0);
}

.container .historique .trophy_description .trophy_description_text p, .trophy_description_text h2{
  position: absolute;
height: 300px;
font-size: 20px;
display: block;
margin: 15% 0 4% 0;
letter-spacing: 2px;
width: 100%;

}
.trophy_description_text h2{
position: absolute;
    height: 56px;
    margin-top: 3%;
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-size: 34px;
    line-height: 41px;
    color: #000000;
    text-transform: capitalize;
    text-align: center;
}
    </style>
<body>
<?php
include 'test.php';
include ('match.php');
include ('pub.php');

?>
<div class="historique">
    <div class="trophy_img_content">
        <div class="trophy_img">
            <img src="./img/news/news2.jpg" alt="" onclick="changeText(1)">
            <img src="./img/esd.png" alt="" onclick="changeText(2)">
            <img src="./IMG/esd.png" alt="" onclick="changeText(3)">
        </div>
    </div>

    <div class="trophy_description">
        <div class="trophy_description_text" id="description">
            <h2>Historique</h2>
            <p>تظهر أخبار النادي في هاذا الجزء</p>
        </div>
    </div>
</div>

<?php
// include ('header.php');
// include ('body.php');
include ('footer.php');
?>
</body>
</html> 
<script src="../js/index.js"></script>
<script>
function changeText(index) {
    const description = document.getElementById("description");
    const texts = [
        "انطلاق الحصص التدريبية للفئات الصغرى (أطفال ،أصاغر ،أشبال) يوم الثلاثاء الموافق ل15 أكتوبر 2024 على الساعة 17:30 الخامسة و النصف مساءاً و هذا بالقاعة المتعددة الرياضات بجامعة ",
        "021 — Consider Particles in space by Dean Wagman...",
        "022 — CSS only particle system..."
    ];

    // إزالة الكلاسات القديمة لتهيئة الحركة
    description.classList.remove('fade-in', 'fade-out');

    // إضافة تأثير الانتقال للخروج
    description.classList.add('fade-out');

    // تغيير النص بعد انتهاء حركة الخروج
    setTimeout(() => {
        description.querySelector('p').textContent = texts[index - 1];

        // إزالة fade-out و إضافة fade-in
        description.classList.remove('fade-out');
        description.classList.add('fade-in');
    }, 500); // يتم الانتظار ليتناسب مع مدة الانتقال في الـ CSS
}


</script>