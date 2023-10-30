<main>
     
        
    <?php 



// display the products from the JSON file
$productsJson = file_get_contents('products.json');
$products = json_decode($productsJson, true);

 // start the session (or resume an existing one)
 session_start();

 // Check if shopping cart exists and get count
 if (isset($_SESSION['shoppingCart'])) {
     $count = count($_SESSION['shoppingCart']);
 } else {
     $count = 0;
 }
//title
echo '<h2><span>Our</span> last products</h2>';
echo '<div id="products">';
// Loop through the products and display them
foreach ($products as $product) {
    echo '<div class="product">';
    echo '<img src="' . $product['image_url'] . '" alt="' . $product['product'] . '" width="150px">';
    echo '<h3>' . $product['product'] . '</h3>';
    echo '<p>' . "$". $product['price'] . '</p>';
    // Add to cart form with hidden input fields
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
if (isset($_POST['addToCart'])) { 
    // Call the addToCart function
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

</main>