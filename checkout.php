<?php
session_start();

if(isset($_SESSION["cart_items"])) {

    $cart_items = $_SESSION["cart_items"];

    // total price of items in cart
    $total_price = 0;
    foreach($cart_items as $item) {
        $total_price += $item["price"] * $item["quantity"];
    }

    // Display items in cart
    var_dump($cart_items);
    echo "Total price: $" . number_format($total_price, 2);
} 
else {
    echo "No items in cart.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    // Empty the shopping cart
    unset($_SESSION["cart_items"]);
    // Display message
    echo "<h2>Thank you for your order!</h2>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <form action="" method="post">
        <h2>Shipping Information</h2>

        <label for="shipping_firstname">Firstame:</label>
        <input type="text" id="shipping_firstname" name="shipping_firstname" required>

        <label for="shipping_lastname">LastName:</label>
        <input type="text" id="shipping_lastname" name="shipping_lastname" required>


        <label for="shipping_email">Email:</label>
        <input type="text" id="shipping_email" name="shipping_email" required>
        <?php
        //email validation
        if (isset($_POST['shipping_email'])) {
            $email = $_POST['shipping_email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format";
                
            }
        }
        
        ?>

        <label for="shipping_address">Address:</label>
        <input type="text" id="shipping_address" name="shipping_address" required>


        <label for="shipping_city">City:</label>
            <input type="text" id="shipping_city" name="shipping_city" required>


        <label for="shipping_zip">Zip Code:</label>
            <input type="number" id="shipping_zip" name="shipping_zip" required>


        <label for="shipping_country">Country:</label>
            <input type="text" id="shipping_country" name="shipping_country" required>


        <br><input type="submit" value="Submit Order" id="submit_btn">

        
    </form>
</body>    
</html>

