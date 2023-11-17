<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    exit;
}

require_once "config.php";

$productId = $_GET['id'];

$sql = "DELETE FROM favorites WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $stmt->close();
}