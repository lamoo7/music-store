<?php
require "config.php";

if (isset($_GET['album'])) {
    $album_name = $_GET['album'];

    $htmlContent = '';

    $album_sql = "SELECT album, artist, released FROM products WHERE album = '$album_name'";
    $album_result = $conn->query($album_sql);

    if ($album_result->num_rows > 0) {
        $album_row = $album_result->fetch_assoc();
        $artist = $album_row['artist'];
        $album = $album_row['album'];
        $released = $album_row['released'];

        $htmlContent .= '<div class="album__fullscreen">';
        $htmlContent .= '<div class="album__info">';
        $htmlContent .= '<img src="music/' . $album . '.png">';
        $htmlContent .= '<h2>' . $album . '</h2>';
        $htmlContent .= '<span>' . $artist . '</span>';
        $htmlContent .= '<span>' . $released . '</span>';
        $htmlContent .= '</div>';

        $song_sql = "SELECT song_name FROM songs WHERE album_name = '$album_name'";
        $song_result = $conn->query($song_sql);

        if ($song_result->num_rows > 0) {
            $htmlContent .= '<div class="album__songs">';
            $htmlContent .= '<ol>';
            while ($song_row = $song_result->fetch_assoc()) {
                $htmlContent .= '<li>' . $song_row['song_name'] . '</li>';
            }
            $htmlContent .= '</ol>';
            $htmlContent .= '</div>';
        } else {
            $htmlContent .= '<ol>No songs found for ' . $album_name . '.</ol>';
        }
    } else {
        $htmlContent = '<p>Album details not found for ' . $album_name . '.</p>';
    }

    $htmlContent .= '<p>Are you looking to buy this album? Press <a href="store.php" onclick="setSearchInputCookie(\'' . $album . '\')">here</a> to go to the store.</p>';
} else {
    $htmlContent = '<p>Album name not provided.</p>';
}

$conn->close();

echo $htmlContent;
?>
