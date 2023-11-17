<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    exit;
}

require_once "config.php";

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sql = "SELECT price, amount FROM cart WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $stmt->bind_result($price, $amount);
    $stmt->fetch();
    $stmt->close();

    $subtotal = $price * $amount;

    echo number_format($subtotal, 2) . "$";
} else {
    echo "Error: Product ID not provided.";
}

$conn->close();
?>
