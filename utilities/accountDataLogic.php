<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

require_once "config.php";

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM users WHERE id = ? LIMIT 1";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        $user_name = $user["fname"] . " " . $user["lname"];
        $user_gender = $user["gender"];
    } else {
        $errors[] = "User not found.";
    }
} else {
    $errors[] = "User Details Query Error: " . $conn->error;
}
?>