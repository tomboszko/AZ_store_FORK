<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="assets/css/style.min.css" media="screen">
</head>
<body>


<?php





 // count the number of products in the shopping cart
session_start();

// Check if shopping cart exists and get count
if (isset($_SESSION['shoppingCart'])) {
    $count = count($_SESSION['shoppingCart']);
} else {
    $count = 0;
}


?>

<header>
   <?php 
require 'partials/navbar.php';
?>
</header>

<main>
    <div class="main">
        <div class= "left">
            <h1>shoe the right <span>one</span>.</h1>
            <button>See our store</button>
        </div>

        <div class="right">
            <img src="assets/images/shoe_one.png" alt="grosse shoes">
            <p class="NikeBG">Nike</p>
        </div>
    </div>   

    
        
    <?php 


$productsJson = file_get_contents('products.json');
$products = json_decode($productsJson, true);

echo '<h2><span>Our</span> last products</h2>';
echo '<div id="products">';

foreach ($products as $product) {
    echo '<div class="product">';
    echo '<img src="' . $product['image_url'] . '" alt="' . $product['product'] . '" width="150px">';
    echo '<h3>' . $product['product'] . '</h3>';
    echo '<p>' . "$". $product['price'] . '</p>';
    echo '<form id="addToCartForm" method="post" action="?addToCart">';
    echo '<input type="hidden" name="image_url" value="' . $product['image_url'] . '">'; 
    echo '<input type="hidden" name="id" value="' . $product['id'] . '">';
    echo '<input type="hidden" name="Name" value="' . $product['product'] . '">';
    echo '<input type="hidden" name="Price" value="' . $product['price'] . '">';
    echo '<label for="quantity">Quantity:</label>';
    echo '<input type="number" class="quantityInput" name="quantity" value="1" min="1">';
    echo '<button type="submit" class="addToCart" name="addToCart">Add to Cart</button>';
    echo '</form>';
    echo '</div>';  
}

echo '</div>';

// Function to add a product to the shopping cart
function addToCart($product) {
    if (!isset($_SESSION['shoppingCart'])) {
        $_SESSION['shoppingCart'] = [];
    }

    // Check if the product is already in the cart
    $productKey = array_search($product['id'], array_column($_SESSION['shoppingCart'], 'id'));

    if ($productKey === false) {
        // Add new entry for new product
        $_SESSION['shoppingCart'][] = $product;
        
    } else {
        // Update quantity if already in cart
        $_SESSION['shoppingCart'][$productKey]['quantity'] += $product['quantity'];
    }
//refresh the page
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;

    
}

// If the add-to-cart form is submitted
if (isset($_POST['addToCart'])) { // Vérifiez le nom du bouton submit
    $product = [
        'id' => $_POST['id'],
        'image_url' => $_POST['image_url'],
        'product' => $_POST['Name'],
        'price' => $_POST['Price'],
        'quantity' => $_POST['quantity'],
    ];
    addToCart($product);
    count($_SESSION['shoppingCart']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>


    <div class="bestQuality">
        <img src="assets/images/shoe_two.png" alt="second grosse shoes">
        <p class=best>we provide you the <span>best</span> quality.</p>
        <p class= lorem>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim tenetur accusamus quidem cupiditate optio quasi sint possimus, doloremque impedit!</p>
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
<hr>
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

