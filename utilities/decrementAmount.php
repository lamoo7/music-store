<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    exit;
}

require_once "config.php";

$productId = $_GET['id'];

$sqlUpdate = "UPDATE cart SET amount = GREATEST(amount - 1, 1) WHERE id = ?";
if ($stmtUpdate = $conn->prepare($sqlUpdate)) {
    $stmtUpdate->bind_param("i", $productId);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

$sqlSelect = "SELECT amount FROM cart WHERE id = ?";
if ($stmtSelect = $conn->prepare($sqlSelect)) {
    $stmtSelect->bind_param("i", $productId);
    $stmtSelect->execute();
    $stmtSelect->bind_result($newAmount);
    $stmtSelect->fetch();
    $stmtSelect->close();

    echo $newAmount;
} else {
    echo "Error";
}

$conn->close();
?>
