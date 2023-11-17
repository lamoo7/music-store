<?php
session_start();
require_once "config.php";

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;
$user_email = '';

if ($user_id) {
    $sql = "SELECT email FROM users WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $user_id_to_bind = $user_id;
        $stmt->bind_param("i", $user_id_to_bind);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();
            $user_email = $user_data['email'];
        }
    }
}

if ($user_email) {
    $favorites_sql = "SELECT * FROM favorites WHERE user = ?";
    if ($stmt = $conn->prepare($favorites_sql)) {
        $user_email_to_bind = $user_email;
        $stmt->bind_param("s", $user_email_to_bind);
        $stmt->execute();
        $favorites_result = $stmt->get_result();

        if ($favorites_result->num_rows > 0) {
            echo "<div id='favorites'>";
            echo "<h1> Your Favorites </h1>";
            echo "<ul>";
            while ($row = $favorites_result->fetch_assoc()) {
                $product_name = $row['item'];
                $id = $row['id'];

                $product_parts = explode(' - ', $product_name);
                $album = $product_parts[0];

                $price_sql = "SELECT price FROM products WHERE album = ?";
                if ($stmt = $conn->prepare($price_sql)) {
                    $stmt->bind_param("s", $album);
                    $stmt->execute();
                    $price_result = $stmt->get_result();

                    if ($price_result->num_rows == 1) {
                        $price_data = $price_result->fetch_assoc();
                        $price = $price_data['price'];

                        $image_filename = "music/" . $album . ".png";

                        echo "<li>";
                        echo '<a href="store.php" onclick="setSearchInputCookie(\'' . $album . '\')">';
                        echo "<img src='$image_filename' alt='$album'>";
                        echo "<p>$product_name</p>";
                        echo "<p>$price$</p>";
                        echo '</a>';
                        echo '<img src="utilities/icon-delete.png" class="delete-img" alt="remove product"
                        hx-post="utilities/deleteFromFavoritesTable.php?id=' . $id . '" hx-target="closest li" hx-swap="outerHTML">';
                        echo "</li>";
                    }
                }
            }
            echo "</ul>";
            echo "</div>";
        } else {
            echo "You have no favorite products.";
        }
    } else {
        echo "Failed to retrieve favorite products.";
    }
} else {
    echo "You need to log in to view your favorite products.";
}

$conn->close();
?>
