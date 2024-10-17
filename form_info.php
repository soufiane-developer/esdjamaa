<?php
// Assuming you are using PDO for database connection
// Database connection
$host = 'localhost';
$dbname = 'esd';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name_customar = filter_var($_POST['name_customar'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $customer_id = filter_var($_POST['customer_id'], FILTER_SANITIZE_NUMBER_INT);
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
    $price_per_unit = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $total_price = $price_per_unit * $quantity;

    // Validate required fields
    if (empty($name_customar) || empty($last_name) || empty($address) || empty($phone) || empty($email)) {
        echo "All fields are required!";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
    } else {
        // Prepare SQL query to insert customer data into the database
        $sql = "INSERT INTO customar (name_customar, last_name, address, phone, email) 
                VALUES (:name_customar, :last_name, :address, :phone, :email)";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name_customar', $name_customar);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Customer information has been saved successfully!";
        } else {
            echo "Error: Could not save customer information.";
        }
    }
}
try {
    // Begin transaction
    $pdo->beginTransaction();

    // Insert into `orders` table
    $stmt = $pdo->prepare("INSERT INTO orders (id, total_price) VALUES (:id, :total_price)");
    $stmt->bindParam(':id', $customer_id);
    $stmt->bindParam(':total_price', $total_price);
    $stmt->execute();

    // Get the last inserted order ID
    $order_id = $pdo->lastInsertId();

    // Insert into `order_items` table
    $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) 
                           VALUES (:order_id, :product_id, :quantity, :price)");
    $stmt->bindParam(':order_id', $order_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':price', $price_per_unit);
    $stmt->execute();

    // Commit transaction
    $pdo->commit();

    echo "Order placed successfully! Order ID: " . $order_id;
} catch (Exception $e) {
    // Rollback transaction in case of an error
    $pdo->rollBack();
    echo "Failed to place order: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .product-display {
            display: flex;
            gap: 2rem;
            margin: 20px;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 900px;
        }

        .product-image {
            flex: 1;
            position: relative;
        }

        .product-image img {
            max-width: 400px;
            height: auto;
        }

        .product-thumbnails {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .thumbnail {
            width: 60px;
            cursor: pointer;
            border: 1px solid #ccc;
        }

        .thumbnail:hover {
            border: 2px solid #000;
        }

        .product-details {
            flex: 1;
        }

        .product-details h2 {
            font-size: 24px;
        }

        .price {
            font-size: 18px;
            color: #888;
        }

        .product-options {
            margin-top: 20px;
        }

        .product-options label {
            display: block;
            margin-top: 10px;
        }

        .product-options select, .add-to-cart {
            margin-top: 5px;
            padding: 8px;
            max-width: 200px;
            box-sizing: border-box;
        }

        .add-to-cart {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .add-to-cart:hover {
            background-color: #45a049;
        }

        .customer-form {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .customer-form label {
            display: block;
            margin-top: 10px;
        }

        .customer-form input {
            margin-top: 5px;
            padding: 8px;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        .submit-btn {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<div class="product-display">
    <div class="product-image">
        <img id="main-image" src="img/products/1.png" alt="V-Neck T-Shirt">
        <div class="product-thumbnails">
            <img class="thumbnail" src="img/products/1.png" alt="Red T-Shirt" onclick="changeImage('img/products/1.png')">
            <img class="thumbnail" src="img/products/4.png" alt="Green T-Shirt" onclick="changeImage('img/products/4.png')">
        </div>
    </div>

    <div class="product-details">
        <h2>V-Neck T-Shirt</h2>
        <p class="price">$15.00 – $20.00</p>
        <p>This is a variable product.</p>

        <form class="product-options">
            <label for="size">Size</label>
            <select id="size" name="size">
                <option value="">Choose an option</option>
                <option value="small">Small</option>
                <option value="medium">Medium</option>
                <option value="large">Large</option>
            </select>

            <label for="quantity">Quantity</label>
            <select id="quantity" name="quantity">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
            </select>

            <button type="submit" class="add-to-cart">Add to cart</button>
        </form>

        <p>SKU: woo-vneck-tee | Category: Tshirts</p>
    </div>
</div>

<div class="customer-form">
    <h3>Customer Information</h3>
    <form action="submit_customer.php" method="POST">
        <label for="first-name">First Name</label>
        <input type="text" id="first-name" name="name_customar" required>

        <label for="last-name">Last Name</label>
        <input type="text" id="last-name" name="last_name" required>

        <label for="address">Address</label>
        <input type="text" id="address" name="address" required>

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <button type="submit" class="submit-btn">Submit</button>
    </form>
</div>

<script src="script.js"></script>
<script>
    function changeImage(imageUrl) {
        document.getElementById('main-image').src = imageUrl;
    }
</script>
</body>
</html>
