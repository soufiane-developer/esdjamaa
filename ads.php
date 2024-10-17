
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: Arial, sans-serif;
    }

    .pub {
      position: relative;
      width: 100%;
      height: 40vh;
      display: flex;
      justify-content: center;
      align-items: center;
      grid-area: pub;
    }

    .image-overlay {
      position: relative;
      width: 100%;
      height: 40vh;
      background-image: url('img/home/img.jpg'); /* الصورة الأولى */
      background-size: cover;
      background-position: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .text-overlay {
      text-align: left;
      color: white;
      margin-left: 50px;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 4rem;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 1s forwards;
    }

    /* زر الفيديو */
    .video-btn {
      background-color: #ff3333;
      border: none;
      color: white;
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .video-btn:hover {
      background-color: #cc0000;
    }

    .pagination {
      position: absolute;
      bottom: 20px;
      left: 50px;
    }

    .dot {
      height: 15px;
      width: 15px;
      margin: 0 5px;
      background-color: white;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

    .dot:hover {
      background-color: #fff;
    }

    /* تأثير حركة النص */
    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* حركة التلاشي عند التغيير */
    .fade-out {
      animation: fadeOutDown 0.5s forwards;
    }

    @keyframes fadeOutDown {
      0% {
        opacity: 1;
        transform: translateY(0);
      }
      100% {
        opacity: 0;
        transform: translateY(20px);
      }
    }
  </style>

  <div class="pub">
    <div class="image-overlay">
      <div class="text-overlay">
        <h1 id="title">#EdFM #U21 - A l'heure espagnole</h1>
        <button class="video-btn">Voir la vidéo</button>
      </div>
      <div class="pagination">
        <span class="dot" onclick="changeImageAndText('img/home/img.jpg', '#EdFM #U21 - A l\'heure espagnole')"></span>
        <span class="dot" onclick="changeImageAndText('img/esd.jpg', 'Exploration des tendances espagnoles')"></span>
        <span class="dot" onclick="changeImageAndText('img/esd2.jpg', 'Aventure en Espagne')"></span>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
  <script>
    // قائمة الصور والنصوص المتاحة
    const content = [
      { image: 'img/home/img.jpg', text: "#EdFM #U21 - A l'heure espagnole" },
      { image: 'img/esd.jpg', text: 'Exploration des tendances espagnoles' },
      { image: 'img/esd2.jpg', text: 'Aventure en Espagne' }
    ];

    let index = 0;

    // وظيفة لتغيير الخلفية والنص
    function changeImageAndText(imageUrl, text) {
      var imageContainer = document.querySelector(".image-overlay");
      var title = document.getElementById("title");

      // إضافة تأثير التلاشي عند التغيير
      title.classList.add('fade-out');

      setTimeout(function() {
        // تغيير الخلفية والنص بعد انتهاء التلاشي
        imageContainer.style.backgroundImage = `url('${imageUrl}')`;
        title.textContent = text;

        // إزالة تأثير التلاشي وإعادة تطبيق تأثير الدخول
        title.classList.remove('fade-out');
        title.style.animation = 'fadeInUp 1s forwards';
      }, 500); // الانتظار حتى ينتهي تأثير التلاشي
    }

    // وظيفة لتغيير الصورة والنص باستمرار
    function changeContentContinuously() {
      index = (index + 1) % content.length; // الانتقال للصورة التالية، العودة للأولى عند نهاية القائمة
      const { image, text } = content[index];
      changeImageAndText(image, text);
    }

    // عند تحميل الصفحة، يبدأ التغيير المستمر
    window.onload = function() {
      setInterval(changeContentContinuously, 10000); // تغيير الصورة والنص كل 10 ثوانٍ
    };
  </script>

