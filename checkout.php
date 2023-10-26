<?php
session_start();

// var_dump($_POST);

if(isset($_SESSION["shoppingCart"])) {
    
    $cart_items = $_SESSION["shoppingCart"];
    
    // Display items in cart
    // var_dump($cart_items);
    
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

//Sanitize input
function sanitize($data){
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    $data = trim($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "post") {
    // Sanitize input data
    $sanitized_firstname = sanitize($_POST["shipping_firstname"]);
    $sanitized_lastname = sanitize($_POST["shipping_lastname"]);
    $sanitized_email = sanitize($_POST["shipping_email"]);
    $sanitized_address = sanitize($_POST["shipping_address"]);
    $sanitized_city = sanitize($_POST["shipping_city"]);
    $sanitized_zip = sanitize($_POST["shipping_zip"]);
    $sanitized_country = sanitize($_POST["shipping_country"]);
}


if (isset($_POST["shipping_email"])) {

    if (!filter_var($_POST["shipping_email"], FILTER_VALIDATE_EMAIL)) {
        echo "<br> Invalid email format";
    } 
    else {
         // Empty the shopping cart
         session_destroy();
        // Redirection index.php
        header("Refresh:0; url=thankyou.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" media="screen">
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <form action="" method="post">
        <h2>Shipping Information</h2>

        <label for="shipping_firstname">Firstame:</label>
            <!-- <input type="text" id="shipping_firstname" name="shipping_firstname" required> -->
            <?php 
            if (isset($_POST["shipping_firstname"])){
                echo ("<input type='text' id='shipping_firstname' name='shipping_firstname' value='$_POST[shipping_firstname]' required>");
            }
            else{
                echo ("<input type='text' id='shipping_firstname' name='shipping_firstname' required>");
            }
            ?>
            

        <label for="shipping_lastname">Lastname:</label>
            <!-- <input type="text" id="shipping_lastname" name="shipping_lastname" required> -->
            <?php 
            if (isset($_POST["shipping_lastname"])){
                echo ("<input type='text' id='shipping_lastname' name='shipping_lastname' value='$_POST[shipping_lastname]' required>");
            }
            else{
                echo ("<input type='text' id='shipping_lastname' name='shipping_lastname' required>");
            }
            ?>


        <label for="shipping_email">Email:</label>
            <!-- <input type="text" id="shipping_email" name="shipping_email" required> -->
            <?php 
            if (isset($_POST["shipping_email"])){
                echo ("<input type='text' id='shipping_email' name='shipping_email' value='$_POST[shipping_email]' required>");
            }
            else{
                echo ("<input type='text' id='shipping_email' name='shipping_email' required>");
            }
            ?>

        <label for="shipping_address">Address:</label>
            <!-- <input type="text" id="shipping_address" name="shipping_address" required> -->
            <?php 
            if (isset($_POST["shipping_address"])){
                echo ("<input type='text' id='shipping_address' name='shipping_address' value='$_POST[shipping_address]' required>");
            }
            else{
                echo ("<input type='text' id='shipping_address' name='shipping_address' required>");
            }
            ?>
          
        <label for="shipping_city">City:</label>
            <!-- <input type="text" id="shipping_city" name="shipping_city" required> -->
            <?php 
            if (isset($_POST["shipping_city"])){
                echo ("<input type='text' id='shipping_city' name='shipping_city' value='$_POST[shipping_city]' required>");
            }
            else{
                echo ("<input type='text' id='shipping_city' name='shipping_city' required>");
            }
            ?>


        <label for="shipping_zip">Zip Code:</label>
            <!-- <input type="number" id="shipping_zip" name="shipping_zip" required> -->
            <?php 
            if (isset($_POST["shipping_zip"])){
                echo ("<input type='text' id='shipping_zip' name='shipping_zip' value='$_POST[shipping_zip]' required>");
            }
            else{
                echo ("<input type='text' id='shipping_zip' name='shipping_zip' required>");
            }
            ?>


        <label for="shipping_country">Country:</label>
            <!-- <input type="text" id="shipping_country" name="shipping_country" required> -->
            <?php 
            if (isset($_POST["shipping_country"])){
                echo ("<input type='text' id='shipping_country' name='shipping_country' value='$_POST[shipping_country]' required>");
            }
            else{
                echo ("<input type='text' id='shipping_country' name='shipping_country' required>");
            }
            ?>

        <input type="submit" value="Submit Order" id="submit_btn">

        
    </form>
</body>    
</html>

