<?php
$query = $conn->prepare("SELECT * FROM customar");
$query->execute();
$customers = $query->fetchAll(PDO::FETCH_ASSOC);
$total_customers = $query->rowCount();

$query = $conn->prepare("SELECT * FROM customar WHERE status_order = 1");
$query->execute();
$customers = $query->fetchAll(PDO::FETCH_ASSOC);
$total_order_fin = $query->rowCount();

$query = $conn->prepare("SELECT * FROM customar WHERE status_order = 0");
$query->execute();
$customers = $query->fetchAll(PDO::FETCH_ASSOC);
$total_order_pend = $query->rowCount();

$query = $conn->prepare("SELECT * FROM product WHERE quantity != 0 ");
$query->execute();
$customers = $query->fetchAll(PDO::FETCH_ASSOC);
$total_product = $query->rowCount();
?>
<style>
       .stats {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    margin-left: 283px;

}

.stat-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    padding: 20px;
    width: 20%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s, color 0.3s;
}

.stat-box .info {
    text-align: left;
}

.stat-box i {
    font-size: 30px;
    color: #2872e0; 
    margin-left: 15px; 
    transition: color 0.3s;
}

.stat-box:hover {
    background-color: #2872e0;
    color: #f9f9f9;
    cursor: pointer;
}

.stat-box:hover i {
    color: #f9f9f9; 
}

.stat-box .info h3 {
    margin: 0;
    font-size: 24px;
}

.stat-box .info p {
    margin: 5px 0 0;
    font-size: 14px;
    color: #777;
    transition: color 0.3s;
}

.stat-box:hover .info p {
    color: #f9f9f9; /* تغيير لون النص عند التمرير */
}



        .stat-box h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }
</style>
<div class="stats">
            <div class="stat-box">
                <i class="fas fa-users"></i>
                <div class="info">
                    <h3><?= $total_customers ?></h3>
                    <p>العملاء</p>
                </div>
            </div>
            <div class="stat-box">
            <i class="fa-solid fa-check"></i>
                <div class="info">
                    <h3><?= $total_order_fin ?></h3>
                    <p>الطلبات المكتملة</p>
                </div>
            </div>
            <div class="stat-box">
            <i class="fa-solid fa-spinner"></i>
                <div class="info">
                    <h3><?= $total_order_pend ?></h3>
                    <p>الطلبات المعلقة</p>
                </div>
            </div>
            <div class="stat-box">
            <i class="fas fa-boxes"></i>
                <div class="info">
                    <h3><?= $total_product ?></h3>
                    <p>عدد المنتوجات</p>
                </div>
            </div>
            <div class="stat-box">
                <i class="fas fa-dollar-sign"></i>
                <div class="info">
                    <h3>$6k</h3>
                    <p>الإيرادات</p>
                </div>
            </div>
        </div>