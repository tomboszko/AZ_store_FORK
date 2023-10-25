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
        // chose qty if allready in cart
        $_SESSION['shoppingCart'][$productKey]['quantity'] += $product['quantity'];
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

// Display contents
if (isset($_SESSION['shoppingCart'])) {
    echo '<h1>Shopping Cart</h1>';
    echo '<ul>';
    foreach ($_SESSION['shoppingCart'] as $product) {
        echo '<li>';
        echo 'Product Name: ' . $product['product'] . '<br>';
        echo 'Price: $' . $product['price'] . '<br>';
        echo 'Quantity: ' . $product['quantity'] . '<br>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    // Display a message if the cart is empty
    echo 'Your cart is empty.';
}
?>

</body>
</html>
