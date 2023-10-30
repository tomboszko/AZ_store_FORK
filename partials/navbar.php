<nav class="nav">
        <div class="logo">AZ[store]</div>
        <div class="menu">
            <div class="nav-item"><a href="#">Home</a></div>
            <div class="nav-item"><a href="#">About</a></div>
            <div class="nav-item"><a href="#">Products</a></div>
            <div class="nav-item"><a href="#">Contact</a></div>
        </div>
        <div class="cart">
        <p>Login</p>
            <a href="shopping-cart.php"><img id="shoppingIcon" src="assets/images/shopping-cart.png" alt="Shopping Cart Icon" width="24px" ></a>
            <span class="cartCount"><?php echo $count; ?></span> <!-- Display the count -->

    
        </div>
        <div class="burger-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div id="menuItems">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>    