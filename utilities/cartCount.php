<?php
require_once "config.php";

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;
$user_email = '';

if ($user_id) {
    $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $userEmail = $user['email'];
        } else {
            $errors[] = "User not found.";
        }
    } else {
        $errors[] = "User Details Query Error: " . $conn->error;
    }
}

if ($user_id) {
    $sql = "SELECT SUM(amount) AS total_products FROM cart WHERE customer = '$userEmail'";
    $result = $conn->query($sql);

    if ($result !== false) {
        $row = $result->fetch_assoc();
        $totalProducts = $row['total_products'];

        if ($totalProducts === null) {
            echo '0';
        } else {
            echo $totalProducts;
        }
    } else {
        echo '0';
    }
} else {
    echo '0';
}
