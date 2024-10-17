<style>
  /* General Styles */
body {
  margin: 0;
  padding: 0;
  background-color: #f0f2f5;
}

h2, h3, h6 {
  margin: 0;
  color: #333;
}

/* Icon Section */
.all_items {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin: 20px;
}

.icon {
  list-style-type: none;
  padding: 0;
}

.icon ol {
  margin: 10px;
  cursor: pointer;
  transition: transform 0.2s ease;
}

.icon ol:hover {
  transform: scale(1.05);
}

.item_icon img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 50%;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease;
}

.item_icon h6 {
  margin-top: 8px;
  font-size: 16px;
  color: #555;
}

.item_icon:hover img {
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
  transform: translateY(-5px);
}
.item_icon img {
  transition: all 0.3s ease-in-out;
}

.item_icon img:hover {
  transform: rotate(10deg);
}
/* Product Section */
/* .shell {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin: 20px;
} */



.row {
  display: flex;
  flex-direction: column;
}

.tableu_info {
  margin-top: 15px;
}

.tableu_info table {
  width: 100%;
  border-collapse: collapse;
}

.tableu_info td {
  padding: 12px;
  border: 1px solid #ddd;
  text-align: left;
  font-size: 14px;
}

.tableu_info tr:nth-child(even) {
  background-color: #f9f9f9;
}

.tableu_info tr:hover {
  background-color: #f1f1f1;
}

/* Product Name and Details */
.row_item {
  margin-top: 15px;
}

.row_item h2 {
  font-size: 20px;
  color: #222;
}

.size, .color {
  margin-top: 15px;
}

.size button, .color button {
  padding: 8px 16px;
  margin-right: 8px;
  margin-top: 5px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  background-color: #e0e0e0;
  color: #333;
  font-size: 14px;
  transition: background-color 0.3s, color 0.3s;
}

.size button:hover, .color button:hover {
  background-color: #d0d0d0;
}

.red {
  background-color: red;
  color: #fff;
}

.orange {
  background-color: orange;
  color: #fff;
}

.yellow {
  background-color: yellow;
  color: #333;
}

.blue {
  background-color: #007bff;
  color: #fff;
}

/* Button Styles */
.btn {
  margin-top: 20px;
}

.btn button {
  padding: 12px 24px;
  margin-right: 10px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  background-color: #333;
  color: #fff;
  font-weight: bold;
  font-size: 16px;
  transition: background-color 0.3s, transform 0.3s;
}

.btn button.Add {
  background-color: #28a745;
}

.btn button.Add:hover {
  background-color: #218838;
  transform: scale(1.05);
}


.btn button.Bay {
  background-color: #007bff;
}

.btn button.Bay:hover {
  background-color: #0056b3;
  transform: scale(1.05);
}
/* General Styles
.size-selection, .color-selection {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 15px;
}

.size-selection button, .color-selection button {
  padding: 10px;
  border: 2px solid #ddd;
  border-radius: 50%;
  cursor: pointer;
  background-color: #fff;
  color: #333;
  font-size: 14px;
  transition: all 0.3s;
}

.size-selection button.selected, .color-selection button.selected {
  border-color: #007bff;
  background-color: #007bff;
  color: #fff;
}

.size-selection button:hover, .color-selection button:hover {
  border-color: #007bff;
}

.size-selection button {
  width: 40px;
  height: 40px;
  text-align: center;
} */

.color-selection button {
  width: 30px;
  height: 30px;
  padding: 0;
  border-radius: 50%;
}

/* Custom colors */
.red {
  background-color: red;
}

.orange {
  background-color: orange;
}

.yellow {
  background-color: yellow;
}

.blue {
  background-color: blue;
}

.img_pub{
  background-image: url(img/products/pub1.jpg);
  height: 55vh;
  background-repeat: round;
}
.image_new{
  position: absolute;
    width: 77px;
    top: -19px;
    left: -8px;
}
.info_prix h3{
  margin-left: 53px;
}
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

.container {
  opacity: 0;
  animation: fadeInUp 1s ease forwards;
}

