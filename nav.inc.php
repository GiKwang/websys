<!-- Start of Navigation bar -->
<section id="header">
    <a href="#"><img src="img/logo.png" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
            <li><a <?php if ($page == 'index') { echo 'class="active"'; } ?> href="index.php">Home</a></li>
            <li><a <?php if ($page == 'shop') { echo 'class="active"'; } ?> href="shop.php">Shop</a></li>
            <li><a <?php if ($page == 'blog') { echo 'class="active"'; } ?> href="blog.php">Blog</a></li>
            <li><a <?php if ($page == 'about') { echo 'class="active"'; } ?> href="about.php">About</a></li>
            <li><a <?php if ($page == 'contact') { echo 'class="active"'; } ?> href="contact.php">Contact</a></li>
            <li class="icons d-flex">
                <div class="icon user-icon d-flex">
                    <a class="user-link" href="#">Login</a>
                </div>
            </li>
            <li id="lg-bag"><a <?php if ($page == 'cart') { echo 'class="active"'; } ?> href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
        </ul>
    </div>

    <div id="mobile">
        <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
