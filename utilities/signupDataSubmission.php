<?php

require_once "config.php";

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"]; 
    $confirmedPassword = $_POST["cpassword"];
    $gender = in_array($_POST["gender"], ['Male', 'Female', 'Other']) ? $_POST["gender"] : 'Other';

    if (!preg_match('/^[A-Za-z]+$/', $fname) || !preg_match('/^[A-Za-z]+$/', $lname)) {
        $errors[] = "Invalid name format. Only letters are allowed.";
    } elseif ($password !== $confirmedPassword) {
        $errors[] = "Passwords do not match.";
    } else {
        $check_sql = "SELECT * FROM users WHERE email = ?";
        if ($check_stmt = $conn->prepare($check_sql)) {
            $check_stmt->bind_param("s", $email);
            $check_stmt->execute();
            $check_stmt->store_result();

            if ($check_stmt->num_rows > 0) {
                $errors[] = "A user with the same email already exists.";
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT);

                $insert_sql = "INSERT INTO users (fname, lname, email, password, gender) VALUES (?, ?, ?, ?, ?)";
                if ($stmt = $conn->prepare($insert_sql)) {
                    $stmt->bind_param("sssss", $fname, $lname, $email, $password, $gender);
                    if ($stmt->execute()) {
                        $stmt->close();
                        header("Location: login.php");
                        exit;
                    } else {
                        $errors[] = "Execution Error: " . $stmt->error;
                    }
                } else {
                    $errors[] = "Preparation Error: " . $conn->error;
                }
            }
        } else {
            $errors[] = "Check Preparation Error: " . $conn->error;
        }
    }
}

$conn->close();
?>