<?php

require_once "config.php";

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user["password"])) {
                session_start();
                $_SESSION["user_id"] = $user["id"];
                header("Location: account.php");
                exit;
            } else {
                $errors[] = "Invalid email or password.";
            }
        } else {
            $errors[] = "Invalid email or password.";
        }
    } else {
        $errors[] = "Login Preparation Error: " . $conn->error;
    }
}

$conn->close();
?>
