<style>
    .sidebar {
    width: 230px;
    background-color: #2872e0;
    color: #fff;
    padding: 20px;
    height: 100vh;
    position: fixed; /* تثبيت الشريط الجانبي */
}

.sidebar .email {
    text-align: center;
    color: #fff;
    font-size: 14px;
    display: block;
    margin-bottom: 20px;
}

.sidebar img {
    display: block;
    margin: 0 auto 10px;
    width: 100px;
    height: 100px;
    border-radius: 50%; /* تحويل الصورة إلى دائرية */
    object-fit: cover;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin: 20px 0;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
    display: block;
    padding: 12px;
    width: 226px;
}

.sidebar ul li a:hover {
    background-color: #f9f9f9;
    border-radius: 22px 0 0 22px;
    color: #2872e0;
}

.sidebar ul li a i {
    margin-right: 10px;
    font-size: 18px;
}

</style>
<?php
 include '../../user_id.php';
 $select_profile = $conn->prepare("SELECT * FROM actors WHERE id = ? AND roles = ?");
 $select_profile->execute([$actor_id, $role]);
 $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
 ?>

<aside class="sidebar">
    <!-- صورة الحساب -->
    <a href="dashboard.php"><img src="../../img/esd.jpg" alt="Admin Image"></a>
    
    <!-- قائمة التنقل -->
    <ul>
        <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a></li>
        <li><a href="customar.php"><i class="fas fa-users"></i>Customar</a></li>
        <li><a href="#"><i class="fas fa-project-diagram"></i> المشاريع</a></li>
        <li><a href="#"><i class="fas fa-shopping-cart"></i> الطلبات</a></li>
        <li><a href="add_prodact.php"><i class="fas fa-boxes"></i>Orders</a></li>
        <li><a href="settings.php"><i class="fas fa-cogs"></i> الإعدادات</a></li>
        <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> الخروج</a></li>
    </ul>
</aside>
