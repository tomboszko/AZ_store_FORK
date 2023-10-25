<?php
session_start();

// var_dump($_POST);

if(isset($_SESSION["cart_items"])) {

    $cart_items = $_SESSION["cart_items"];

    // Display items in cart
    var_dump($cart_items);

    foreach ($cart_items as $item) {
        echo "<div>";
        echo "<img src='" . $item['image'] . "' alt='" . $item['name'] . "'><br>";
        echo "Name: " . $item['name'] . "<br>";
        echo "Price: $" . $item['price'] . "<br>";
        echo "Quantity: " . $item['quantity'] . "<br>";
        echo "Total: $" . ($item['price'] * $item['quantity']) . "<br>";
        echo "</div>";
    }
    
} 
else {
    echo "No items in cart.";
}

//Sanitize input
function sanitize(){
    $shipping_firstname = filter_var($_POST["shipping_firstname"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $shipping_lastname = filter_var($_POST["shipping_lastname"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $shipping_email = filter_var($_POST["shipping_email"], FILTER_SANITIZE_EMAIL);
    $shipping_address = filter_var($_POST["shipping_address"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $shipping_city = filter_var($_POST["shipping_city"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $shipping_zip = filter_var($_POST["shipping_zip"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $shipping_country = filter_var($_POST["shipping_country"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

}


if (isset($_POST["shipping_email"])) {

    if (!filter_var($_POST["shipping_email"], FILTER_VALIDATE_EMAIL)) {
        echo "<br> Invalid email format";
    } 
    else {
         // Empty the shopping cart
         unset($_SESSION["cart_items"]);
         // Display message
         echo "<h2>Thank you for your order!</h2>";
    }
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

