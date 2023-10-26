
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // must be removed in Production
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
    echo '<img src="' . $product['image_url'] . '" alt="' . $product['product'] . '" width="50px">';
    echo '<div class="product">';
    echo $product['product'];
    echo '  Price: $' . $product['price'] ;
    echo '  Qty: ' . $product['quantity'] ;
    echo '</select>';
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

<style>
    #cart {
        width: 375px;
        border: 1px solid black;
        padding: 1rem;
        margin: 1rem;
        background-color: rgb(17,24,32);
        color: white;
    }

    h1 {
        margin-top: 0;
        justify-content: center;
        margin-bottom: 1rem;
        margin-left: 1rem;
        margin-right: 1rem;
        padding-right: auto;
        padding-left: auto;
    }
    #cartIcon {
        margin-bottom: -0.5rem;
        margin-right: 8px;
        
    }
    #cart ul {
        list-style-type: none;
        padding: 0;
        margin-bottom: 0rem;
        display: flex;
        flex-direction: column;
        
    }
    #cart li {
        margin: 1rem;
        margin-top: 0rem;
        padding-bottom: 1rem;
        display: flex;
        flex-direction: row;
        border-bottom: 1px solid black;
    }
 .product {
        margin-left: 1rem;
        margin-right: 1rem;
        margin-top: auto;
        margin-bottom: auto;
    }
   

    #removeButton {
        width: 1rem;
        height: 1rem;
        font-size: 0,5rem;
        text-shadow: black 0.1em 0.1em 0.2em;
        color: rgba(57,127,241,1);
        background-color: rgb(17,24,32);
        margin-left: auto;
        margin-right: 1rem;
        margin-top: auto;
        margin-bottom: auto;
        border : none;  
    }

    #removeButton:hover {
        color: grey;
    }
#removeButoon:active {
    transform: scale(0,7);
}


    #checkoutButton {
        display: block;
        width: 90%;
        height: 2rem;
        margin-left: auto;
        margin-right: auto;
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: none;
        border-radius: 5px;
        background: linear-gradient(90deg, rgba(57,127,241,1) 0%, rgba(31,61,146,1) 100%);
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        color: white;
        font-size: 1rem;
        font-weight: bold;
}
    #checkoutButton:active {
        background-color: #3e8e41;
        transform: translate(0, 2px);
    }
    #checkoutButton:hover {
        background-color: #3e8e41;


        
    }
    .totalGlobal {
        font-weight: bold;
        text-align: right;
        margin-right: 1rem;
    }

</style>
