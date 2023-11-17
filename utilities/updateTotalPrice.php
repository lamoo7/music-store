<?php

require_once "config.php";

require_once "accountDataLogic.php";

if (!isset($_SESSION["user_id"])) {
    exit;
}

$userEmail = $user['email'];
$sql = "SELECT SUM(price * amount) AS total FROM cart WHERE customer = '$userEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $newTotalPrice = $row['total'];
} else {
    $newTotalPrice = 0;
}

echo number_format($newTotalPrice, 2) . "$";
?>
