<?php
require "config.php";

if (isset($_POST['searchTerm'])) {
    $searchTerm = $conn->real_escape_string($_POST['searchTerm']);
    
    if (empty($searchTerm)) {
        echo '<span class="loader" id="loading-indicator"></span>';
    } else {
        $query = "SELECT * FROM products WHERE artist LIKE '%$searchTerm%' OR album LIKE '%$searchTerm%'";

        $result = $conn->query($query);

        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $albumTitle = $row["album"];
                    $albumImage = "music/" . $albumTitle . ".png";
                    echo '<div class="product__blur" style="background-image: url(\'' . $albumImage . '\');"hx-get="utilities/buyProduct.php?album=' . $albumTitle . '" hx-swap="innerHTML" hx-target="#dialogElement" hx-trigger="click" onclick="document.getElementById(\'dialogElement\').showModal();">' . PHP_EOL;
                    echo '  <div class="product">' . PHP_EOL;
                    echo '    <img src="' . $albumImage . '" alt="">' . PHP_EOL;
                    echo '    <h2>' . $albumTitle . '</h2>' . PHP_EOL;
                    echo '    <h3>' . $row["artist"] . '</h3>' . PHP_EOL;
                    echo '    <h4>' . $row["price"] . '$</h4>' . PHP_EOL;
                    echo '  </div>' . PHP_EOL;
                    echo '</div>' . PHP_EOL;
                }
            } else {
                echo "<p id='text-error'>Sorry, we could not find <b>$searchTerm</b>. Try something else.</p>";
            }
        }
    }
} else {
    echo "No search term provided.";
}

$conn->close();
?>
