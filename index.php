<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="style.css" media="screen">
</head>
<body>

<header>
    <nav>
        <div class="logo">AZ[store]</div>
        <div class="menu">
            <div class="nav-item"><a href="#">Home</a></div>
            <div class="nav-item"><a href="#">About</a></div>
            <div class="nav-item"><a href="#">Products</a></div>
            <div class="nav-item"><a href="#">Contact</a></div>
        </div>
        <div class="cart">
            <a href="assets/images/shopping-cart.svg"><img src="assets/images/shopping-cart.svg" alt="Shopping Cart Icon"></a>
            <p>Login</p>
        </div>
    </nav>
</header>

<main>
    <div class="main">
        <div class= "left">
            <h1>shoe the right one</h1>
            <button>See our store</button>
        </div>

        <div class="right">
            <img src="assets/images/shoe_one" alt="">
        </div>
    </div>   
    
        
    <?php 
    $productsJson = file_get_contents('products.json');
    $products = json_decode($productsJson, true);

    echo '<h2>Our last products</h2>';
    echo '<div id="products">';

    foreach ($products as $product) {
        echo '<div class="product">';
        echo '<img src="' . $product['image_url'] . '" alt="' . $product['product'] . '" width="150px">';
        echo '<h3>' . $product['product'] . '</h3>';
        echo '<p>' . $product['price'] . '</p>';
        echo '<button class="addToCartBtn">Add to cart</button>';
        echo '</div>';
    }

    echo '</div>';
?>


    <div class="bestQuality">
        <img src="assets/images/shoe_two" alt="">
        <p class=best>WE PROVIDE YOU THE BEST QUALITY.</p>
        <p class= lorem>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim tenetur vel dolor quas, minus velit harum porro molestiae in eius adipisci accusamus quidem cupiditate optio quasi sint possimus, doloremque impedit!</p>
    </div>

    <div class= "testimonials">
        <div class="Emily">
            <img class="imgTest" src="assets/images/image-emily.jpg" alt="">
            <h4>Emily from xyz</h4>
            <p class= "testP">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim tenetur vel dolor quas, minus velit harum porro molestiae in eius adipisci accusamus quidem cupiditate optio quasi sint possimus, doloremque impedit!</p>
        </div>

        <div class="Thomas">
            <img class="imgTest" src="assets/images/image-thomas.jpg" alt="">
            <h4>Thomas from corporate</h4>
            <p class= "testP">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim tenetur vel dolor quas, minus velit harum porro molestiae in eius adipisci accusamus quidem cupiditate optio quasi sint possimus, doloremque impedit!</p>
        </div>

        <div class="Jennie">
            <img class="imgTest" src="assets/images/image-jennie.jpg" alt="">
            <h4>Jennie from Nike</h4>
            <p class= "testP">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim tenetur vel dolor quas, minus velit harum porro molestiae in eius adipisci accusamus quidem cupiditate optio quasi sint possimus, doloremque impedit!</p>
        </div>
    </div>
</main>
    
<footer>
    <div class="footerLink">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Products</a>
        <a href="#">Contact</a>
    </div>
</footer>

    
</body>
</html>

