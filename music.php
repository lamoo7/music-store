<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="utilities/favicon.ico" type="image/x-icon">
    <script src="https://unpkg.com/htmx.org@1.9.6"></script>
    <title>Music Store</title>
</head>

<body>

    <?php require_once "menu.html"; ?>

    <div id="content">

        <div id="search-section">
            <div class="flex" id="input-div">
                <input type="text" id="searchAlbums" placeholder="Search for albums by title, artist or release year">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" >
                    <path
                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                </svg>
            </div>

            <div class="flex" style="align-items: inherit">
                <p>Filters:</p>
                <label class="custom-checkbox"><input type="checkbox" name="rock"
                        onclick="this.parentElement.classList.toggle('focused-label')">Rock & Metal</label>
                <label class="custom-checkbox"><input type="checkbox" name="electronic"
                        onclick="this.parentElement.classList.toggle('focused-label')">Electronic/Dance</label>
                <label class="custom-checkbox"><input type="checkbox" name="hiphop"
                        onclick="this.parentElement.classList.toggle('focused-label')">HipHop</label>
                <label class="custom-checkbox"><input type="checkbox" name="pop"
                        onclick="this.parentElement.classList.toggle('focused-label')">Pop</label>
            </div>
        </div>

        <div class="album__flex">

            <?php
            require "utilities/config.php";

            $sql = "SELECT DISTINCT album, artist, released, genre1, genre2, genre3, genre4 FROM products ORDER BY album ASC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $artist = $row['artist'];
                    $album = $row['album'];
                    $released = $row['released'];

                    echo '<div id="' . $album . '" class="album ' . $row['genre1'] . ' ' . $row['genre2'] . ' ' . $row['genre3'] . ' ' . $row['genre4'] . '" style="background-image: url(\'music/' . $album . '.png\');" 
                              hx-get="utilities/getSongs.php?album=' . $album . '" hx-swap="innerHTML" hx-target="#dialogElement" hx-trigger="click" onclick="document.getElementById(\'dialogElement\').showModal();">
                                <div class="album__details">
                                    <img src="music/' . $album . '.png">
                                    <div>
                                        <h2>' . $album . '</h2>
                                        <span>' . $artist . '</span>
                                        <span>' . $released . '</span>
                                    </div>
                                </div>
                            </div>';
                }
            } else {
                echo '<p>No data found.</p>';
            }

            $conn->close();
            ?>

        </div>

        <dialog id="dialogElement">
            <span class="loader"></span>
        </dialog>

        <?php require_once "footer.html"; ?>

    </div>

    <script src="script.js"></script>

</body>

</html>