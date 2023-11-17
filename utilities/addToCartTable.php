<?php

require_once "config.php";

$item = $_POST['item'];
$price = $_POST['price'];
$customer = $_POST['customer'];


$sql_check = "SELECT * FROM cart WHERE item = '$item' AND price = $price AND customer = '$customer'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    $current_amount = $row['amount'];
    $new_amount = $current_amount + 1;

    $sql_update = "UPDATE cart SET amount = $new_amount WHERE item = '$item' AND price = $price AND customer = '$customer'";
    if ($conn->query($sql_update) === TRUE) {
        echo "<p id='db-response'>Album added to the cart</p>";
    } else {
        echo "<p id='db-response'>Error updating album: " . $conn->error . "</p>";
    }
} else {

    $sql_insert = "INSERT INTO cart (item, price, customer, amount) VALUES ('$item', $price, '$customer', 1)";
    if ($conn->query($sql_insert) === TRUE) {
        echo "<p id='db-response'>Album added to the cart</p>";
    } else {
        echo "<p id='db-response'>Error inserting album: " . $conn->error . "</p>";
    }
}

$conn->close();
?>