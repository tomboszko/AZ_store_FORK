<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product to Cart</title>
</head>
<body>
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
session_start();

// Function to add a product to the shopping cart
function addToCart($product) {
    if (!isset($_SESSION['shoppingCart'])) {
        $_SESSION['shoppingCart'] = [];
    }

    // Check if the product is already in the cart
    $productKey = array_search($product['id'], array_column($_SESSION['shoppingCart'], 'id'));

    if ($productKey === false) {
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

// If the remove-from-cart action is triggered
if (isset($_GET['removeFromCart']) && isset($_GET['id'])) {
    $productId = $_GET['id'];
    removeFromCart($productId);
}

// Display contents
if (isset($_SESSION['shoppingCart'])) {
    echo '<h1>Shopping Cart</h1>';
    echo '<ul>';
    foreach ($_SESSION['shoppingCart'] as $product) {
        echo '<li>';
        echo 'Product: ' . $product['product'] . '<br>';
        echo 'Price: $' . $product['price'] . '<br>';
        echo 'Quantity: ' . $product['quantity'] . '<br>';
        echo 'Sub-Total: $' . $product['price'] * $product['quantity'] . '<br>';
        echo '<a href="?removeFromCart&id=' . $product['id'] . '">Remove from Cart</a>';
        echo '</li>';
        $totalGlobal += $product['price'] * $product['quantity']; // total global calculation
    }
    echo '</ul>';
    echo '<div class="total-global">Total: $' . $totalGlobal . '</div>';
    echo '<a href="checkout.php" class="checkout-button">Checkout</a>';
} 
else {
    // Display a message if the cart is empty
    echo 'Your cart is empty.';
}
?>
