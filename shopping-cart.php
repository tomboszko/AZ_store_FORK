
    <h1>Add Product to Cart</h1>

    <form method="post" action="shopping-cart.php">
        <label for="id">Product ID:</label>
        <input type="text" name="id" id="id" required>
        
        <label for="Name">Product Name:</label>
        <input type="text" name="Name" id="Name" required>
        
        <label for="Price">Product Price:</label>
        <input type="text" name="Price" id="Price" required>
        
        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" id="quantity" required>

        <input type="submit" name="addToCart" value="Add to Cart">
    </form>

<?php
    // Calculate the total including VAT
$totalGlobal = 0;

// Define the VAT rate (21%)
$vatRate = 0.21;

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
}

// Function to remove a product from the shopping cart
function removeFromCart($productId) {
    if (isset($_SESSION['shoppingCart'])) {
        foreach ($_SESSION['shoppingCart'] as $key => $product) {
            if ($product['id'] == $productId) {
                unset($_SESSION['shoppingCart'][$key]);
                break;
            }
        }
        // Re-index the array
        $_SESSION['shoppingCart'] = array_values($_SESSION['shoppingCart']);
    }
}

// If the add-to-cart form is submitted
if (isset($_POST['addToCart'])) {
    $product = [
        'id' => $_POST['id'],
        'product' => $_POST['Name'],
        'price' => $_POST['Price'],
        'quantity' => $_POST['quantity'],
    ];
    addToCart($product);
}

// If the remove-from-cart link/button is clicked
if (isset($_GET['removeFromCart']) && isset($_GET['id'])) {
    $productId = $_GET['id'];
    removeFromCart($productId);
}

// Display contents
if (isset($_SESSION['shoppingCart'])) {

    echo '<div id="cart">';
    echo '<h1>Shopping Cart</h1>';

    echo '<ul>';
    foreach ($_SESSION['shoppingCart'] as $product) {
        echo '<li>';
        echo 'Product: ' . $product['product'] . '<br>';
        echo 'Price: $' . $product['price'] . '<br>';
        echo 'Quantity: ' . $product['quantity'] . '<br>';
        $subtotal = $product['price'] * $product['quantity'];
        echo 'Sub-Total: $' . $subtotal . '<br>';
        echo '<a href="?removeFromCart&id=' . $product['id'] . '" id="removeButton">Remove from Cart</a>';
        echo '</li>';
        $totalGlobal += $subtotal; // Add the subtotal to the total
    }
    echo '</ul>';

    // Calculate VAT and add it to the total
    $vat = $totalGlobal * $vatRate;
    $totalWithVAT = $totalGlobal + $vat;

    echo '<div class="VAT">VAT: $' . $vat . '</div>';
    echo '<div class="total-global">Total (VAT included): $' . $totalWithVAT . '</div>';
    echo '<a href="checkout.php" id="checkoutButton">Checkout</a>';
    echo '</div>';
} 
else {
    // Display a message if the cart is empty
    echo 'Your cart is empty.';
}
?>
