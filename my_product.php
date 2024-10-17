<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة السلة</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .cart-section, .suggestions-section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-item, .product {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .cart-item img, .product img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
        }

        .item-details, .product-details {
            flex: 1;
            margin-right: 15px;
        }

        input[type="number"] {
            width: 50px;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #218838;
        }

        .total {
            text-align: center;
            margin-top: 20px;
        }

        .suggested-products {
            display: flex;
            justify-content: space-around;
        }

        .suggested-products .product {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            width: 200px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- سلة المشتريات -->
        <section class="cart-section">
            <h2>سلة المشتريات</h2>
            <div class="cart-items">
                <?php
                // جلب المنتجات من قاعدة البيانات
                $db = new PDO('mysql:host=localhost;dbname=esd', 'root', '');
                $stmt = $db->query('SELECT *
                            FROM cart
                            JOIN product p ON cart.id_product = p.id_product');
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                    <div class="cart-item" data-id="' . $row['id_cart'] . '">
                        <img src="img/products/'. $row['product_image'] .'" alt="' . $row['name_product'] . '">
                        <div class="item-details">
                            <h3>' . $row['name_product'] . '</h3>
                            <p>السعر: $' . $row['product_prix'] . '</p>
                            <label for="quantity">الكمية:</label>
                            <input type="number" value="' . $row['product_quant'] . '" min="1">
                            <button class="remove-btn">حذف</button>
                        </div>
                    </div>';
                }
                ?>
            </div>
            <div class="total">
                <h3>المجموع الكلي: $<span id="total-amount">0</span></h3>
                <button class="checkout-btn">إتمام الشراء</button>
            </div>
        </section>

        <!-- اقتراحات المنتجات -->
        <section class="suggestions-section">
            <h2>منتجات قد تهمك</h2>
            <div class="suggested-products">
                <?php
                // جلب المنتجات المقترحة من قاعدة البيانات
                $suggested = $db->query('SELECT * FROM product LIMIT 4');
                while ($row = $suggested->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                    <div class="product">
                        <img src="img/products/' . $row['image'] . '" alt="' . $row['name_product'] . '">
                        <h3>' . $row['name_product'] . '</h3>
                        <p>السعر: $' . $row['prix'] . '</p>
                        <button class="add-to-cart-btn">أضف إلى السلة</button>
                    </div>';
                }
                ?>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
    <script>
        // حساب المجموع الكلي
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const price = parseFloat(item.querySelector('p').textContent.replace('السعر: $', ''));
                const quantity = item.querySelector('input[type="number"]').value;
                total += price * quantity;
            });
            document.getElementById('total-amount').textContent = total.toFixed(2);
        }

        // تحديث المجموع عند تغيير الكمية أو الحذف
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('change', updateTotal);
        });

        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function() {
                const item = this.closest('.cart-item');
                const itemId = item.dataset.id;
                // إزالة العنصر من قاعدة البيانات
                fetch('remove_item.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: itemId })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        item.remove();
                        updateTotal();
                    }
                });
            });
        });

        // إتمام الشراء
        document.querySelector('.checkout-btn').addEventListener('click', function() {
            const cartItems = [];
            document.querySelectorAll('.cart-item').forEach(item => {
                const id = item.dataset.id;
                const quantity = item.querySelector('input[type="number"]').value;
                cartItems.push({ id, quantity });
            });

            // إرسال بيانات السلة إلى الخادم لإتمام الشراء
            fetch('checkout.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(cartItems)
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert('تم إتمام الشراء بنجاح!');
                    // إعادة توجيه أو تحديث الصفحة
                }
            });
        });

        // تحديث المجموع الكلي عند تحميل الصفحة
        window.onload = updateTotal;
    </script>
</body>
</html>
