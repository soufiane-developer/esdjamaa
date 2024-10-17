    <style>
        .marquee-container {
            margin: 12px 0;
            overflow: hidden;
            white-space: nowrap;
            background-color: #f4f4f4;
            height: 15vh;
        }

        .marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 100s linear infinite;
            transition: animation-play-state 0.3s ease;
        }

        .marquee-container:hover .marquee {
            animation-play-state: paused;
        }

        .brand {
            display: inline-block;
            padding: 10px;
            margin-right: 222px;
        }

        .brand img {
            height: 100px; 
            width: auto;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
    </style>

    <div class="marquee-container">
        <div class="marquee">
            <span class="brand"><a href="https://www.hummel.net/"><img src="img/companies/hummel.png" alt="Hummel"></a></span>
            <span class="brand"><a href="https://www.nike.com/fr/"><img src="img/companies/nike.png" alt="Nike"></a></span>
            <span class="brand"><a href="https://www.adidas.fr/"><img src="img/companies/adidas.png" alt="Adidas"></a></span>
            <span class="brand"><a href="https://eu.puma.com/fr/fr/home"><img src="img/companies/puma.png" alt="Puma"></a></span>
        </div>
    </div>

