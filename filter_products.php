<?php
include 'connect.php'; // Include your database connection here

if(isset($_POST['category'])) {
  $category = $_POST['category'];

  $select_product = $conn->prepare("SELECT * FROM `product` WHERE `category` = ?");
  $select_product->execute([$category]);

  if($select_product->rowCount() > 0){
    while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){ ?>
      <div class="container">
      <img class="image_new" src="img/new.png">
        <h3 style="margin-left: 51px;"><?= $fetch_product['prix']; ?>DA</h3>
        <div class="row">
          <div class="wsk-cp-img">
            <img src="img/products/<?= $fetch_product['image']; ?>" alt="">
          </div>
          <div class="row_item">
            <h2><?= $fetch_product['name_product']; ?></h2>
            <div class="btn">
              <!-- <button class="Add">Add</button>
              <button class="Bay">Bay</button> -->
            </div>
          </div>
        </div>
      </div>
    <?php }
  } else {
    echo "<p>No products found for this category.</p>";
  }
}
?>