.all_items {
  opacity: 0;
  animation: fadeInUp 1s ease forwards;
  animation-delay: 0.3s;
}
/* حركة عند التمرير */
@keyframes fadeInOnScroll {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.container {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.5s ease-out, transform 0.5s ease-out;
}

.container.show {
  opacity: 1;
  transform: translateY(0);
}

</style>
<?php 
include 'connect.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Product</title>
</head>
<body style="  display: block;">
  <?php include ('pub.php');
?>
  <div class="img_pub"></div>
<div class="all_items">
  <ul class="icon">
    <?php
      $select_icon = $conn->prepare("SELECT * FROM `icon`");
      $select_icon->execute();
      if($select_icon->rowCount() > 0){
        while($fetch_icon = $select_icon->fetch(PDO::FETCH_ASSOC)){
    ?>
      <ol onclick="filterProducts('<?= $fetch_icon['name']; ?>')">
        <div class="item_icon">
          <div> <!--class="item_image" -->
            <img src="img/icon/<?= $fetch_icon['image']; ?>" alt="">
          </div>
          <h6><?= $fetch_icon['name']; ?></h6>
        </div>
      </ol>
    <?php }} ?>
  </ul>
</div>

<div class="shell" id="product-container">
    <?php
        // Fetch products from the database
        $select_product = $conn->prepare("SELECT * FROM `product`");
        $select_product->execute();
        if($select_product->rowCount() > 0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){ ?>
        
        <div class="container">
            <!-- Display price and product info icon -->
            <div class="info_prix">
                <img class="image_new" src="img/new.png">
                <h3><?= htmlspecialchars($fetch_product['prix']); ?>DA</h3>
            </div>
            
            <div class="row">
                <!-- Product image -->
                <div class="wsk-cp-img">
                    <img src="img/products/<?= htmlspecialchars($fetch_product['image']); ?>" alt="<?= htmlspecialchars($fetch_product['name_product']); ?>">
                </div>
                
                <!-- Product details table -->
                <div class="tableu_info">
                    <table>
                        <tr><td>Shoes</td><td>Good</td></tr>
                        <tr><td>Water</td><td>Good</td></tr>
                        <tr><td>KM</td><td>1200</td></tr>
                        <tr><td>Limit</td><td>150M</td></tr>
                        <tr><td>Size</td><td>XL/L/M</td></tr>
                        <tr><td>Color</td><td>Red</td></tr>
                    </table>
                </div>
                
                <!-- Product name and add button -->
                <div class="row_item">
                    <h2><?= htmlspecialchars($fetch_product['name_product']); ?></h2>
                    <div class="btn">
                        <!-- <a href="form_info.php" class="Add">Add</a> -->
                    </div>
                </div>
            </div>
        </div>

    <?php }} else { ?>
        <!-- If no products are found -->
        <p>No products found.</p>
    <?php } ?>
</div>
<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.shell {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.container {
    width: 15%;
    background-color: #fff;
    border-radius: 8px;
    margin: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.info_prix {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 18px;
}

.wsk-cp-img img {
    width: 50%;
    display: flex;
    border-radius: 8px;
    justify-content: revert;
    margin: 0 auto;
}

.row_item h2 {
    font-size: 18px;
    margin: 10px 0;
    text-align: center;
}

.btn .Add {
    display: block;
    text-align: center;
    background-color: #28a745;
    color: white;
    padding: 10px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn .Add:hover {
    background-color: #218838;
}

.tableu_info {
    margin-top: 10px;
}

.tableu_info table {
    width: 100%;
    border-collapse: collapse;
}

.tableu_info td {
    padding: 5px;
    border-bottom: 1px solid #ddd;
    text-align: left;
    font-size: 14px;
}

/* Responsive styling */
@media (max-width: 768px) {
    .container {
        width: 45%;
    }
}

@media (max-width: 576px) {
    .container {
        width: 100%;
    }
}

</style>
</div>
  </div>
</body>

<script>
function filterProducts(category) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "filter_products.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("product-container").innerHTML = xhr.responseText;
    }
  };
  xhr.send("category=" + category); // Send the selected category to PHP
}



window.addEventListener('scroll', function() {
  var containers = document.querySelectorAll('.container');
  var windowHeight = window.innerHeight;

  containers.forEach(function(container) {
    var elementTop = container.getBoundingClientRect().top;

    if (elementTop < windowHeight - 100) {
      container.classList.add('show');
    }
  });
});
</script>


</html>
