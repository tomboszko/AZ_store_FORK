<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/">
    <title>Shopping Cart</title>
</head>
<body>
    

<?php
session_start();



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


// If the remove button is clicked
if (isset($_GET['removeFromCart']) && isset($_GET['id'])) {
    $productId = $_GET['id'];
    removeFromCart($productId);
}


// Display contents
function displayShoppingCart() {
    
    $totalGlobal = 0;
    $vatRate = 0.21;
    
if (isset($_SESSION['shoppingCart'])) {

    echo '<div id="cart">';
echo '<h1>Shopping Cart</h1>';
echo '<ul>';
foreach ($_SESSION['shoppingCart'] as $product) {
    $subtotal = $product['price'] * $product['quantity'];
    $totalGlobal += $subtotal;
    echo '<li>';
    echo '<img src="' . $product['image_url'] . '" alt="' . $product['product'] . '" width="60px">';
    echo '<div class="product">';
    echo $product['product'];
    echo '<br>';
    echo '  Price: $' . $product['price'] ;
    echo '<br>';
    echo '  Qty: ' . $product['quantity'] ;
    echo '<br>';
    echo '  Sub-Total: $' . $subtotal ;
    echo '</div>';
    echo '<button type="button" id="removeButton" onclick="window.location.href=\'?removeFromCart&id=' . $product['id'] . '\'">X</button>';
    echo '</li>';
}
echo '</ul>';
// Calculate VAT and add it to the total
$vat = $totalGlobal * $vatRate;
$totalWithVAT = $totalGlobal + $vat;

echo '<div class="totalGlobal">Total (VAT 21% included): $' . $totalWithVAT . '</div>';
echo '<button type="button" id="checkoutButton" onclick="window.location.href=\'checkout.php\'">Order</button>';
echo '</div>';
} 

}

// condition to display the shopping cart

if (isset($_SESSION['shoppingCart'])) {
    displayShoppingCart();
}
else {
    // Display a message if the cart is empty
    echo 'Your cart is empty.';
}

?>

</body>
</html>
