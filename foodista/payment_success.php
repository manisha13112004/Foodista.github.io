<?php
include("connection/connect.php");
session_start();

if (!isset($_GET['payment_id'])) {
    echo "Payment not received.";
    exit();
}

// Save order in DB
if (!empty($_SESSION["cart_item"])) {
    foreach ($_SESSION["cart_item"] as $item) {
        $SQL = "INSERT INTO users_orders(u_id, title, quantity, price, status, date)
                VALUES (
                    '".$_SESSION["user_id"]."',
                    '".$item["title"]."',
                    '".$item["quantity"]."',
                    '".$item["price"]."',
                    'in process',
                    '".date('Y-m-d')."'
                )";
        mysqli_query($db, $SQL);
    }

    // Clear cart
    unset($_SESSION["cart_item"]);
    header("Location: your_orders.php");
    exit();
} else {
    echo "No items in cart.";
}
?>
