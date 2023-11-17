<?php
session_start();
require_once "config.php";

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;
$user_email = '';
$is_in_favorites = false; // Initialize the variable

if ($user_id) {
    $sql = "SELECT email FROM users WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Create a variable for binding user_id
        $user_id_to_bind = $user_id;
        $stmt->bind_param("i", $user_id_to_bind); // Pass the variable by reference
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();
            $user_email = $user_data['email'];
        }
    }
}

if (isset($_GET['album'])) {
    $album_name = $_GET['album'];

    $htmlContent = '';
    $album = '';
    $artist = '';

    $album_sql = "SELECT album, artist, price FROM products WHERE album = '$album_name'";
    $album_result = $conn->query($album_sql);

    if ($album_result->num_rows > 0) {
        $album_row = $album_result->fetch_assoc();
        $artist = $album_row['artist'];
        $album = $album_row['album'];
        $price = $album_row['price'];

        // Check if the product is in the favorites table for the current user
        $check_favorites_sql = "SELECT COUNT(*) AS count FROM favorites WHERE item = ? AND user = ?";
        if ($stmt = $conn->prepare($check_favorites_sql)) {
            $item_to_check = $album . ' - ' . $artist;
            $user_email_to_check = $user_email;
            $stmt->bind_param("ss", $item_to_check, $user_email_to_check);
            $stmt->execute();
            $check_result = $stmt->get_result();
            $check_row = $check_result->fetch_assoc();
            $is_in_favorites = $check_row['count'] > 0;
        }

        $htmlContent .= '<div class="buy__product">';
        $htmlContent .= '<img src="music/' . $album . '.png">';
        $htmlContent .= '<h2> <span>' . $album . '</span> - ' . $artist . '</h2>';
        $htmlContent .= '<h1> ' . $price . ' $</h1>';
        $htmlContent .= '<form hx-post="utilities/addToFavoritesTable.php" id="fav">';
        $htmlContent .= '<button type="submit" ' . ($is_in_favorites ? 'disabled' : '') . '>';
        $htmlContent .= ($is_in_favorites ? '<svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 576 512"><style>svg{fill:#ff7eee !important}</style><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9l2.6-2.4C267.2 438.6 256 404.6 256 368c0-97.2 78.8-176 176-176c28.3 0 55 6.7 78.7 18.5c.9-6.5 1.3-13 1.3-19.6v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5zM576 368a144 144 0 1 0 -288 0 144 144 0 1 0 288 0zm-76.7-43.3c6.2 6.2 6.2 16.4 0 22.6l-72 72c-6.2 6.2-16.4 6.2-22.6 0l-40-40c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L416 385.4l60.7-60.7c6.2-6.2 16.4-6.2 22.6 0z"/></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>');
        $htmlContent .= '</button>';
        $htmlContent .= '<input type="hidden" name="item" value="' . $album . ' - ' . $artist . '">';
        $htmlContent .= '<input type="hidden" name="customer" value="' . $user_email . '">';
        $htmlContent .= '</form>';
        $htmlContent .= '<form hx-post="utilities/addToCartTable.php" id="buy">';
        $htmlContent .= '<input type="hidden" name="item" value="' . $album . ' - ' . $artist . '">';
        $htmlContent .= '<input type="hidden" name="price" value="' . $price . '">';
        $htmlContent .= '<input type="hidden" name="customer" value="' . $user_email . '">';
        $htmlContent .= '<input type="submit" value=" Add to cart " onclick="addToCartAndCloseDialog(\'cart-count\', \'dialogElement\')">';
        $htmlContent .= '</form>';
        $htmlContent .= '</div>';
    } else {
        $htmlContent = '<p>Details not found for ' . $album . '.</p>';
    }
} else {
    $htmlContent = '<p>Not enough details provided.</p>';
}

$conn->close();

if (!isset($_SESSION["user_id"])) {
    $htmlContent = '<div class="buy__product">';
    $htmlContent .= '<img src="music/' . $album . '.png">';
    $htmlContent .= '<h2> <span>' . $album . '</span> - ' . $artist . '</h2>';
    $htmlContent .= '<p>You need to log in to buy this album</p>';
    $htmlContent .= '<a href="login.php">Log In</a>';
    $htmlContent .= '</div>';
    echo $htmlContent;
    exit;
}

echo $htmlContent;
?>