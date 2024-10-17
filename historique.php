<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خط زمني متعرج</title>
    <link rel="stylesheet" href="style.css">
    <style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f4f4f4;
}

.timeline {
    position: relative;
    margin: 55px auto; /* تم التعديل لجعلها تتمركز في الصفحة */
    padding: 0;
    max-width: 697px;
}

.timeline::before {
    content: '';
    position: absolute;
    width: 4px;
    background-color: rgb(105 224 248);
    top: 0;
    bottom: 0;
    left: 50%;
    margin-left: -2px;
}

.container {
    padding: 10px 40px;
    position: relative;
    width: 50%;
    opacity: 0; 
    transform: translateY(100px); 
    transition: all 0.6s ease-out; 
}

.container.left {
    left: 0;
}

.container.right {
    left: 50%;
}

/* .container::after {
    content: '';
    position: absolute;
    width: 25px;
    height: 25px;
    right: -12px;
    background-color: white;
    border: 4px solid rgb(105 224 248);
    top: 15px;
    border-radius: 50%;
    z-index: 1;
}

.container.right::after {
    left: -12px;
} */

.container::after {
    content: '';
    position: absolute;
    width: 25px;
    height: 25px;
    right: -16px;
    background-color: white;
    border: 4px solid rgb(105 224 248);
    top: 15px;
    border-radius: 50%;
    z-index: 1;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.container.right::after {
    left: -16px;
}

.container.show::after {
    background-color: rgb(0, 150, 136); /* تغيير لون الدائرة عند العرض */
    transform: scale(1.2); /* تكبير الدائرة عند التمرير */
}

.content {
    padding: 20px;
    background-color: white;
    position: relative;
    border-radius: 6px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); 
}

.content h2 {
    color: rgb(105 224 248);
    font-size: 24px;
}

.container.left .content {
    transform: translateX(-100%);
    transition: width 0.1s ease-out; 

}

.container.right .content {
    transform: translateX(100%);
    transition: width 0.1s ease-out; 

}

.container.right .content:hover, .container.left .content:hover {
    box-shadow: 3px 6px 39px rgb(105 224 248); 
    border: 1px solid rgb(105 224 248);
    transition: all 0.3s ease-in-out;
}

.container.show {
    opacity: 1;
    transform: translateY(0);
    margin-top: 50px;
}

@media screen and (max-width: 768px) {
    .container {
        width: 100%;
        left: 0;
    }

    .container.left .content,
    .container.right .content {
        transform: none; /* تم التعديل لإزالة التحولات */
    }

    .container::after {
        left: 50%;
        margin-left: -12px;
    }
}


    </style>
</head>
<body>
<?php include ('pub.php');?>

<div class="timeline">

<div class="container left">
        <div class="content">
            <h2>2016</h2>
            <p>تم تأسيس النادي لكرة اليد باسم الوفاق الرياضي جامعة (اسد) سنة 2016
            The handball club was established under the name of Al-Wifaq Sports Club (ESD) in the year 2016
            </p>
        </div>
    </div>
    <div class="container right">
        <div class="content">
            <h2>2017</h2>
            <p>رغم مامرة به النادي من عقبات الى انه تجاوزها في الأخير ليقدم النادي كل مالديه ولايخيب امال جمهوره
            Despite the obstacles the club went through, it overcame them in the end, so the club gave its all and did not disappoint its fans.
            </p>
        </div>
    </div>
    <div class="container left">
        <div class="content">
            <h2>2018</h2>
            <p>رغم مامرة به النادي من عقبات الى انه تجاوزها في الأخير ليقدم النادي كل مالديه ولايخيب امال جمهوره
            Despite the obstacles the club went through, it overcame them in the end, so the club gave its all and did not disappoint its fans.
            </p>
        </div>
    </div>
    <div class="container right">
        <div class="content">
            <h2>2019</h2>
            <p>رغم مامرة به النادي من عقبات الى انه تجاوزها في الأخير ليقدم النادي كل مالديه ولايخيب امال جمهوره
            Despite the obstacles the club went through, it overcame them in the end, so the club gave its all and did not disappoint its fans.
            </p>
            </div>
    </div>
    <div class="container left">
        <div class="content">
            <h2>2020</h2>
            <p>رغم مامرة به النادي من عقبات الى انه تجاوزها في الأخير ليقدم النادي كل مالديه ولايخيب امال جمهوره
            Despite the obstacles the club went through, it overcame them in the end, so the club gave its all and did not disappoint its fans.
            </p>
        </div>
    </div>
    <div class="container right">
        <div class="content">
            <h2>2021</h2>
            <p>رغم مامرة به النادي من عقبات الى انه تجاوزها في الأخير ليقدم النادي كل مالديه ولايخيب امال جمهوره
            Despite the obstacles the club went through, it overcame them in the end, so the club gave its all and did not disappoint its fans.
            </p>
        </div>
    </div>
  
    <div class="container left">
        <div class="content">
            <h2>2022</h2>
            <p>رغم مامرة به النادي من عقبات الى انه تجاوزها في الأخير ليقدم النادي كل مالديه ولايخيب امال جمهوره
            Despite the obstacles the club went through, it overcame them in the end, so the club gave its all and did not disappoint its fans.
            </p>
        </div>
    </div>
    <div class="container right">
        <div class="content">
            <h2>2023</h2>
            <p>رغم مامرة به النادي من عقبات الى انه تجاوزها في الأخير ليقدم النادي كل مالديه ولايخيب امال جمهوره
            Despite the obstacles the club went through, it overcame them in the end, so the club gave its all and did not disappoint its fans.
            </p>
        </div>
    </div>
    <div class="container left">
        <div class="content">
            <h2>2024</h2>
            <p>رغم مامرة به النادي من عقبات الى انه تجاوزها في الأخير ليقدم النادي كل مالديه ولايخيب امال جمهوره
            Despite the obstacles the club went through, it overcame them in the end, so the club gave its all and did not disappoint its fans.
            </p>
        </div>
    </div>
    <div class="container right">
        <div class="content">
            <h2>2025</h2>
            <p>تم تجاوز مرحة الجهوية و الانتقال الى قسم الاعلى قسم الوطني
            The regional stage has been passed and we have moved to the higher division, the national division.
            </p>
        </div>
    </div>
   
</div>

<script src="script.js"></script>
<script>

document.addEventListener("DOMContentLoaded", function() {
    const containers = document.querySelectorAll('.container');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            } else {
                entry.target.classList.remove('show');
            }
        });
    }, {
        threshold: 0.5 // جعل العنصر يظهر بمجرد الوصول إلى منتصف الشاشة
    });

    containers.forEach(container => {
        observer.observe(container);
    });
});


</script>
</body>
</html>
