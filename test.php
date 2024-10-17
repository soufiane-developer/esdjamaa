<!-- <?php session_start() ?> -->

<style>

        .typing-effect {
            white-space: nowrap;
            overflow: hidden;
            border-right: 3px solid;
            width: 0;
            animation: typing1 4s steps(50, end), blink 0.75s step-end infinite;
        }

        .typing-effect-second {
            white-space: nowrap;
            overflow: hidden;
            border-right: 3px solid;
            width: 0;
            opacity: 0;
            animation: typing2 4s steps(50, end) 4s forwards, blink 0.75s step-end infinite;
        }

        @keyframes typing1 {
            from { width: 0; }
            to { width: 50%; }
        }

        @keyframes typing2 {
            from { width: 0; opacity: 0; }
            to { width: 50%; opacity: 1; }
        }

        @keyframes blink {
            from { border-color: transparent; }
            to { border-color: black; }
        }



        /* user */
        .user_icon {
    position: relative;
}

.user_box {
    display: none;
    position: absolute;
    top: 40px;
    left: -140;
    width: 250px;
    padding: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    z-index: 1;
}

.user_box p {
    margin: 0;
    padding: 10px 0;
    font-size: 14px;
    border-bottom: 1px solid #ddd;
}

.user_box a {
    display: block;
    padding: 5px 0;
    color: #333;
    text-decoration: none;
}

.user_box a:hover {
    background-color: #f1f1f1;
    color: #000;
}

    </style>
    <body>
<div class="container">
             <div class="navbar">
                 <a href="home.php"><img class="esd_logo" src="./IMG/esd.png" alt="ESD"></a>
                     <ul>
                 <li><a id="home" href="home.php">Home</a></li>
                 <li><a href="historique.php">Historique</a></li>
                 <li><a href="product.php">Boutique</a></li>
                 <li><a href="news.php">News</a></li>
                 <li><a href="players.php">Players</a></li>
                 <li><a href="clubs_life.php">About</a></li>
             </ul>

           <!-- <a href="#"><span id ="user" class="material-symbols-outlined"> person  </span></a>-->

           <div class="user_icon">
    <a href="#"><i id="user" class="fa-solid fa-user"></i></a>
    <div class="user_box" id="userBox">
        <?php if (isset($_SESSION['actor_id'])): ?>
            <p><?php echo $_SESSION['actor_id']; ?></p>
            <a href="my_product.php">Product Basket</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
</div>
                    






                   <a href="#">    <button class="menu" onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))" aria-label="Main Menu">
                    <svg width="100" height="100" viewBox="0 0 100 100">
                      <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                      <path class="line line2" d="M 20,50 H 80" />
                      <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                    </svg>
                  </button></a>






        </div>




            <div class="landingPage">

              <div class="handballeur">
                 <img  class="img_handballeur"src="./IMG/handballeur.png" alt="handballeur">
             </div>
             <div class="supporteur">
                 <img class="img_supporteur"src="./IMG/supporteur.png" alt="supporteur">
             </div>
              <div class="ESD_text">
                 <h1>Entante Sportif Djamaa</h1>
                 <p class="typing-effect">Welcome to our website. Entente Sportive Djamaa is the best in the world.</p>
                 <br>
                 <p class="typing-effect-second"> chweya hadra zayda tani ooop.</p>


                    <button class="custom-btn btn-15">Read More</button>
              </div>
            </div>


            





        
    

          <div class="network">
             <!-- <canvas id="canvas"></canvas> -->

                <a class="youtube-link" href="https://youtu.be/m9fXNVFC1qI" target="_blank"></a>



                     <script src="./javascript.js"></script>
                     <script>
                        document.getElementById('user').addEventListener('click', function (event) {
    event.preventDefault();
    var userBox = document.getElementById('userBox');
    if (userBox.style.display === "none" || userBox.style.display === "") {
        userBox.style.display = "block";
    } else {
        userBox.style.display = "none";
    }
});

// لإغلاق الصندوق عند الضغط خارجاً
window.addEventListener('click', function(event) {
    var userBox = document.getElementById('userBox');
    if (!event.target.matches('#user') && !event.target.closest('.user_box')) {
        userBox.style.display = 'none';
    }
});

                     </script>
            </div>
            </body>

