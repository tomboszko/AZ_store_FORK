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
    echo "<p class='noItems'> No items in cart. </p>";
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='assets/css/style.min.css' media="screen">
    <title>Thank you</title>
</head>
<body>
    <h1 class="thanks"> Thank you for your order <?php echo rand(0, 1000000) ?>!</h1>
    
    <form method="post"> 
        <input type="submit" name="button" class="button-redirec" value="Return to Store" />
    </form> 
    <?php
         if(array_key_exists("button", $_POST)) { 
            header("Location: index.php");
        } 
    ?>
    
</body>
</html>