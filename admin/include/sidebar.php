<aside id='sidebar'>
    <div id='logo-wrap'>
        <a href="index.php">&ensp;</a>
    </div>
    <nav id='main-nav'>
        <ul id='nav-ul'>
            <li <?php if($seletedPage == 'home')echo "class='active'" ?>><a href="index.php" class='settings'>Account Settings</a></li>
            <li <?php if($seletedPage == 'new-orders')echo "class='active'" ?>><a href="new-orders.php" class='question'>New Orders</a></li>
            <li <?php if($seletedPage == 'pending-checkout-orders')echo "class='active'" ?>><a href="pending-checkout-orders.php" class='question'>Pending Checkouts</a></li>
            <li <?php if($seletedPage == 'confirmed-orders')echo "class='active'" ?>><a href="confirmed-orders.php" class='question'>Confirmed Orders</a></li>
			<li <?php if($seletedPage == 'shipped-orders')echo "class='active'" ?>><a href="shipped-orders.php" class='question'>Shipped Orders</a></li>
            <li <?php if($seletedPage == 'out-for-delivery-orders')echo "class='active'" ?>><a href="out-for-delivery-orders.php" class='question'>Out For Deliver</a></li>
            <li <?php if($seletedPage == 'cancelled-orders')echo "class='active'" ?>><a href="cancelled-orders.php" class='question'>Cancelled Orders</a></li>
            <li><a href="logout.php" class='info'>Logout</a></li>
        </ul>
    </nav>
</aside>