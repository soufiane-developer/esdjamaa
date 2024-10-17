
<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>منتوجات الفريق</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .team-products {
      padding: 20px;
      margin: 20px auto;
      max-width: 1200px;
      width: 100%;
      text-align: center;
    }

    .team-products h1 {
      color: #333;
      font-size: 2.5rem;
      margin-bottom: 10px;
    }

    .team-products p {
      color: #777;
      font-size: 1.2rem;
      margin-bottom: 40px;
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .product-card {
      background-color: #fff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card .prodact {
      max-width: 65%;
      border-radius: 10px;
      aspect-ratio: 1 / 1;
    }

    .product-card img:hover{
	transform:translateX(0px);
	animation:float 6s ease-out infinite;
}
@keyframes float {
	0%{transform:translateY(0px);}
		50%{transform:translateY(-20px);}
			100%{transform:translateY(0px);}
    }

    .product-card h2 {
      color: #333;
      font-size: 1.5rem;
      margin: 10px 0;
    }

    .product-card .price {
      color: #007bff;
      font-size: 1.2rem;
      margin: 10px 0;
    }

    .product-card .likes {
      color: #555;
      font-size: 1rem;
      margin: 10px 0;
    }

    .product-card button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .product-card button:hover {
      background-color: #0056b3;
    }

    .product-card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .scrollable-content {
            width: 100%;
            height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
        }


        .h3_text{
    font-style: italic;
	font-family: cursive;

}
.h3_text:hover{
    font-style: italic;
	font-family: cursive;
	color:red;
}
  </style>
</head>

<body>

  <section class="team-products">
    <h1>منتوجات الفريق</h1>
    <p>اكتشف أفضل منتوجات الفريق التي يمكن أن تشتريها لدعم فريقك المفضل.</p>
    
    <div class="products-grid">
      <?php
        include 'connect.php';

        $rows = $conn->prepare("SELECT * FROM product");
        $rows->execute();
        if ($rows->rowCount() > 0) {
            while ($fetch_product = $rows->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <div class="product-card">
        <img src="img/products/<?= $fetch_product['image']; ?>" alt="<?= $fetch_product['name_product']; ?>" class="prodact">
        <h2 class="h3_text"><div onmouseover="mOver(this)" onmouseout="mOut(this)"><?= $fetch_product['name_product']; ?></div></h2>
        <p class="price"><?= $fetch_product['prix']; ?>$</p>
        <p class="likes"><i class="fa-solid fa-heart"></i><?= $fetch_product['likes']; ?></p>
        <form action="" method="post">
        <button>شراء الأن</button>
    </form>      </div>
      <?php
            }
        }
      ?>
    </div>
  </section>
 <!-- <?php
  include ('marcat.php');
  include ('login.php');
  ?> -->
</body>
<!-- <script>
        function loadLoginForm() {

          var xhr = new XMLHttpRequest();
            xhr.open('GET', 'login.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {

                  document.getElementById('scrollable-content').innerHTML = xhr.responseText;

                  document.getElementById('scrollable-content').scrollIntoView();
                }
            };
            xhr.send();
        }
</script> -->
<script>
    function mOver(obj) {
  obj.innerHTML = "hi"
}

function mOut(obj) {
  obj.innerHTML = "bay"
}
</script>
</html>
