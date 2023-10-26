<?php
session_start();

if(isset($_SESSION["shoppingCart"])) {
    
    $cart_items = $_SESSION["shoppingCart"];
    
    // Display items in cart
    
    foreach ($cart_items as $item) {
        echo "<div>";
        echo "<img src='" . $item['image_url'] . "' alt='" . $item['product'] . "'><br>";
        echo "Name: " . $item['product'] . "<br>";
        echo "Price: $" . $item['price'] . "<br>";
        echo "Quantity: " . $item['quantity'] . "<br>";
        echo "Total: $" . ($item['price'] * $item['quantity']) . "<br>";
        echo "</div>";
    }

    // Display total price
    $total_price = 0;
    foreach ($cart_items as $item) {
        $total_price += ($item['price'] * $item['quantity']);
    }
    echo "<h2>Total Price: $" . $total_price . "</h2>";
} 
else {
    echo "<p> No items in cart. </p>";
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
</head>
<body>
    <h1> Thank you for your order !</h1>

</body>
</html>