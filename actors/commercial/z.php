<style>
    .projects-customers {
        display: flex;
        justify-content: center;
        padding: 20px;
        /* Add padding around the container */
        margin-left: 265px;
    }

    .recent-projects,
    .new-customers {
        height: 40vh;
    width: 48%;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-left: 10px;
    overflow-y: auto;
    }

    .recent-projects h2,
    .new-customers h2 {
        margin-bottom: 15px;
        font-size: 22px;
        color: #2872e0;
        text-align: center;
        /* Center headings */
    }

    table {
        width: 100%;
        /* Full width for the table */
        border-collapse: collapse;
        /* No gaps between cells */
        margin-top: 10px;
        /* Space above the table */
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #2872e0;
        color: #fff;
    }

    tr:hover {
        background-color: #f1f1f1;
        /* Highlight on hover */
    }

    /* New Customers section */
    .new-customers ul {
        list-style-type: none;
        padding: 0;
    }

    .new-customers ul li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #f1f1f1;
    }

    .customer-name {
        font-size: 16px;
        color: #333;
        flex: 1;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        /* Space between buttons */
    }

    .accept-btn,
    .reject-btn,
    .view-btn {
        padding: 5px 10px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        /* Transition for hover effects */
    }

    .accept-btn {
        background-color: #28a745;
        color: #fff;
    }

    .accept-btn:hover {
        background-color: #218838;
        /* Darker shade on hover */
    }

    .reject-btn {
        background-color: #dc3545;
        color: #fff;
    }

    .reject-btn:hover {
        background-color: #c82333;
        /* Darker shade on hover */
    }

    .view-btn{
        background-color: #2872e0;
        color: #fff;
    }
    .view-btn:hover{
        background-color: #2c60ad;
    }



    .modal {
    display: none; /* مخفية بشكل افتراضي */
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0, 0, 0, 0.4); /* خلفية داكنة */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* عرض النافذة */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}


.modal {
    display: none; /* مخفية بشكل افتراضي */
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0, 0, 0, 0.7); /* لون خلفية أكثر قتامة */
}

.modal-content {
    background-color: #ffffff; /* لون الخلفية */
    margin: 10% auto; /* تغيير الموضع */
    padding: 30px; /* زيادة المساحة الداخلية */
    border: 2px solid #888; /* إضافة إطار */
    border-radius: 10px; /* زوايا مستديرة */
    width: 80%; /* عرض النافذة */
    max-width: 500px; /* الحد الأقصى للعرض */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* إضافة ظل */
}

.close {
    color: #333; /* تغيير لون زر الإغلاق */
    float: right;
    font-size: 30px; /* زيادة حجم الخط */
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #e74c3c; /* تغيير لون عند التحويم */
    text-decoration: none;
    cursor: pointer;
}

h2 {
    color: #2872e0; /* تغيير لون العنوان */
    text-align: center; /* توسيط العنوان */
}



    @media (max-width: 768px) {

        .projects-customers{
            display: flex;
            flex-wrap: wrap;
        }

        .recent-projects,
        .new-customers {
            width: 100%;
            margin-top: 25px;
        }
    }
</style>

<div class="projects-customers">
    <div class="recent-projects">
        <h2>أحدث المنتوجات</h2>
        <table>
            <tr>
                <th>Name Product</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
            <?php
            include '../../connect.php';

            $rows = $conn->prepare("SELECT * FROM product WHERE date >= NOW() - INTERVAL 7 DAY ORDER BY date DESC");
            $rows->execute();
            if ($rows->rowCount() > 0) {
                while ($fetch_product = $rows->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($fetch_product['name_product']) ?></td>
                        <td><?= htmlspecialchars($fetch_product['quantity']) ?></td>

                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>

    <div class="new-customers">
        <h2>New Customers</h2>
        <ul>
            <?php

            $rows = $conn->prepare("SELECT * FROM customar WHERE status_order = 0");
            $rows->execute();
            if ($rows->rowCount() > 0) {
                while ($fetch_customar = $rows->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <li>
                        <span class="customer-name"><?= $fetch_customar['name_customar']; ?></span>
                        <span class="customer-name"><?= $fetch_customar['name_product']; ?></span>
                        <span class="customer-name"><?= $fetch_customar['number_order']; ?></span>
                        <div class="action-buttons">
                            <form action="" method="post">
                            <button class="accept-btn">Accept</button>
                            <button class="view-btn" onclick="openModal(<?= $fetch_customar['id'] ?>)">View</button>
                            <button class="reject-btn">Cancel</button>
                            </form>
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
    
</div>
<div id="customerModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>معلومات الزبون</h2>
        <div id="customerInfo">

    </div>
    </div>
</div>
<script>
   function openModal(customerId) {
    fetch(`getCustomerInfo.php?id=${customerId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {

            console.log(data);
            if (data.name) {
                document.getElementById('customerInfo').innerHTML = `
                    <p>Name: ${data.name}</p>
                    <p>Phone: ${data.phone}</p>
                    <p>Address: ${data.address}</p>
                    <p>Product: ${data.product}</p>

                `;
                document.getElementById('customerModal').style.display = "block";
            } else {
                alert('لم يتم العثور على معلومات الزبون.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('فشل في جلب معلومات الزبون.');
        });
}
function closeModal() {
        document.getElementById('customerModal').style.display = "none";
    }

    // إغلاق النافذة عند النقر خارجها
    window.onclick = function(event) {
        const modal = document.getElementById('customerModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>